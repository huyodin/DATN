@extends('layout.app_user')

@section('content')
    <div class="container-lg mt-5 bg-white p-4 shadow-sm rounded">
        <h1 class="text-center text-primary mb-4">Cập Nhật Khách Sạn</h1>
        <form action="{{ route('admin.hotels.update', $hotel->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mt-4 mb-4">
                <a href="{{ route('admin.hotels.index') }}" class="btn btn-secondary px-4 py-2">Quay lại danh sách</a>
            </div>
            <div class="form-group">
                <label for="name">Tên</label>
                <input type="text" class="form-control px-3 py-2" id="name" name="name" value="{{ $hotel->name }}" required>
            </div>

            <div class="form-group">
                <label for="address">Địa Chỉ</label>
                <input type="text" class="form-control px-3 py-2" id="address" name="address" value="{{ $hotel->address }}">
            </div>

            <div class="form-group">
                <label for="stars">Hạng Sao</label>
                <input type="number" class="form-control px-3 py-2" id="stars" name="stars" value="{{ $hotel->stars }}" min="1" max="5">
            </div>

            <div class="form-group">
                <label for="phone">Điện Thoại</label>
                <input type="text" class="form-control px-3 py-2" id="phone" name="phone" value="{{ $hotel->phone }}">
            </div>

            <div class="form-group">
                <label for="description">Mô Tả</label>
                <textarea class="form-control px-3 py-2" id="description" name="description" style="height:100px;">{{ $hotel->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary px-4 py-2 mt-3">Cập Nhật</button>
        </form>
    </div>
@endsection

@section('script')
    <script>
    </script>
@endsection
