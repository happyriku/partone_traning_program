<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\PasswordResetEmail;

class PasswordResetController extends Controller
{
    public function send_password_reset_link(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if (!$user)
            return response()->json([
                'message' => 'This email address is not linked to a Uzone account']);

        $token = Hash::make(Str::random(60));
        $reset_url = 'http://localhost:8000/password-reset/'.$token;
        //send email
        Mail::to($request->email)->send(new PasswordResetEmail($reset_url));

        return response()->json([
            'message' => 'Password reset url sent successfully.'], 200);
    }
}
