<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|string|unique:admins,email',
            'password' => 'required|string|min:5|max:13',
            'phone'    => 'required|string',
            'birthday' => 'required|string',
        ]);
        $admin = admin::create([
            'name'  => $fields['name'],
            'email' => $fields['email'],
            'phone' => $fields['phone'],
            'birthday' => $fields['birthday'],
            'avatar' => 1,
            'password' => Hash::make($fields['password']),
        ]);
        $token = $admin->createToken('myapptoken')->plainTextToken;
        $response = [
            'admin' => $admin,
            'token' => $token,
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string|min:5|max:13',
        ]);

        $email = $fields['email'];
        $password = $fields['password'];

        $admin =  Admin::where('email', $email)->first();
        if ($admin) {
            if (Hash::check($password, $admin->password)) {
                $request->Session()->put('AdminId', $admin->id);
                return response()->json([
                    'admin'   => $admin,
                    'code'    => 200,
                    'message' => 'đăng nhập thành công',
                ]);
            } else {
                return back()->with('fail', 'thông tin đăng nhập không đúng');
            }
        } else {
            return back()->with('fail', 'this is not register');
        }
    }

    public function logout()
    {
        if (Session::has('AdminId'))
        {
            
        }
    }
    

}
