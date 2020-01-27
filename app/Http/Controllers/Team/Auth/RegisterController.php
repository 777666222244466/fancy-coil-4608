<?php

namespace App\Http\Controllers\Team\Auth;

use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('welcome');
    }

    public function register()
    {
        return redirect()->route('team.register');
    }
}
