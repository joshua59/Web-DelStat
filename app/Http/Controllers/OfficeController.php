<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index()
    {
        return view('page.office.dashboard.main');
    }
    public function auth()
    {
        return view('theme.auth.main');
    }
    public function users()
    {
        return view('page.office.users.main');
    }
}
