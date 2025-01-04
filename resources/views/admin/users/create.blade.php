@extends('layout.app_user')

@section('content')
    <div class="container-lg mt-5 bg-white p-4">
        <h1 class="text-center text-primary mb-4">Thêm người dùng</h1>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="mt-4 mb-4">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary px-4 py-2">Quay lại danh sách</a>
            </div>
            <div class="form-group mb-3">
                <label for="name">Tên</label>
                <input type="text" class="form-control" id="name" name="name" required style="padding-left: 12px; padding-right: 12px;">
            </div>
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" style="padding-left: 12px; padding-right: 12px;">
            </div>
            <div class="form-group mb-3">
                <label for="password">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" required style="padding-left: 12px; padding-right: 12px;">
            </div>
            <button type="submit" class="btn btn-primary w-100" style="background-color: #007bff; color: white; padding: 10px 0;">Thêm</button>
        </form>
    </div>
@endsection
