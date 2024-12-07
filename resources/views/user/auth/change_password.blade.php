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

                    <form method="POST" action="{{route('ChangePasswordAction')}}">
                        @csrf
                        <input type="hidden" name="email" value="{{ $data['email'] }}">
                        <input type="hidden" name="token" value="{{ $data['token'] }}">

                        <div class="mb-4">
                            <label for="password" class="form-label">Mật khẩu mới</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label">Xác nhận mật khẩu</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="d-flex justify-content-center mb-3">
                            <button type="submit" class="btn btn-primary w-100">
                                Đặt lại mật khẩu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
