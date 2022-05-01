<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
// use App\Mail\Office\WelcomeMail;
use Exception;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:web')->except('do_logout');
    }
    public function index()
    {
        return view('page.auth.main');
    }
    public function do_login(Request $request)
    {
        $datas=$request->only('email', 'password');
        if(Auth::attempt($datas)){
            return response()->json([
                'alert' => 'success',
                'message' => 'Selamat datang '. Auth::guard('web')->user()->nama,
            ]);
        }else{
            return response()->json([
                'alert' => 'error',
                'message' => 'Maaf, sepertinya ada kesalahan, silahkan coba lagi.',
            ]);
        }
    }
    public function do_register(Request $request)
    {
        //
    }
    public function do_logout()
    {
        $employee = Auth::guard('web')->user();
        Auth::logout($employee);
        return redirect()->route('auth');
    }
}

