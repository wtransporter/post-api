<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Register new user
     *
     * @param Request $request
     * @return Response
     */
    public function register(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $attributes['password'] = bcrypt($request->password);

        if (!User::create($attributes)) {
            return response([
                'message' => 'Something went wrong. Try again later.'
            ], 422);
        };

        return response([
            'message' => 'You have successfully registered.'
        ]);
    }

    /**
     * Login given user
     *
     * @param Request $request
     * @return Response
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|exists:users',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            return response([
                'message' => 'Invalid credentials.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = Auth::user()->createToken('token')->plainTextToken;

        return response([
            'message' => 'Success',
            'token' => $token
        ]);
    }
}
