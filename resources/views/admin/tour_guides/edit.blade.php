@extends('layout.app_user')

@section('content')
    <div class="container-lg mt-5 bg-white p-4 shadow-sm rounded">
        <h1 class="text-center text-primary mb-4">Cập Nhật Hướng Dẫn Viên</h1>
        <form action="{{ route('admin.tour_guides.update', $tourGuide->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mt-4 mb-4">
                <a href="{{ route('admin.tour_guides.index') }}" class="btn btn-secondary px-4 py-2">Quay lại danh sách</a>
            </div>
            <div class="form-group">
                <label for="name">Tên</label>
                <input type="text" class="form-control px-3" id="name" name="name" value="{{ $tourGuide->name }}" required>
            </div>
            <div class="form-group">
                <label for="avatar">Ảnh Đại Diện</label>
                <input type="file" class="form-control px-3" id="avatar" name="avatar" onchange="previewAvatar(event)">
                @if($tourGuide->avatar)
                    <img id="avatarPreview" src="{{ \Storage::url($tourGuide->avatar) }}" alt="Avatar" width="100" class="mt-2">
                @else
                    <img id="avatarPreview" src="" alt="Xem Trước Avatar" width="100" class="mt-2" style="display:none;">
                @endif
            </div>
            <div class="form-group">
                <label for="phone">Điện Thoại</label>
                <input type="text" class="form-control px-3" id="phone" name="phone" value="{{ $tourGuide->phone }}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control px-3" id="email" name="email" value="{{ $tourGuide->email }}">
            </div>
            <div class="form-group">
                <label for="bio">Tiểu Sử</label>
                <textarea class="form-control px-3" id="bio" name="bio">{{ $tourGuide->bio }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary px-4 py-2">Cập Nhật</button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        function previewAvatar(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function(){
                var dataURL = reader.result;
                var output = document.getElementById('avatarPreview');
                output.src = dataURL;
                output.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection
