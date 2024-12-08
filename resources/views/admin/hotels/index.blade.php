@extends('layout.app_user')

@section('content')
    <div class="container-lg mt-5 bg-white p-4 shadow-sm rounded">
        <h1 class="text-center text-primary mb-4">Danh Sách Khách Sạn</h1>
        <a href="{{ route('admin.hotels.create') }}" class="btn btn-success mb-3 px-4 py-2">Thêm Khách Sạn</a>

        <div id="message-err" class="text-danger mt-4"></div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Tên Khách Sạn</th>
                <th>Địa Chỉ</th>
                <th>Đánh Giá</th>
                <th>Số Điện Thoại</th>
                <th>Mô Tả</th>
                <th>Thao Tác</th>
            </tr>
            </thead>
            <tbody>
            @foreach($hotels as $index => $hotel)
                <tr>
                    <td>{{ $hotel->name }}</td>
                    <td>{{ $hotel->address ?? 'N/A' }}</td>
                    <td>{{ $hotel->stars ?? 'N/A' }} <i class="fa fa-star" style="color: rgb(255, 242, 0)"></i></td>
                    <td>{{ $hotel->phone ?? 'N/A' }}</td>
                    <td>{{ $hotel->description ?? 'N/A' }}</td>
                    <td style="text-align: left; white-space: nowrap;">
                        <a href="{{ route('admin.hotels.edit', ['hotel' => $hotel->id]) }}" class="btn btn-warning px-4 py-2">Chỉnh Sửa</a>
                        <button type="button" class="btn btn-danger px-4 py-2" id="showDeleteModal{{ $index }}">Xóa</button>

                        <!-- Modal for Deletion Confirmation -->
                        <div class="modal fade" id="deleteConfirmationModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel{{ $index }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header justify-content-center">
                                        <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $index }}">Xác Nhận Xóa Khách Sạn</h5>
                                    </div>
                                    <div class="modal-body justify-content-center">
                                        <h6 class="text-center">Bạn có chắc chắn muốn xóa khách sạn này không?</h6>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn-secondary px-4 py-2" id="close{{ $index }}" data-dismiss="modal">Hủy</button>
                                        <button type="button" class="btn btn-danger px-4 py-2 confirmDelete" data-id="{{ $index }}">Đồng Ý</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden form for Deletion -->
                        <form action="{{ route('admin.hotels.destroy', ['hotel' => $hotel->id]) }}" method="POST" style="display:none;" id="deleteForm{{ $index }}">
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
            @foreach($hotels as $index => $hotel)
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
