@extends('layout.app_user')

@section('content')
    <div class="container mt-5 d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="row justify-content-center w-100">
            <div class="col-md-6">
                <!-- Form Wrapper with Background -->
                <div class="p-5 bg-light rounded shadow-sm" style="background-color: #f8f9fa;">
                    <div class="d-flex justify-content-center align-items-center mb-4">
                        <h3>{{ __('Đặt lại mật khẩu') }}</h3>
                    </div>

                    <form method="POST" action="{{route('ResetPasswordAction')}}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center mb-3">
                            <button type="submit" class="btn btn-primary w-100">
                                Gửi liên kết đặt lại mật khẩu
                            </button>
                        </div>

                        <div class="d-flex justify-content-center">
                            <a href="{{ route('login') }}" class="text-decoration-none">Quay lại đăng nhập</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
