<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\helpers\Helper;
use App\Http\Resources\UserResource;
use Spatie\Permission\Models\Role;
use App\Models\User;
class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {

        // register user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        // assign user role
        $user_role = Role::where(['name' => 'user'])->first();
        if($user_role){
            $user -> assignRole($user_role);
        }

        // if(!Auth::attempt($request->only('email','password'))){
        //     Helper::sendError('Email or Password  is wrong !!!');
        // }
        return new UserResource($user);
    }
}
