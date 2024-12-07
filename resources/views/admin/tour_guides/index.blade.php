@extends('layout.app_user')

@section('content')
    <div class="container-lg mt-5 bg-white p-4 shadow-sm rounded">
        <h1 class="text-center text-primary mb-4">Danh Sách Hướng Dẫn Viên</h1>
        <a href="{{ route('admin.tour_guides.create') }}" class="btn btn-primary px-4 py-2 mb-3">Thêm Hướng Dẫn Viên</a>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Ảnh Đại Diện</th>
                <th>Điện Thoại</th>
                <th>Email</th>
                <th>Tiểu Sử</th>
                <th>Hành Động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tourGuides as $index => $tourGuide)
                <tr>
                    <td>{{ $tourGuide->id }}</td>
                    <td>{{ $tourGuide->name }}</td>
                    <td>
                        @if($tourGuide->avatar)
                            <img src="{{ \Storage::url($tourGuide->avatar) }}" alt="Avatar" width="50">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $tourGuide->phone }}</td>
                    <td>{{ $tourGuide->email }}</td>
                    <td>{{ $tourGuide->bio }}</td>
                    <td style="text-align: left; white-space: nowrap;">
                        <a href="{{ route('admin.tour_guides.edit', $tourGuide->id) }}" class="btn btn-warning px-4 py-2">Chỉnh Sửa</a>
                        <button type="button" class="btn btn-danger px-4 py-2" id="showDeleteModal{{ $index }}">Xóa</button>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteConfirmationModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel{{ $index }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header justify-content-center">
                                        <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $index }}">Xác nhận xóa hướng dẫn viên</h5>
                                    </div>
                                    <div class="modal-body justify-content-center">
                                        <h6 class="text-center">Bạn có chắc chắn muốn xóa hướng dẫn viên này không?</h6>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn-secondary px-4 py-2" id="close{{ $index }}" data-dismiss="modal">Hủy</button>
                                        <button type="button" class="btn btn-primary px-4 py-2 confirmDelete" data-id="{{ $index }}">Đồng ý</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Form -->
                        <form action="{{ route('admin.tour_guides.destroy', $tourGuide->id) }}" method="POST" style="display:none;" id="deleteForm{{ $index }}">
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
            @foreach($tourGuides as $index => $tourGuide)
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
