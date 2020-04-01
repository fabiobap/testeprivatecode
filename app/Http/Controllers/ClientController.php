<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\StoreClient;
use App\Phone;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = auth()->user();
            //$clients = Client::where('user_id', $user->id)->get();
            $clients = Client::with('user')->whereHas('user', function (Builder $query) use ($user) {
                if (!$user->roles->isEmpty()) {
                    $query->whereHas('roles', function (Builder $q) use ($user) {
                        if ($user->roles->count() > 1) {
                            $q->whereIn('name', $user->roles);
                        } else {
                            $q->where('name', '=', $user->roles[0]->name);
                        }
                    });
                } else {
                    $query->where('id', $user->id);
                }
            })->orderBy('name', 'asc')->get();
            if ($user->hasRole('Super Admin')) {
                $clients = Client::orderBy('name', 'asc')->get();
            }
            return DataTables::of($clients)
                ->addIndexColumn()
                ->addColumn('user', function ($row) use ($user) {
                    return $row->user->name;
                })
                ->addColumn('contact', function ($row) use ($user) {
                    $phones = '';
                    foreach ($row->phones as $phone) {
                        if (
                            ($user->can('Visualizar Telefones') &&
                                array_intersect($row->user->getRoleNames()->toArray(), $user->getRoleNames()->toArray())) ||
                            $user->hasRole('Super Admin') ||
                            $user->id == $row->user_id
                        ) {
                            $phoneNumberFormatted = trim($phone->phoneNumber);
                            $phoneNumberFormatted = str_replace(['(', ')', '-', '.', '+', 'x', ' '], '', $phoneNumberFormatted);
                            $phones .= <<<HTML
                        <p>$phone->phoneNumber
                            <a href="tel:+$phoneNumberFormatted" class="btn btn-sm btn-primary">
                                <i class="fas fa-phone-square-alt fa-lg	"></i>
                            </a>
                            <a href="https://wa.me/$phoneNumberFormatted" class="btn btn-sm btn-success">
                                <i class="fab fa-whatsapp fa-lg	"></i>
                            </a>
                        </p>
                        HTML;
                        } else {
                            $phones = 'Você não privilégios para visualizar este telefone!';
                        }
                    }
                    return $phones;
                })
                ->addColumn('roles', function ($row) use ($user) {
                    $roles = '';
                    if (!$row->user->roles->isEmpty()) {
                        foreach ($row->user->roles as $role) {
                            if (!in_array($role->name, $user->getRoleNames()->toArray())) {
                                continue;
                            }
                            $roles .= <<<HTML
                       <p>$role->name</p>
                       HTML;
                        }
                    } else {
                        $roles = null;
                    }
                    return $roles;
                })
                ->addColumn('action', function ($row) use ($user) {
                    $action = <<<HTML
                        <div class="d-flex justify-content-start">
                        </div>
                    HTML;
                    if (
                        ($user->can('Editar Telefones') &&
                            array_intersect($row->user->getRoleNames()->toArray(), $user->getRoleNames()->toArray())) ||
                        $user->hasRole('Super Admin') ||
                        $user->id == $row->user_id
                    ) {
                        $action .= <<<HTML
                          <div class="p-2"><a class="btn btn-dark btn-sm" href="/clients/$row->id/edit"><i class="fa fa-edit"></i> Editar</a></div>
                    HTML;
                    }
                    if (
                        ($user->can('Excluir Telefone') &&
                            array_intersect($row->user->getRoleNames()->toArray(), $user->getRoleNames()->toArray())) ||
                        $user->hasRole('Super Admin') ||
                        $user->id == $row->user_id
                    ) {
                        $action .= <<<HTML
                        <div class="p-2"><button class="btn btn-danger btn-sm" id="table-btn-remover" onClick="modalDelete($row->id)"><i class="fa fa-trash"></i> Remover</button></div>
                    HTML;
                    }
                    $action .= <<<HTML
                        </div>
                    HTML;
                    return $action;
                })
                ->rawColumns(['action', 'contact', 'roles'])
                ->make(true);
        }
        return view('clients.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClient $request)
    {
        $validatedData = $request->all();
        $user = auth()->user();
        $client = $user->clients()->create($validatedData);
        $phones = [];

        if (count($validatedData['phoneNumber']) > 0) {

            foreach ($validatedData['phoneNumber'] as $phoneNumber) {
                if (is_null($phoneNumber)) {
                    continue;
                }
                $phone = Phone::create(['phoneNumber' => $phoneNumber]);
                $phones[] = $phone->id;
            }
            $client->phones()->attach($phones);
        }
        flash('Cliente adicionado com sucesso!')->success();
        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $this->authorize($client);
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $validatedData = $request->all();
        $client->update($validatedData);
        $phones = [];
        if (count($validatedData['phoneNumber']) > 0) {
            foreach ($validatedData['phoneNumber'] as $phoneNumber) {
                if (is_null($phoneNumber)) {
                    continue;
                }
                $phone = Phone::create(['phoneNumber' => $phoneNumber]);
                $phones[] = $phone->id;
            }
            $client->phones()->attach($phones);
        }
        flash('Cliente atualizado com sucesso!')->success();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return response()->noContent();
    }
}
