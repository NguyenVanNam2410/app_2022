<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthRequest;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(AuthRequest $request)
    {
        $admin = Admin::create([
            'name'     => $request['name'],
            'email'    => $request['email'],
            'phone'    => $request['phone'],
            'birthday' => $request['birthday'],
            'avatar'   => 1,
            'password' => Hash::make($request['password']),
        ]);
        $token = $admin->createToken('authToken')->plainTextToken;
        $response = [
            'admin' => $admin,
            'token' => $token,
        ];
        return response($response, 201);
    }

    public function login(LoginRequest $request)
    {
        $email    = $request['email'];
        $password = $request['password'];

        $remember_token = $request->has('remember_token') ?  true : false;

        // $admin = Admin::create([
        //     'remember_token' => Str::Random(60),
        // ]);
        
        if (Auth::guard('admin')->attempt([
            'email'    => $email,
            'password' => $password
        ], $remember_token ))
        {
            $user = auth()->user();
        }
        $admin = Admin::where('email', $email)->first();

        if (!$admin || !Hash::check($password, $admin->password)) {
            return null;
        }

        $token =  $admin->createToken('authToken')->plainTextToken;

        return [
            'data' => $admin,
            'access_token' => $token,
        ];
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json('Successfully logged out');
    }
}
