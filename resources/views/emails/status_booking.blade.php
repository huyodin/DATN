<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo trạng thái booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
        }

        .important {
            font-weight: bold;
            color: #d9534f;
        }

        .tour-info ul {
            list-style-type: none;
            padding: 0;
        }

        .tour-info li {
            margin: 8px 0;
        }

        .tour-info li span {
            font-weight: bold;
        }

        .footer {
            font-size: 14px;
            color: #555;
            margin-top: 20px;
            text-align: center;
        }

        .footer a {
            color: #d9534f;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Thông báo trạng thái Booking</h1>
    <p>Xin chào <strong>{{ $bookingDetails->user->name }}</strong>,</p>

    @if($bookingDetails->payment_status === 'unpaid')
        <p>Chúng tôi rất tiếc thông báo rằng booking tour của bạn đã bị
            <span class="important">chuyển sang trạng thái chưa thanh toán</span></p>
    @elseif($bookingDetails->payment_status === 'deposit')
        <p>Booking của bạn hiện đang ở trạng thái <span class="important">đặt cọc</span>. Vui lòng hoàn tất thanh toán số tiền còn lại trong thời gian sớm nhất để đảm bảo chuyến đi của bạn không bị gián đoạn.</p>
    @elseif($bookingDetails->payment_status === 'paid')
        <p>Chúc mừng! booking tour của bạn đã được <span class="important">thanh toán đầy đủ</span>. Chúng tôi rất mong được phục vụ bạn trong chuyến đi sắp tới!</p>
    @endif

    <h2>Thông tin Tour:</h2>
    <div class="tour-info">
        <ul>
            <li><span>Mã Booking:</span> {{ $bookingDetails->order_code }}</li>
            <li><span>Tên Tour:</span> {{ $bookingDetails->tour->name }}</li>
            <li><span>Ngày Bắt Đầu:</span> {{ $bookingDetails->start_date }}</li>
            <li><span>Ngày Kết Thúc:</span> {{ $bookingDetails->end_date }}</li>
            <li><span>Số tiền của tour:</span> {{ number_format($bookingDetails->total_price, 0, ',', '.') }}.000 VND</li>
            <li><span>Số lượng vé trẻ con:</span> {{ $bookingDetails->number_of_children }}</li>
            <li><span>Số lượng vé người lớn:</span> {{ $bookingDetails->number_of_adults }}</li>
        </ul>
    </div>

    <p>Nếu bạn có bất kỳ thắc mắc nào, vui lòng liên hệ với chúng tôi qua email hoặc số điện thoại hỗ trợ.</p>

    <p class="footer">Trân trọng,<br>Đội ngũ hỗ trợ khách hàng</p>
</div>
</body>
</html>
