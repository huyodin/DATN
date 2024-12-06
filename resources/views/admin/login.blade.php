@extends('layout.app_user')

@section('content')
    <div class="container mt-5 d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="row justify-content-center w-100">
            <div class="col-md-6">
                <!-- Form Wrapper with Background -->
                <div class="p-5 bg-light rounded shadow-sm" style="background-color: #f8f9fa;">
                    <div class="d-flex justify-content-center align-items-center mb-4">
                        <h3>Đăng nhập quản trị hệ thống</h3>
                    </div>

                    <form method="POST" action="{{ route('admin.login.action') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Ghi nhớ
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mb-3">
                            <button type="submit" class="btn btn-primary w-100">
                                Đăng nhập
                            </button>
                        </div>

                        <!-- Forgot Password Link -->
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('reset_password') }}" class="text-decoration-none">Quên mật khẩu?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
