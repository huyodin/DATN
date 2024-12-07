@extends('layout.app_user')

@section('content')
    <div class="container-lg mt-5 bg-white p-4 shadow-sm rounded">
        <h1 class="text-center text-primary mb-4">Danh Sách Tài Xế</h1>
        <a href="{{ route('admin.drivers.create') }}" class="btn btn-tour mb-3 px-4 py-2" style="background-color: #28a745; color: white; padding: 10px 20px;">Thêm Tài Xế</a>
        <table class="table table-bordered">
            <thead class="thead-light">
            <tr>
                <th>Tên</th>
                <th>Avatar</th>
                <th>Điện Thoại</th>
                <th>Hành Động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($drivers as $index => $driver)
                <tr>
                    <td>{{ $driver->name }}</td>
                    <td>
                        @if($driver->avatar)
                            <img src="{{ asset('storage/' . $driver->avatar) }}" alt="Avatar" width="100">
                        @else
                            <img src="https://via.placeholder.com/100" alt="Default Avatar" width="100">
                        @endif
                    </td>
                    <td>{{ $driver->phone }}</td>
                    <td>
                        <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn btn-warning px-4 py-2" style="background-color: #ffc107; color: white; padding: 10px 20px;">Chỉnh Sửa</a>
                        <button type="button" class="btn btn-danger px-4 py-2" id="showDeleteModal{{ $index }}" style="background-color: #dc3545; color: white; padding: 10px 20px;">Xóa</button>

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteConfirmationModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel{{ $index }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header justify-content-center">
                                        <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $index }}">Xác nhận xóa tài xế</h5>
                                    </div>
                                    <div class="modal-body justify-content-center">
                                        <h6 class="text-center">Bạn có chắc chắn muốn xóa tài xế này không?</h6>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn-secondary px-4 py-2" id="close{{ $index }}" data-dismiss="modal" style="padding: 10px 20px;">Hủy</button>
                                        <button type="button" class="btn btn-danger px-4 py-2 confirmDelete" data-id="{{ $index }}" style="background-color: #dc3545; color: white; padding: 10px 20px;">Đồng ý</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden form for deletion -->
                        <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="POST" style="display:none;" id="deleteForm{{ $index }}">
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
            @foreach($drivers as $index => $driver)
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
