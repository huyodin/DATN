@extends('layout.app_user')

@section('content')
    <div class="container-lg mt-5 bg-white p-4 shadow-sm rounded">
        <h1 class="text-center text-primary mb-4">Thêm Tài Xế</h1>
        <form action="{{ route('admin.drivers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mt-4 mb-4">
                <a href="{{ route('admin.drivers.index') }}" class="btn btn-secondary px-4 py-2">Quay lại danh sách</a>
            </div>
            <!-- Tên -->
            <div class="form-group mb-3">
                <label for="name" class="form-label">Tên</label>
                <input type="text" class="form-control px-3 py-2" id="name" name="name" placeholder="Nhập tên tài xế" required>
            </div>

            <!-- Avatar -->
            <div class="form-group mb-3">
                <label for="avatar" class="form-label">Avatar</label>
                <input type="file" class="form-control px-3 py-2" id="avatar" name="avatar" accept="image/*" onchange="previewAvatar(event)">
                <div class="mt-3">
                    <img id="avatarPreview" src="" alt="Avatar Preview" class="rounded-circle border" width="100" style="display: none;">
                </div>
            </div>

            <!-- Điện Thoại -->
            <div class="form-group mb-4">
                <label for="phone" class="form-label">Điện Thoại</label>
                <input type="text" class="form-control px-3 py-2" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
            </div>

            <!-- Nút Thêm -->
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4 py-2">+ Thêm</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        function previewAvatar(event) {
            const input = event.target;
            const reader = new FileReader();

            reader.onload = function () {
                const output = document.getElementById('avatarPreview');
                output.src = reader.result;
                output.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection
