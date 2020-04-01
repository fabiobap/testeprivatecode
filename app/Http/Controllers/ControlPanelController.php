<?php

namespace App\Http\Controllers;

use App\ControlPanel;
use App\Http\Requests\UpdateUserGroup;
use App\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ControlPanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rolesIndex()
    {
        //somente super admin
        $this->authorize('create-role');

        $user = auth()->user();
        $roles = Role::with('users')->get();
        if (!$user->hasRole('Super Admin')) {
            $roles = Role::where('name', '!=', 'Super Admin')->with('users')->orderBy('name','asc')->get();
        }
        $permissions = Permission::orderBy('name','asc')->get();
        $users = User::orderBy('name','asc')->get();
        return view('controlpanel._roles', compact('roles', 'permissions', 'users'));
    }
    public function userSettingsIndex()
    {
        return view('controlpanel._user-settings');
    }

    public function logActivityIndex()
    {
        $user = auth()->user();
        $logs = Activity::where('causer_type', User::class)->where('causer_id', $user->id)->paginate(10);
        if ($user->hasRole('Super Admin') || $user->can('Visualizar Logs')) {
            $logs = Activity::orderBy('created_at','desc')->paginate(10);
        }
        return view('controlpanel._logs', compact('logs'));
    }

    public function updateUserGroup(UpdateUserGroup $request)
    {
        $validatedData = $request->all();
        $user = User::findOrFail($validatedData['user_id']);
        $user->assignRole($validatedData['role_name']);
        //$user->givePermissionTo($validatedData['permissions_to_user']);

        flash("$user->name adicionado ao grupo" . $validatedData['role_name'] . '!')->success();
        return redirect()->back();
    }
}
