<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TestEmail;
use App\Models\AuthCode;
use App\Jobs\DeleteAuthCodeDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AuthCodesController extends Controller
{
    public function send_auth_code(Request $request)
    {
        // validate email
        try{
            $validated = $request->validate([
                'email' => 'required|email|unique:users|max:320',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('validation failed:', $e->errors());
            throw $e;
        }

        //generate an authorization code
        $authCode = mt_rand(100000, 999999);

        //store database
        AuthCode::create([
        'email' => $request->email,
        'code' => $authCode,
        'expires_at' => Carbon::now()->addMinutes(5),
        'user_id' => $request->cookie('user_id'),
        ]);

        DeleteAuthCodeDatabase::dispatch(AuthCode::latest()->first()->id)->delay(now()->addMinutes(5));
        //send email
        Mail::to($request->email)->send(new TestEmail($authCode));

        return response()->json([
            'message' => 'Authentication code sent successfully.'], 200);
    }
}
