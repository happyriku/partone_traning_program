<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //Get a list of all users
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    //Get specific user information
    public function show($id)
    {
        $user = User::find($id);
        if (!$user)
            return response()->json(['message' => 'User not found'], 404);
        return response()->json($user);
    }

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

        //create cookieID and userId
        $cookieID = bin2hex(random_bytes(16));
        $userID = uniqid('user_', true);

        $user = User::create([
            'user_id' => $userID,
            'name' => $validated['name'],
            'birthday' => $validated['birthday'],
            'sex' => $validated['sex'],
            'address' => $validated['address'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        return response()
                ->json($user, 201)
                ->cookie('cookieID', $cookieID, 60 * 24 * 7);
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

    //update user info
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user)
            return response()->json(['message' => 'User not found'], 404);

        $validated = $request->validate([
            'password' => 'sometimes|string|min:8',
        ]);

        $user->update($validated);
        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user)
            return response()->json(['message' => 'User not found'], 404);
        $user->delete();
        return response()->json(['message' => 'User deleted successfuly']);
    }
}
