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
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Xác thực người dùng
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return redirect()->route('admin.statistics.index');
        }

        // Xác thực lỗi
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        // Đăng xuất
        Auth::logout();

        // Chuyển người dùng đến màn login
        return redirect()->route('admin.login')->with('success', 'Đăng xuất thành công !!');
    }
}
