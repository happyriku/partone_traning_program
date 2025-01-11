<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordChangeController extends Controller
{
    public function change_password(Request $request)
    {
        $curr_password = $request->curr_password;
        $reset_password = $request->reset_password;
        $reset_password_cfm = $request->reset_password_cfm;
        $user_id = $request->cookie('user_id');

        try{
            $validated = $request->validate([
                'reset_password' => 'required|string|min:8',
                'reset_password_cfm' => 'required|string|min:8',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('validation failed:', $e->errors());
            throw $e;
        }

        $user = User::where('user_id', $user_id)
                    ->first();
        if (!Hash::check($curr_password, $user->password))
            return response()->json(['message' => 'Current password does not match'], 400);
        if (!($reset_password === $reset_password_cfm))
            return response()->json(['message' => 'Passwords do not match'], 400);
        //reset password
        $user->password = $reset_password;
        $user->save();
        return response()->json(['message' => 'Password changed successfully'], 200);
    }
}
