@extends('layout.app_user')

@section('content')
    <div class="container-lg mt-5 bg-white p-4 shadow-sm rounded">
        <h1 class="text-center text-primary mb-4">Sửa Khu Vực</h1>

        <form action="{{ route('admin.areanew.update', $area->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            @csrf
            @method('PUT')

            <!-- Tên Khu Vực -->
            <div class="form-group mb-3">
                <label for="name" class="form-label">Tên Khu Vực:</label>
                <input
                    type="text"
                    class="form-control px-3"
                    id="name"
                    name="name"
                    value="{{ $area->name }}"
                    required
                    placeholder="Nhập tên khu vực">
                <div class="invalid-feedback">Vui lòng nhập tên khu vực.</div>
            </div>

            <!-- Hình Ảnh -->
            <div class="form-group mb-4">
                <label for="thumbnail" class="form-label">Hình Ảnh:</label>
                <input
                    type="file"
                    class="form-control-file"
                    id="thumbnail"
                    name="thumbnail"
                    accept="image/*"
                    onchange="previewImage(event)">
                <div class="mt-3">
                    @if($area->thumbnail)
                        <img
                            id="preview"
                            src="{{ asset('storage/' . $area->thumbnail) }}"
                            alt="Preview"
                            class="img-thumbnail"
                            style="max-width: 100%; height: auto;">
                    @else
                        <img
                            id="preview"
                            src=""
                            alt="Preview"
                            class="img-thumbnail"
                            style="max-width: 100%; height: auto; display: none;">
                    @endif
                </div>
            </div>

            <!-- Nút cập nhật -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary px-5 py-2">Cập Nhật</button>
            </div>
        </form>

        <!-- Nút quay lại -->
        <div class="text-center mt-4">
            <a href="{{ route('admin.areanew.index') }}" class="btn btn-secondary px-4 py-2">Quay lại danh sách</a>
        </div>
    </div>

    <script>
        // Hiển thị ảnh xem trước
        function previewImage(event) {
            const reader = new FileReader();
            const preview = document.getElementById('preview');

            reader.onload = function() {
                preview.src = reader.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(event.target.files[0]);
        }

        // Bootstrap validation
        (function () {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
@endsection
