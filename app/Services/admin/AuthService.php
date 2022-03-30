<?php


namespace App\Services\Admin;

use App\Models\Admin;
use App\Models\User;
use App\Services\Service;
use Illuminate\Support\Facades\Hash;


class AuthService extends Service
{
    public function attemptLogin($data)
    {
        $admin = Admin::where('email', $data['email'])->first();
        $password = $data['password'];

        if (!$admin || !Hash::check($password, $admin->password)) {
            return null;
        }
        $token = $admin->createToken('authToken')->plainTextToken;
            
        return [
            'admin' => $admin,
            'token' => $token,
        ];
    }
}