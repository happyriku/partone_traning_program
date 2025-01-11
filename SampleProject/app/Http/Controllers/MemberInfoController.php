<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MemberInfoController
{
    public function find_and_return_member_info(Request $request)
    {
        $user_id = $request->cookie('user_id');
        $user = User::where('user_id', $user_id)->first();
        if (!$user)
            return response()->json(['message' => 'No matching member information found'], 400);
        $fields = $request->input('fields', []);
        if (!is_array($fields))
            return response()->json(['message' => 'Invalid fields request.'], 400);
        $user_data = $user->only($fields);
        return response()->json($user_data, 200);
    }
}
