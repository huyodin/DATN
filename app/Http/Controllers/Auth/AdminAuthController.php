<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController
{
    public function login() {
        return view('admin.login');
    }

    public function action(Request $request) {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            // Authentication passed, redirect to a specific page (e.g., dashboard)
            return redirect()->route('admin.statistics.index');
        }

        // Authentication failed, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        // Log out the user
        Auth::logout();

        // Redirect to the login page
        return redirect()->route('admin.login')->with('success', 'Đăng xuất thành công !!');
    }
}
