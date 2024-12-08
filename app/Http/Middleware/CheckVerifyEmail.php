<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkVerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra nếu user đã xác thực email
        if (auth()->check() && auth()->user()->email_verified_at === null) {
            // Trả về lỗi 403 nếu email chưa được xác thực
            return response()->json(['message' => 'Email not verified'], 403);
        }

        return $next($request);
    }

}
