@extends('layout.app_user')

@section('content')
    <div class="container my-5 p-4 shadow bg-white">
        <h1 class="text-center mb-4">Danh sách Tour đã đặt</h1>
        @if($bookings->isEmpty())
            <div class="alert alert-info text-center" role="alert">
                Bạn chưa đặt tour nào.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark text-center">
                    <tr>
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
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bookings as $index => $booking)
                        <tr>
                            <td>{{ optional($booking->tour)->name }}</td>
                            <td>{{ $booking->start_date }}</td>
                            <td>{{ $booking->end_date }}</td>
                            <td>{{ $booking->tour->area->name ?? 'N/A' }}</td>
                            <td>{{ $booking->tour->hotel->name ?? 'N/A' }}</td>
                            <td>{{ $booking->tour->vehicle->type ?? 'N/A' }}</td>
                            <td>{{ $booking->tour->guide->name ?? 'N/A' }}</td>
                            <td class="text-center">{{ $booking->number_of_adults }}</td>
                            <td class="text-center">{{ $booking->number_of_children }}</td>
                            <td class="text-end">{{ number_format($booking->total_price) }},000 VND</td>
                            <td>{{ $booking->order_code }}</td>
                            <td>{{ $booking->created_at->format('d-m-Y H:i') }}</td>
                            <td class="text-center">
                                @if ($booking->payment_status == 'unpaid')
                                    <span class="badge bg-secondary">Chưa thanh toán</span>
                                @elseif ($booking->payment_status == 'deposit')
                                    <span class="badge bg-warning text-dark">Đã đặt cọc</span>
                                @elseif ($booking->payment_status == 'paid')
                                    <span class="badge bg-success">Đã thanh toán</span>
                                @else
                                    <span class="badge bg-dark">Không xác định</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
