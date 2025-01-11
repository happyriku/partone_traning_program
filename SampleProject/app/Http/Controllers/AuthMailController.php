<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuthCode;
use Carbon\Carbon;

class AuthMailController extends Controller
{
    public function verify_email_address(Request $request)
    {
        $code = $request->code;
        $user_id = $request->cookie('user_id');

        $authcode = AuthCode::where('code', $code)
                        ->where('expires_at', '>', Carbon::now())
                        ->first();
        if ($authcode)
            return response()->json(['message' => 'Email verification successful.'], 200);
        else
        {
            AuthCode::where('user_id', $user_id)->delete();
            return response()->json(['message' => 'Email verification failed.'], 400);
        }
    }
}
