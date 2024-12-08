@extends('layout.app_user')

@section('content')
    <div class="container bg-white mt-5 p-5 rounded-lg shadow-lg" style="font-family: 'Poppins', sans-serif;">
        <div class="text-center mb-5">
            <h1 class="text-primary" style="font-weight: 600; line-height: 1.4;">Cảm ơn bạn đã đặt tour với chúng tôi!</h1>
            <h2 class="text-success" style="font-weight: 500; line-height: 1.3;">THANH TOÁN CHUYỂN KHOẢN</h2>
        </div>
        <div class="row justify-content-center align-items-center">
            <!-- Cột bên trái: Chi tiết tour -->
            <div class="col-md-6 d-flex flex-column justify-content-center">
                <ul class="list-unstyled">
                    <p class="font-weight-bold text-dark mb-4" style="font-size: 1.2rem; line-height: 1.6;">Chi tiết đặt tour của bạn:</p>
                    <li class="mb-3" style="font-size: 1.1rem; line-height: 1.6;"><strong>Mã tour:</strong> <span class="text-primary">{{ $booking->order_code }}</span></li>
                    <li class="mb-3" style="font-size: 1.1rem; line-height: 1.6;"><strong>Tour:</strong> {{ $booking->tour->name }}</li>
                    <li class="mb-3" style="font-size: 1.1rem; line-height: 1.6;"><strong>Địa điểm xuất phát:</strong> {{ $booking->tour->area->name }}</li>
                    <li class="mb-3" style="font-size: 1.1rem; line-height: 1.6;"><strong>Ngày khởi hành:</strong> {{ $booking->start_date }}</li>
                    <li class="mb-3" style="font-size: 1.1rem; line-height: 1.6;"><strong>Ngày kết thúc:</strong> {{ $booking->end_date }}</li>
                    <li class="mb-3" style="font-size: 1.1rem; line-height: 1.6;"><strong>Số người lớn:</strong> {{ $booking->number_of_adults }}</li>
                    <li class="mb-3" style="font-size: 1.1rem; line-height: 1.6;"><strong>Số trẻ em:</strong> {{ $booking->number_of_children }}</li>
                    <li style="font-size: 1.2rem; line-height: 1.6;"><strong>Tổng giá:</strong> <span class="text-danger">{{ number_format($booking->total_price, 0, '.', '.') . '.000 VNĐ' }}</span></li>
                </ul>

                <p class="text-warning font-weight-bold" style="font-size: 1.1rem; line-height: 1.6;">Vui lòng lưu lại hình ảnh kết quả chuyển khoản để đối chiếu nếu có vấn đề xảy ra. Xin chân thành cảm ơn !!</p>
            </div>
            <!-- Cột bên phải: Thông tin chuyển khoản -->
            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
                <p class="mb-4" style="font-size: 1.2rem; line-height: 1.5; color: #333;">Quét mã để thanh toán</p>
                <img src="{{ asset('img/QRcode.jpg') }}" alt="QR Code" class="img-fluid mb-5" style="max-width: 200px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <div>
                    <p class="font-weight-bold text-dark mb-3" style="font-size: 1.2rem; line-height: 1.6;">Thông tin chuyển khoản:</p>
                    <p class="mb-3" style="font-size: 1.1rem; line-height: 1.6;"><strong>Ngân hàng:</strong> <span class="text-success">VP Bank</span></p>
                    <p class="mb-3" style="font-size: 1.1rem; line-height: 1.6;"><strong>Số tài khoản:</strong> 227239271</p>
                    <p class="mb-3" style="font-size: 1.1rem; line-height: 1.6;"><strong>Chủ tài khoản:</strong> Tran Quang Huy</p>
                    <p class="mb-4" style="font-size: 1.1rem; line-height: 1.6;"><strong>Nội dung chuyển tiền:</strong> <span class="text-primary">{{ $booking->order_code }}</span></p>
                </div>
            </div>
        </div>
    </div>
@endsection
