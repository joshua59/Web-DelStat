<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('page.home.main');
    }
    // public function show(Request $request, User $user)
    // {
    //     return view('page.home.show', compact('user'));
    // }
}
