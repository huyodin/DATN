@extends('layout.app_user')

@section('content')
    <div class="container-lg mt-5 bg-white p-4 shadow-sm rounded">
        <h1 class="text-center text-primary mb-4">Danh sách khu vực</h1>
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.areanew.create') }}" class="btn btn-tour text-white" style="background-color: #007bff;">Thêm khu vực mới</a>
        </div>
        <table class="table table-bordered">
            <thead class="bg-light text-center">
            <tr>
                <th class="w-75">Tên khu vực</th>
                <th class="w-25">Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($areas as $index => $area)
                <tr>
                    <td class="align-middle">{{ $area->name }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.areanew.edit', $area->id) }}" class="btn btn-sm text-white" style="background-color: #28a745;">Sửa</a>
                        <button type="button" class="btn btn-sm text-white" style="background-color: #dc3545;" id="showDeleteModal{{ $index }}">Xóa</button>

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteConfirmationModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel{{ $index }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning justify-content-center">
                                        <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $index }}">Xác nhận xóa khu vực</h5>
                                    </div>
                                    <div class="modal-body text-center">
                                        <p class="text-danger">Bạn có chắc chắn muốn xóa khu vực này không?</p>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn-secondary" id="close{{ $index }}" data-dismiss="modal">Hủy</button>
                                        <button type="button" class="btn btn-danger confirmDelete" data-id="{{ $index }}">Đồng ý</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden form for deletion -->
                        <form action="{{ route('admin.areanew.destroy', $area->id) }}" method="POST" style="display:none;" id="deleteForm{{ $index }}">
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
            @foreach($areas as $index => $area)
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
