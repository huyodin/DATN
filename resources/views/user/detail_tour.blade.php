@extends('layout.app_user')

@section('content')
    <div class="container bg-white mt-5" style="padding: 30px;">
        <h1>{{ $data['tour']->name }}</h1>
        <hr>
        <div class="d-flex">
            <div class="col-8">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach($data['tour']->images()->get() as $index => $image)
                            <div class="rounded-3 no-drag-title swiper-slide" style="
                            width: 500px;
                            height: 100%;
                            background-size: contain !important;
                            background-position: center !important;
                            background-repeat: no-repeat !important;
                            background-color: #dfdfdf !important;
                            border-radius: 8px;
                            aspect-ratio: 1.91 !important;
                            position: relative;
                            overflow: hidden;">
                                <img id="image-preview-{{ $index }}" src="{{ $image->image }}" alt="" style="
                            position: absolute;
                            top: 50%;
                            left: 50%;
                            width: 130%;
                            height: 130%;
                            object-fit: contain;
                            transform: translate(-50%, -50%);">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next text-primary"></div>
                    <div class="swiper-button-prev next text-primary"></div>
                </div>
            </div>
            <div class="col-4 book-tour">
                <h1 class="mb-4 text-center text-bold text-primary">Lịch Trình và Giá Tour</h1>
                <form id="booking-form" action="{{route('payment')}}" method="POST">
                    @csrf
                    <input type="hidden" name="tour_id" value="{{ $data['tour']->id }}">

                    <div class="mb-3">
                        <label class="form-label">Chọn ngày đi</label>
                        <select name="tour_dates" class="form-control">
                            @foreach($data['tour']->tourDates as $tourDate)
                                <option value="{{ $tourDate->start_date }}|{{ $tourDate->end_date }}">
                                    Ngày đi: {{ $tourDate->start_date }} -> Ngày về: {{ $tourDate->end_date }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="children" class="form-label">Số lượng (Trẻ em <= 10 tuổi) </label>
                        <input type="number" class="form-control" id="children" name="children" value="0" min="0" onchange="updateTotalPrice()">
                    </div>

                    <div class="mb-3">
                        <label for="adults" class="form-label">Số lượng (Người lớn) </label>
                        <input type="number" class="form-control" id="adults" name="adults" value="0" min="0" onchange="updateTotalPrice()">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Giá gốc:</label>
                        <div id="original_price" class="price">{{ number_format($data['tour']->price, 0, '.', '.') }}.000 VND</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tổng giá:</label>
                        <div id="total_price" class="price">0 VND</div>
                    </div>

                    @guest
                        <a href="{{ route('login') }}" class="btn btn-primary">Đăng nhập để đặt tour</a>
                    @else
                        @if($data['totalNumberOfPeople'] >= $data['tour']->number_of_participants)
                            <button class="btn btn-secondary" type="button" disabled>Tour đã hết chỗ</button>
                        @else
                            @if(Auth::user()->role === 0)
                                <button type="button" class="btn btn-success" id="showConfirmationModal">Đặt tour</button>
                            @endif
                        @endif
                    @endguest
                </form>
            </div>
        </div>
        <div class="card mb-4 mt-4">
            <div class="card-header">
                <h3>Địa điểm</h3>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $data['tour']->area->name }}</h5>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h3>Khách Sạn</h3>
            </div>
            <div class="card-body">
                <h5 class="card-title">Tên: {{ $data['tour']->hotel->name }}</h5>
                <p class="card-text">Địa chỉ: {{ $data['tour']->hotel->address }}</p>
                <p class="card-text">Đánh giá: {{ $data['tour']->hotel->stars }} <i class="fa-solid fa-star" style="color: yellow;"></i></p>
                <p class="card-text">Điện thoại: {{ $data['tour']->hotel->phone }}</p>
                <p class="card-text">Mô tả: {{ $data['tour']->hotel->description }}</p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h3>Phương Tiện</h3>
            </div>
            <div class="card-body">
                <h5 class="card-title">Loại: {{ $data['tour']->vehicle->type }}</h5>
                <p class="card-text">Mẫu: {{ $data['tour']->vehicle->model }}</p>
                <p class="card-text">Biển số: {{ $data['tour']->vehicle->license_plate }}</p>
                <p class="card-text">Sức chứa: {{ $data['tour']->vehicle->capacity }}</p>
                <p class="card-text">ID tài xế: {{ $data['tour']->vehicle->driver_id }}</p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h3>Hướng Dẫn Viên</h3>
            </div>
            <div class="card-body">
                <h5 class="card-title">Tên: {{ $data['tour']->guide->name }}</h5>
                <p class="card-text">Điện thoại: {{ $data['tour']->guide->phone }}</p>
                <p class="card-text">Email: {{ $data['tour']->guide->email }}</p>
                <p class="card-text">Tiểu sử: {{ $data['tour']->guide->bio }}</p>
                <div class="mt-3">
                    <img src="{{ asset('storage/' . $data['tour']->guide->avatar) }}" alt="{{ $data['tour']->guide->name }}" class="img-thumbnail" style="max-width: 100%; height: auto;">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h5 class="modal-title" id="confirmationModalLabel">Xác nhận đặt tour</h5>
                    </div>
                    <div class="modal-body justify-content-center">
                        <h6 class="text-center">Bạn có chắc chắn muốn đặt tour này không?</h6>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary close" data-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-primary" id="confirmBooking">Đồng ý</button>
                    </div>
                </div>
            </div>
        </div>
    <script>
        var swiper = new Swiper(".mySwiper", {
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        document.getElementById('showConfirmationModal').addEventListener('click', function() {
            $('#confirmationModal').modal('show');
        });

        document.getElementById('confirmBooking').addEventListener('click', function() {
            document.getElementById('booking-form').submit();
        });
        document.querySelector('.close').addEventListener('click', function() {
            $('#confirmationModal').modal('hide');
        });

        const adultsInput = document.getElementById('adults');
        const childrenInput = document.getElementById('children');
        const originalPriceElement = document.getElementById('original_price');
        const totalPriceElement = document.getElementById('total_price');
        const bookNowButton = document.querySelector('.btn-book-now');

        const originalPrice = parseInt(originalPriceElement.innerText.replace(/[^0-9]/g, ''));

        function updateTotalPrice() {
            // Lấy số lượng trẻ em và người lớn
            const childrenCount = parseInt(document.getElementById('children').value) || 0;
            const adultsCount = parseInt(document.getElementById('adults').value) || 0;

            // Lấy giá gốc
            const originalPrice = parseInt(document.getElementById('original_price').innerText.replace(/[^0-9]/g, ''));

            // Tính tổng giá (Trẻ em có giá bằng một nửa giá gốc)
            const childrenPrice = originalPrice / 2;
            const totalPrice = (childrenCount * childrenPrice) + (adultsCount * originalPrice);

            // Cập nhật giao diện với giá trị mới
            document.getElementById('total_price').innerText = totalPrice.toLocaleString('vi-VN') + ' VND';
        }
    </script>
@endsection
