<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\DeveloperBase;

class DeveloperController extends DeveloperBase
{
    //
    public function index(Request $request)
    {
        //
        $user = $request->session()->get('login_developer');
        return view('Home.Developer.index', compact('user'));
    }
}
