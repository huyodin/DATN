@extends('layout.app_user')

@section('content')
    <div class="container-lg mt-5 bg-white p-4">
        <h1 class="text-center text-primary mb-4">Danh sách xe</h1>
        <a href="{{ route('admin.vehicles.create') }}" class="btn btn-tour mb-3" style="background-color: #28a745; color: white; padding: 10px 20px;">Thêm xe mới</a>
        <table class="table">
            <thead>
            <tr>
                <th>Phương tiện</th>
                <th>Loại xe</th>
                <th>Biển số xe</th>
                <th>Sức chứa</th>
                <th>Tài xế</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($vehicles as $index => $vehicle)
                <tr>
                    <td>{{ $vehicle->type }}</td>
                    <td>{{ $vehicle->model }}</td>
                    <td>{{ $vehicle->license_plate }}</td>
                    <td>{{ $vehicle->capacity }}</td>
                    <td>
                        @if($vehicle->driver)
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/' . $vehicle->driver->avatar) }}" alt="Avatar" width="50" height="50" class="rounded-circle mr-2">
                                <span>{{ $vehicle->driver->name }}</span>
                            </div>
                        @else
                            <span>Chưa Có Tài Xế</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="btn btn-primary btn-sm" style="background-color: #007bff; color: white; padding: 5px 10px;">Sửa</a>
                        <button type="button" class="btn btn-danger btn-sm" id="showDeleteModal{{ $index }}" style="background-color: #dc3545; color: white; padding: 5px 10px;">Xóa</button>

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteConfirmationModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel{{ $index }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header justify-content-center">
                                        <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $index }}">Xác nhận xóa phương tiện</h5>
                                    </div>
                                    <div class="modal-body justify-content-center">
                                        <h6 class="text-center">Bạn có chắc chắn muốn xóa phương tiện này không?</h6>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn-secondary" id="close{{ $index }}" data-dismiss="modal" style="padding: 5px 10px;">Hủy</button>
                                        <button type="button" class="btn btn-primary confirmDelete" data-id="{{ $index }}" style="background-color: #007bff; color: white; padding: 5px 10px;">Đồng ý</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden form for deletion -->
                        <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" style="display:none;" id="deleteForm{{ $index }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($vehicles as $index => $vehicle)
            document.getElementById(`showDeleteModal{{ $index }}`).addEventListener('click', function() {
                $(`#deleteConfirmationModal{{ $index }}`).modal('show');
            });

            document.querySelector(`#deleteConfirmationModal{{ $index }} .confirmDelete`).addEventListener('click', function() {
                const form = document.getElementById(`deleteForm{{ $index }}`);
                form.submit();
            });

            document.querySelector(`#close{{ $index }}`).addEventListener('click', function() {
                $(`#deleteConfirmationModal{{ $index }}`).modal('hide');
            });
            @endforeach
        });
    </script>
@endsection
