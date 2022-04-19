<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Return the user's profile.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return response()->json([
            'code' => 200,
            'message' => [
                'value' => 'User retrieved successfully.',
            ],
            'user' => $request->user(),
        ]);
    }

    /**
     * Register a new user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // Check all fields are present and valid
        $validation = Validator::make($request->all(), [
            'nama' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'jenjang' => 'required|string',
        ]);

        // if validation fails, return error message in JSON format
        if($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->errors(),
                'user' => null,
            ]);
        }

        // If validation passes, create a new user
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
             'role' => 'Siswa',
            'jenjang' => $request->jenjang,
        ]);

        // After creating the user, return the user in JSON format
        return response()->json([
            'code' => 200,
            'message' => [
                'value' => 'User created successfully.',
            ],
            'user' => $user,
        ]);
    }

    /**
     * Login a user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function login(Request $request)
    {
        // Check all fields are present and valid
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // if validation fails, return error message in JSON format
        if($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->errors(),
                'user' => null,
            ]);
        }

        $user = User::where('email', $request->email)->first();
        // Check if user email exists
        // If user email does not exist, return error message in JSON format
        if(!$user) {
            return response()->json([
                'code' => 401,
                'message' => [
                    'value' => 'Email does not exist',
                ],
                'user' => null,
            ]);
        }

        /*if(!$user->verified) {
            return response()->json([
                'code' => 400,
                'message' => 'User not verified',
                'user' => null,
            ]);
        }*/

        // Email exists, then check if password is correct
        // If password is incorrect, return error message in JSON format
        if(!User::checkPassword($request->password, $user->password)) {
            return response()->json([
                'code' => 401,
                'message' => [
                    'value' => 'Password is incorrect',
                ],
                'user' => null,
            ]);
        }

        // If password is correct, attempting to login and return the user with their token in JSON format
        $credential = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($credential)) {
            $user = Auth::user();
            $token = md5( time() ) . '.' . md5($request->email);
            $user->forceFill([
                'api_token' => $token,
            ])->save();
            return response()->json([
                'code' => 200,
                'message' => [
                    'value' => 'Login successful',
                ],
                'user' => $user,
                'token' => $token,
            ]);
        }
    }

    /**
     * Logout a user by deleting their token.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // Delete the user's token
        $request->user()->forceFill([
            'api_token' => null,
        ])->save();

        return response()->json([
            'code' => 200,
            'message' => [
                'value' => 'Logout successful',
            ],
            'user' => null,
        ]);
    }
}
