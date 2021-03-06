<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return response($user, Response::HTTP_CREATED);
    }

    public function login(Request $request){
        if(!Auth::attempt($request->only('email', 'password')))
        {
            return \response([
                'error' => 'Credenciais inválidas'
            ], Response::HTTP_UNAUTHORIZED);
        }

        /* user */
        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;

        return \response([
            'jwt' => $token
        ]);
    }

    public function user(Request $request){
        return $request->user();
    }
}
