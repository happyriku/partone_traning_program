<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
                'sex' => 'required|in:0,1,woman, man',
                'address' => 'required|string|max:2048',
                'email' => 'required|email|unique:users|max:320',
                'password' => 'required|string|min:8',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('validation failed:', $e->errors());
            throw $e;
        }

        $validated['sex'] = ($request->sex === 'woman') ? 0 : 1;

        $user = User::create([
            'name' => validated['name'],
            'birthday' => $validated['birthday'],
            'sex' => $validated['sex'],
            'address' => $validated['address'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        return response()->json($user, 201);
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
