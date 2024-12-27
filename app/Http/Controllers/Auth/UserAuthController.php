<?php

namespace App\Http\Controllers\Auth;

use App\Mail\RegisterMail;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserAuthController
{
    public function login() {
        return view('user.auth.login');
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
            return redirect()->route('index');
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
        return redirect()->route('login')->with('success', 'Đăng xuất thành công !!');
    }

    public function register() {
        return view('user.auth.register');
    }

    public function registerAction(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        try {
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'role' => 0,
            ]);

            // Gửi mail
            Mail::to($user->email)->send(new RegisterMail($user));

            return redirect()->route('register')->with('success', 'Tạo tài khoản thành công, Hệ thông đã gửi mail xác nhận tài khoản !!');
        } catch (\Exception $e) {
            \Log::error('Error: ' . $e->getMessage());

            // Chuyển hướng về trang danh sách với thông báo lỗi
            return redirect()->route('register')->with('error', 'Đã xảy ra lỗi!!');
        }
    }

    public function verifyEmail(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        try {
            // Gửi mail
            User::where('email', $request->email)->update([
                'email_verified_at' => Carbon::now()
            ]);

            return redirect()->route('login')->with('success', 'Xác thực tài khoản thành công !!');
        }  catch (\Exception $e) {
            \Log::error('Error: ' . $e->getMessage());

            // Chuyển hướng về trang danh sách với thông báo lỗi
            return redirect()->route('reset_password')->with('error', 'Đã xảy ra lỗi!!');
        }
    }

    public function ResetPassword() {
        return view('user.auth.reset_password');
    }

    public function ResetPasswordAction(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        try {
            // Gửi mail
            $user = User::where('email', $request->email)->firstOrFail();
            $token = Str::random(60);
            $resetUrl = url('/change-password?token=' . $token . "&email=" . $user->email);

            DB::table('password_reset_tokens')->insert([
                'email' => $user->email,
                'token' => $token,
            ]);

            Mail::to($user->email)->send(new ResetPasswordMail($user, $resetUrl));

            return redirect()->route('sendedMail');
        }  catch (\Exception $e) {
            \Log::error('Error: ' . $e->getMessage());

            // Chuyển hướng về trang danh sách với thông báo lỗi
            return redirect()->route('reset_password')->with('error', 'Đã xảy ra lỗi!!');
        }
    }

    public function sendedMail() {
        return view('user.auth.sended_mail');
    }

    public function ChangePassword(Request $request) {
        $data = [
            'email' => $request->email,
            'token' => $request->token,
        ];
        return view('user.auth.change_password')->with('data', $data);
    }

    public function ChangePasswordAction(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required|exists:password_reset_tokens,token',
        ]);
        try {
            User::where('email', $request->email)->update([
                'password' => Hash::make($validatedData['password']),
            ]);

            DB::table('password_reset_tokens')->where([
                'email' => $request->email,
                'token' => $request->token,
            ])->delete();

            return redirect()->route('login')->with('success', 'Thay đổi mật khẩu thành công !!');
        } catch (\Exception $e) {
            \Log::error('Error: ' . $e->getMessage());

            return redirect()->route('change_password')->with('error', 'Đã xảy ra lỗi!!');
        }
    }
}
