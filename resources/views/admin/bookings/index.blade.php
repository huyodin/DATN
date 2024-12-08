@extends('layout.app_user')

@section('content')
    <div class="container my-5 p-4 shadow bg-white">
        <h1 class="text-center mb-4">Danh sách Tour đã đặt</h1>

        <!-- Tìm kiếm -->
        <form method="GET" action="{{ route('admin.bookings.index') }}" class="text-center mb-4">
            <div class="input-group justify-content-center">
                <input type="text" name="query" class="form-control" placeholder="Tìm kiếm theo Tour, Mã đơn, Trạng thái thanh toán..." value="{{ request('query') }}" style="max-width: 400px;">
                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
            </div>
        </form>

        @if($bookings->isEmpty())
            <div class="alert alert-warning text-center">Không có booking.</div>
        @else
            <div style="overflow-x: auto;">
                <table class="table table-hover table-bordered" style="background-color: #f9f9f9; border: 1px solid #ddd;">
                    <thead class="thead-light">
                    <tr>
                        <th>Khách hàng</th>
                        <th>Tour</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Khu vực</th>
                        <th>Khách sạn</th>
                        <th>Phương tiện</th>
                        <th>Hướng dẫn viên</th>
                        <th>Số người lớn</th>
                        <th>Số trẻ em</th>
                        <th>Tổng giá</th>
                        <th>Mã đơn</th>
                        <th>Thời gian đặt tour</th>
                        <th>Trạng thái thanh toán</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bookings as $index => $booking)
                        <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-light' }}">
                            <td>{{ $booking->user->name }}</td>
                            <td>{{ $booking->tour->name }}</td>
                            <td>{{ $booking->start_date }}</td>
                            <td>{{ $booking->end_date }}</td>
                            <td>{{ $booking->tour->area->name ?? 'N/A' }}</td>
                            <td>{{ $booking->tour->hotel->name ?? 'N/A' }}</td>
                            <td>{{ $booking->tour->vehicle->type ?? 'N/A' }}</td>
                            <td>{{ $booking->tour->guide->name ?? 'N/A' }}</td>
                            <td>{{ $booking->number_of_adults }}</td>
                            <td>{{ $booking->number_of_children }}</td>
                            <td>{{ number_format($booking->total_price) }} VND</td>
                            <td>{{ $booking->order_code }}</td>
                            <td>{{ $booking->created_at }}</td>
                            <td>
                                <select class="payment-status" data-booking-id="{{ $booking->id }}">
                                    <option value="unpaid" {{ $booking->payment_status == 'unpaid' ? 'selected' : '' }}>Chưa thanh toán</option>
                                    <option value="deposit" {{ $booking->payment_status == 'deposit' ? 'selected' : '' }}>Đã đặt cọc</option>
                                    <option value="paid" {{ $booking->payment_status == 'paid' ? 'selected' : '' }}>Đã thanh toán</option>
                                </select>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" id="showCancelModal{{ $index }}" data-toggle="modal" data-target="#cancelConfirmationModal{{ $index }}">Hủy</button>

                                <!-- Modal -->
                                <div class="modal fade" id="cancelConfirmationModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="cancelConfirmationModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header justify-content-center">
                                                <h5 class="modal-title" id="cancelConfirmationModalLabel">Xác nhận hủy tour</h5>
                                            </div>
                                            <div class="modal-body text-center">
                                                <p>Bạn có chắc chắn muốn hủy tour này không?</p>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                                <button type="button" class="btn btn-danger confirmCancel" data-id="{{ $index }}">Đồng ý</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" style="display:none;" id="cancelForm{{ $index }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach($bookings as $index => $booking)
            document.getElementById(`showCancelModal{{ $index }}`).addEventListener('click', function() {
                $('#cancelConfirmationModal{{ $index }}').modal('show');
            });

            document.querySelector(`#cancelConfirmationModal{{ $index }} .confirmCancel`).addEventListener('click', function() {
                const form = document.getElementById(`cancelForm{{ $index }}`);
                form.submit();
            });
            document.querySelector(`#close{{ $index }}`).addEventListener('click', function() {
                $('#cancelConfirmationModal{{ $index }}').modal('hide');
            });
            @endforeach
        });

        $(document).ready(function() {
            $('.payment-status').change(function() {
                var bookingId = $(this).data('booking-id');
                var paymentStatus = $(this).val();

                $.ajax({
                    url: '{{ route("admin.bookings.updatePaymentStatus") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: bookingId,
                        payment_status: paymentStatus
                    },
                    success: function(response) {
                        toastr.success('Cập nhật trạng thái thanh toán thành công');
                    },
                    error: function(response) {
                        toastr.error('Cập nhật trạng thái thanh toán thất bại');
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var searchInput = document.getElementById('search-input');

            searchInput.addEventListener('blur', function() {
                if (searchInput.value.trim() === '') {
                    window.location.href = '{{ route('admin.bookings.index') }}'; // Truyền đi yêu cầu tìm kiếm tất cả
                }
            });
        });
    </script>
@endsection
