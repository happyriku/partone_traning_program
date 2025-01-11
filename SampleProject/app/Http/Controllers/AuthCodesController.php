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

	// /** store a newly created resource in storage.
	//  *
    //  * @param \Illuminate\Http\Request $request
	//  * @return \Illuminate\Http\Response
	//  */
	// public function store(Request $request)
	// {
	// 	// input data validation
	// 	$validatedData = $request->validate([
	// 		'code' => 'required|integer',
	// 		'status' => 'required|boolean',
	// 		'count' => 'nullable|integer',
	// 	]);

	// 	// store data
	// 	$authCode = Auth::create($validatedData);
	// 	return response()->json($authCode, 201);
	// }

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
