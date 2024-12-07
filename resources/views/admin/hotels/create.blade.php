@extends('layout.app_user')

@section('content')
    <div class="container-lg mt-5 bg-white p-4 shadow-sm rounded">
        <h1 class="text-center text-primary mb-4">Thêm Khách Sạn</h1>
        <form action="{{ route('admin.hotels.store') }}" method="POST">
            <div class="mt-4 mb-4">
                <a href="{{ route('admin.hotels.index') }}" class="btn btn-secondary px-4 py-2">Quay lại danh sách</a>
            </div>
            @csrf
            <div class="form-group">
                <label for="name">Tên</label>
                <input type="text" class="form-control px-3 py-2" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="address">Địa Chỉ</label>
                <input type="text" class="form-control px-3 py-2" id="address" name="address">
            </div>
            <div class="form-group">
                <label for="stars">Hạng Sao</label>
                <input type="number" class="form-control px-3 py-2" id="stars" name="stars" min="1" max="5">
            </div>
            <div class="form-group">
                <label for="phone">Điện Thoại</label>
                <input type="text" class="form-control px-3 py-2" id="phone" name="phone">
            </div>
            <div class="form-group">
                <label for="description">Mô Tả</label>
                <textarea class="form-control px-3 py-2" id="description" name="description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary px-4 py-2">Thêm</button>
        </form>
    </div>
@endsection

@section('script')

@endsection
