<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class AuthCodesController extends Controller
{
    public function send_auth_code(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        //generate an authorization code
        $authCode = mt_rand(100000, 999999);

        //store cache
        Cache::put('auth_code_'.$request->email, $authCode, now()->addMinutes(5));

        //send email
        Mail::to($request->email)->send(new TestEmail($authCode));

        return response()->json([
            'message' => 'Authentication code sent successfully.',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function index()
	{
		//get all data in the auch codes table
		$authCodes = AuthCode::all();
		return response()->json($authCodes);
	}

	/** store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		// input data validation
		$validatedData = $request->validate([
			'code' => 'required|integer',
			'status' => 'required|boolean',
			'count' => 'nullable|integer',
		]);

		// store data
		$authCode = Auth::create($validatedData);
		return response()->json($authCode, 201);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		// get the specified data
		$authCode = AuthCode::findOrFail($id);
		return response()->json($authCode);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param int $id
	 * @return \Illuminate\Http_response
	 */
	public function update(Request $request, $id)
	{
		//input data validation
		$validatedData = $request->validate([
			'code' => 'sometimes|required|integer',
			'status' => 'sometimes|required|boolean',
			'count' => 'nullable|integer',
		]);

		//update data
		$authCode = AuthCode::findOrFail($id);
		$authCode->update($validatedData);

		return response()->json($authCode);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		// delete data
		$authCode = AuthCode::findOrFail($id);
		$authCode->delete();

		return response()->json(['message' => 'Deleted successfully']);

	}
}
