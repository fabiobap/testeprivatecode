<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function changeUserPassword(UpdateUser $request){
        $validatedData = $request->all();
        $user = auth()->user();
        $validatedData['password'] =  Hash::make($validatedData['password']);
        $user->password = $validatedData['password'];
        $user->save();
        flash('Senha alterada com sucesso!')->success();
        return redirect()->back();
    }
}
