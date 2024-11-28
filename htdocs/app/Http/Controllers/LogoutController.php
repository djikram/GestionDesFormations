<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Session::flush();

        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }

}
