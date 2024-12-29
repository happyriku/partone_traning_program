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
	
	// Get specific user information
	public function show($id)
	{
		$user = User::find($id);
		if (!$user)
			return response()->json(['message'=> 'User not found'], 404);
		return response()->json($user);
	}

	//creating a new user
	public function store(Request $request)
	{
		$validated = $request->validate([
			'name'=> 'required|string|max:255', 
			'email'=> 'required|email|unique:users', 
			'password' => 'required|string|min:8',
		]);

		$user = User::create([
		'name'=> $validated['name'],
		'email'=> $validated['email'],
		'password'=> bcrypt($validated['password']),
		]);

		return response()->json($user, 201);
	}

	//update user info
	public function update(Request $request, $id)
	{
		$user = User::find($id);
		if (!$user)
			return response()->json(['message'=> 'User not found'], 404);

		$validated = $request->validate([
			'name'=> 'sometimes|string|max:255',
			'email'=> 'sometimes|email|unique:users, email,'. $id,
			'password'=> 'sometimes|string|min:8',
		]);

		$user->update($validated);
		return response()->json($user);
	}

	public function destroy($id)
	{
		$user = User::find($id);
		if (!$user)
			return response()->json(['message'=> 'User not found'], 404);
		$user->delete();
		return response()->json(['message'=> 'User deleted successfully']);
	}
}
