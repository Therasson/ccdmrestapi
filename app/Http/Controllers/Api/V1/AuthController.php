<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{
    /**
     * Inscription de nouvel utilisateur
     */
    public function register(Request $request)
    {
   
        //validate user
        $attrs = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ]);

        //create user
        $user = User::create([
            'name' => $attrs['name'],
            'email' => $attrs['email'],
            'password' => bcrypt($attrs['password'])
        ]);

       
        //Assignation de rôle user
        $role = Role::where('name', 'admin')->first();
        $user->assignRole($role);

        //return user & token in response
        return response([
            'user' => $user,
            'token' => $user->createToken('secret')->plainTextToken
        ], 200);

    }
    

    /**
     * Connexion d'un utilisateur
     */
    public function login(Request $request)
    {
       
        //validate user
        $attrs= $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        //attempt login
        if(!Auth::attempt($attrs))
        {
            return response ([
                'message' => 'Invalid credentials'
            ], 403);
        }


        //return user & token in response
        return response([
            'user' => auth()->user(),
            'token' => auth()->user()->createToken('secret')->plainTextToken
        ], 200);

    }


    /**
     * Logout function
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logout success'
        ]);
    }

    
}