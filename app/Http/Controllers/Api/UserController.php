<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Hash;
use Auth;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register(Request $request)
    {
        $user = new User;
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->save();
        return response()->json([
            'message' => 'User Register Successfully !',
            'User' => $user,
        ]);
    }
    public function loginUser(Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {

            return Response(['message' => $validator->errors()], 401);
        }

        if (Auth::attempt($request->all())) {

            $user = Auth::user();

            $success = $user->createToken('MyApp')->plainTextToken;

            return Response(['token' => $success], 200);
        } else {

            return Response(['message' => 'email or password wrong'], 401);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function userDetails(): Response
    {
        if (Auth::check()) {

            $user = Auth::user();

            return Response(['data' => $user], 200);
        } else {

            return Response(['data' => 'Unauthorized'], 401);
        }

    }
    /**
     * Display the specified resource.
     */
    public function logout(): Response
    {
        $user = Auth::user();

        $user->currentAccessToken()->delete();

        return Response(['data' => 'User Logout successfully.'], 200);
    }
}
