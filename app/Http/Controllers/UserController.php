<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UserApiController;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $user = User::
            where('nama','like','%'.$request->keywords.'%')->
            paginate(10);
            return view('page.users.list', compact('user'));
        }
        return view('page.users.main');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.users.modal', ['user' => new User]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'nama' => 'required|string',
                'email' => 'required|email|unique:users',
                'no_hp' => 'required|string|unique:users|min:10|max:15',
                'password' => 'required',
                'jenjang' => 'required|string',
                'foto_profil' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            ]);
        }catch (Exception $e) {
            return response()->json([
                'alert' => 'error',
                'message' => 'Maaf, sepertinya ada yang salah, silahkan coba lagi.',
            ]);
        }
        try {
            $foto_profil = request()->file('foto_profil')->store("users");
            $user = new User;
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->no_hp = $request->no_hp;
            $user->password = bcrypt('password');
            $user->jenjang = $request->jenjang;
            $user->role = $request->role;
            $user->foto_profil = $foto_profil;
            $user->save();
            return response()->json([
                'alert' => 'success',
                'message' => 'User '. $request->nama . ' telah didaftarkan',
            ]);
        }catch (Exception $e) {
            return response()->json([
                'alert' => 'error',
                'message' => 'Maaf, sepertinya ada yang salah, silahkan coba lagi.',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('page.users.modal', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try {
            if(request()->file('foto_profil')){
                Storage::delete($user->foto_profil);
                $foto_profil = request()->file('foto_profil')->store("user");
                $user->foto_profil = $foto_profil;
            }
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->no_hp = $request->no_hp;
            $user->password = bcrypt($request->password);
            $user->jenjang = $request->jenjang;
            $user->role = $request->role;

            $user->update();
            return response()->json([
                'alert' => 'success',
                'message' => 'User '. $request->nama . ' telah di Update',
            ]);
        }catch (Exception $e) {
            return response()->json([
                'alert' => 'error',
                'message' => 'Maaf, sepertinya ada kesalahan, silahkan coba lagi.',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            Storage::delete($user->foto_profil);
            $user->delete();
            return response()->json([
                'alert' => 'success',
                'message' => 'User '. $user->nama . ' Dihapus',
            ]);
        }catch (Exception $e) {
            return response()->json([
                'alert' => 'error',
                'message' => 'Maaf, sepertinya ada kesalahan, silahkan coba lagi.',
            ]);
        }
    }
}
