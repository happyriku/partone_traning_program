<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $request->email)
                    ->first();
        if (!$user)
            return response()->json(['message' => 'User not found'], 400);
        if (!Hash::check($password, $user->password))
            return response()->json(['message' => 'Login failed.'], 400);
        else
            return response()->json(['message' => 'Login successful.'], 200);
    }
}
