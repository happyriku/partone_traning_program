<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //creating a new user
    public function store(Request $request)
    {
        try{
            $validated = $request->validate([
                'name' => 'required|string|max:50',
                'birthday' => 'required|date_format:Y-m-d',
                'sex' => 'required|in:woman,man,Non-binary',
                'address' => 'required|string|max:2048',
                'email' => 'required|email|unique:users|max:320',
                'password' => 'required|string|min:8',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('validation failed:', $e->errors());
            throw $e;
        }

        if (!$this->validate_email_info($validated['email']))
        {
            \Log::error('Invalid email format or domain');
            return response()->json(['error' => 'Invalid email format or domain'], 422);
        }

	    //allocate index for sex
        switch ($request->sex)
        {
            case 'woman':
                $validated['sex'] = 0;
                break;
            case 'man':
                $validated['sex'] = 1;
                break;
            case 'Non-binary':
                $validated['sex'] = 2;
                break;
        }

        $user = User::create([
            'name' => $validated['name'],
            'user_id' => $request->cookie('user_id'),
            'birthday' => $validated['birthday'],
            'sex' => $validated['sex'],
            'address' => $validated['address'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        return response()
                ->json($user, 201);
    }


    /**
     * validate email info
     *
     * @param string $email
     * @return bool
     */

    private function validate_email_info(string $email): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            return false;
        return true;
    }
}
