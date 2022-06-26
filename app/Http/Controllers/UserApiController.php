<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Mail\Message;

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
            'message' => 'User retrieved successfully.',
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
            'password' => 'required',
            'jenjang' => 'string',
            'foto_profil' => 'image|mimes:jpeg,png,jpg',
        ]);

        // if validation fails, return error message in JSON format
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => 'Bad Request',
                'errors' => $validation->errors(),
                'user' => null,
            ]);
        }

        // If validation passes, create a new user
        $user = new User();
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->password = bcrypt($request->password);
        /*$user->jenjang = $request->jenjang;*/
        $user->role = User::$ROLE_SISWA;
        $user->foto_profil = User::$FILE_DESTINATION . '/' . 'default.jpg';

        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $extension = $file->getClientOriginalExtension();
            $filename = preg_replace('/\s+/', '', $request->nama) . '-' . $user->id . '.' . $extension;
            $file->move(User::$FILE_DESTINATION, $filename);

            $user->foto_profil = User::$FILE_DESTINATION . '/' . $filename;
        }

        $user->save();

        // After creating the user, return the user in JSON format
        return response()->json([
            'code' => 201,
            'message' => 'Register berhasil.',
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
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => 'Bad Request',
                'errors' => $validation->errors(),
                'user' => null,
            ]);
        }

        $user = User::where('email', $request->email)->first();
        // Check if user email exists
        // If user email does not exist, return error message in JSON format
        if (!$user) {
            return response()->json([
                'code' => 401,
                'message' => 'Email tersebut tidak terdaftar.',
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
        if (!User::checkPassword($request->password, $user->password)) {
            return response()->json([
                'code' => 401,
                'message' => 'Password salah.',
                'user' => null,
            ]);
        }

        // If password is correct, attempting to login and return the user with their token in JSON format
        $credential = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credential)) {
            $user = Auth::user();
            $token = md5(time()) . '.' . md5($request->email);
            $user->forceFill([
                'api_token' => $token,
            ])->save();
            return response()->json([
                'code' => 200,
                'message' => 'Login berhasil.',
                'user' => $user,
                'token' => $token,
            ]);
        }
    }

    public function forgotPassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => 'Bad Request',
                'errors' => $validation->errors(),
                'user' => null,
            ]);
        }
        try {
            $status = Password::sendResetLink($request->only('email'));
            switch ($status) {
                case Password::RESET_LINK_SENT:
                    return response()->json([
                        'code' => 200,
                        'message' => 'Link reset password telah dikirim ke email anda.',
                        'user' => null,
                    ]);
                case Password::INVALID_USER:
                    return response()->json([
                        'code' => 400,
                        'message' => 'Email tersebut tidak terdaftar.',
                        'errors' => [
                            'email' => [
                                'Email tersebut tidak terdaftar.',
                            ],
                        ],
                        'user' => null,
                    ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Terjadi kesalahan.',
                'errors' => $e->getMessage(),
                'user' => null,
            ]);
        }
    }

    public function changePassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);
        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => 'Bad Request',
                'errors' => $validation->errors(),
                'user' => null,
            ]);
        }

        try {
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user) use ($request) {
                    $user->forceFill([
                        'password' => bcrypt($request->password),
                    ])->save();
                    /*event(new PasswordReset($user));*/
                }
            );
            switch ($status) {
                case Password::PASSWORD_RESET:
                    return response()->json([
                        'code' => 200,
                        'message' => 'Password berhasil diubah.',
                        'user' => null,
                    ]);
                case Password::INVALID_TOKEN:
                    return response()->json([
                        'code' => 401,
                        'message' => 'Token tidak valid.',
                        'user' => null,
                    ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Terjadi kesalahan.',
                'errors' => $e->getMessage(),
                'user' => null,
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
            'foto_profil' => 'image|mimes:jpeg,png,jpg',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => 'Gagal meng-update profil.',
                'errors' => $validation->errors(),
                'user' => null,
            ]);
        }

        $user = Auth::user();
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->jenjang = $request->jenjang;

        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $extension = $file->getClientOriginalExtension();
            $filename = preg_replace('/\s+/', '', $request->nama) . '-' . $user->id . '-' . date("d-m-Y_H-i-s") . '.' . $extension;

            if ($user->foto_profil == User::$FILE_DESTINATION . '/' . 'default.jpg') {
                $user->foto_profil = User::$FILE_DESTINATION . '/' . $filename;
            } else {
                if(file_exists($user->foto_profil)) {
                    unlink($user->foto_profil);
                }
                $user->foto_profil = User::$FILE_DESTINATION . '/' . $filename;
            }

            $file->move(User::$FILE_DESTINATION, $filename);
            $user->foto_profil = User::$FILE_DESTINATION . '/' . $filename;
        }

        $user->update();
        return response()->json([
            'code' => 200,
            'message' => 'Profil berhasil di-update.',
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
            'new_password' => 'required|min:8|confirmed', // name of fields must be new_password and new_password_confirmation
        ]);

        if ($validation->fails()) {
            return response()->json([
                'code' => 400,
                'message' => 'Gagal meng-update password.',
                'errors' => $validation->errors(),
                'user' => null,
            ]);
        }

        $user = User::find(Auth::user()->id);
        if (!User::checkPassword($request->password, $user->password)) {
            return response()->json([
                'code' => 400,
                'message' => "Gagal meng-update password.",
                'errors' => [
                    'password' => [
                        'Password salah.'
                    ],
                ],
                'user' => null,
            ]);
        }

        $user->password = bcrypt($request->new_password);
        if ($user->save()) {
            return response()->json([
                'code' => 200,
                'message' => 'Password berhasil di-update.',
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
            'message' => 'Logout berhasil.',
            'user' => null,
        ]);
    }

    /**
     * This is used to get all users depending on the role.
     * If the user that invokes this method is 'Siswa' then it will get all the users that are 'Dosen'
     * If the user that invokes this method is 'Dosen' then it will get all the users that are 'Siswa'
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function findUsersByRole()
    {
        if (Auth::user()->role == User::$ROLE_SISWA) {
            $listUser = User::where('role', User::$ROLE_DOSEN)->get();
            return response()->json([
                'code' => 200,
                'message' => 'List of users retrieved successfully.',
                'list_user' => $listUser,
            ]);
        }

        if (Auth::user()->role == User::$ROLE_DOSEN) {
            $listUser = User::where('role', User::$ROLE_SISWA)->get();
            return response()->json([
                'code' => 200,
                'message' => 'List of users retrieved successfully.',
                'list_user' => $listUser,
            ]);
        }

        return response()->json([
            'code' => 401,
            'message' => 'You are not authorized to access this resource.',
            'list_user' => null,
        ]);
    }
}
