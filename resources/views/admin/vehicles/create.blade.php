@extends('layout.app_user')

@section('content')
    <div class="container-lg mt-5 bg-white p-4">
        <h1 class="text-center text-primary mb-4">Thêm xe mới</h1>
        <form action="{{ route('admin.vehicles.store') }}" method="POST">
            @csrf
            <div class="mt-4 mb-4">
                <a href="{{ route('admin.vehicles.index') }}" class="btn btn-secondary px-4 py-2">Quay lại danh sách</a>
            </div>
            <div class="form-group mb-3">
                <label for="type">Phương tiện</label>
                <input type="text" class="form-control" id="type" name="type" required style="padding-left: 12px; padding-right: 12px;">
            </div>
            <div class="form-group mb-3">
                <label for="model">Loại xe</label>
                <input type="text" class="form-control" id="model" name="model" style="padding-left: 12px; padding-right: 12px;">
            </div>
            <div class="form-group mb-3">
                <label for="license_plate">Biển số xe</label>
                <input type="text" class="form-control" id="license_plate" name="license_plate" required style="padding-left: 12px; padding-right: 12px;">
            </div>
            <div class="form-group mb-3">
                <label for="capacity">Sức chứa</label>
                <input type="number" class="form-control" id="capacity" name="capacity" style="padding-left: 12px; padding-right: 12px;">
            </div>
            <div class="form-group mb-3">
                <label for="driver_id">Tài Xế</label>
                <select class="form-control" id="driver_id" name="driver_id" required>
                    <option value="">Chọn Tài Xế</option>
                    @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}" data-img-src="{{ asset('storage/' . $driver->avatar) }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                            {{ $driver->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100" style="background-color: #007bff; color: white; padding: 10px 0;">Thêm</button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            function formatDriver(driver) {
                if (!driver.id) {
                    return driver.text;
                }
                var baseUrl = driver.element.getAttribute('data-img-src');
                var $driver = $(
                    '<span><img src="' + baseUrl + '" class="mr-2 img-avatar" style="width: 30px;" /> ' + driver.text + '</span>'
                );
                return $driver;
            };

            $('#driver_id').select2({
                templateResult: formatDriver,
                templateSelection: formatDriver
            });
        });
    </script>
@endsection
