<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
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
            'no_hp' => 'required|string|unique:users|min:10|max:15',
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
            'no_hp' => $request->no_hp,
            'password' => bcrypt($request->password),
            'role' => 'Siswa',
            'jenjang' => $request->jenjang,
        ]);

        // After creating the user, return the user in JSON format
        return response()->json([
            'code' => 201,
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
     * Edit user's data excluding password.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editProfile(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'no_hp' => 'required|string|min:10|max:15|unique:users,no_hp,' . Auth::user()->id,
            'jenjang' => 'required',
        ]);

        if($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->errors(),
                'user' => null,
            ]);
        }

        $user = Auth::user();
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->jenjang = $request->jenjang;
        $user->save();
        return response()->json([
            'code' => 200,
            'message' => [
                'value' => 'Profile updated successfully',
            ],
            'user' => $user,
        ]);
    }

    /**
     * Edit user's password only.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function editPassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        if($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validation->errors(),
                'user' => null,
            ]);
        }

        $user = User::find(Auth::user()->id);
        if(!User::checkPassword($request->password, $user->password)){
            return response()->json([
                'code' => 401,
                'message' => [
                    'value' => 'Password is incorrect',
                ],
                'user' => null,
            ]);
        }

        $user->password = bcrypt($request->new_password);
        if($user->save()) {
            return response()->json([
                'code' => 200,
                'message' => [
                    'value' => 'Password updated successfully',
                ],
                'user' => $user,
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
