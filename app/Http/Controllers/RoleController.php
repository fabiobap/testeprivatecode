<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRole;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRole $request)
    {
        //somente super admin
        $this->authorize('create-role');

        $validatedData = $request->all();

        if(Role::where('name','=',$validatedData['new_role_name'])->exists()){
            flash('Nome do grupo já existe!')->error();
            return redirect()->back();
        }
        $role = Role::create(['name' => $validatedData['new_role_name']]);

        if(array_key_exists('permissions_to_roles', $validatedData)){
            foreach($validatedData['permissions_to_roles'] as $permission){
                $role->givePermissionTo($permission);
            }
        }

        flash('Grupo criado com sucesso!')->success();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
