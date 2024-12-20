@extends('layout.app_user')

@section('content')
    <div class="container-lg mt-5 bg-white p-4">
        <h1>{{ $tour->name }}</h1>
        <hr>
        <div class="d-flex">
            <div class="col-8">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach($tour->images()->get() as $index => $image)
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
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <div class="col-4 book-tour">
                <h1 class="mb-4 text-center text-bold">Lịch Trình và Giá Tour</h1>
                <form id="booking-form" action="{{ route('admin.bookings.store') }}" method="POST" onsubmit="return validateForm()">
                    @csrf
                    <input type="hidden" name="tour_id" value="{{ $tour->id }}">

                    <div class="form-group mb-3">
                        <label>Chọn ngày đi</label>
                        <select name="tour_dates" class="form-select-date form-select-lg" style="padding-left: 12px; padding-right: 12px;">
                            @foreach($tour->tourDates as $tourDate)
                                <option value="{{ $tourDate->start_date }}|{{ $tourDate->end_date }}">
                                    Ngày đi: {{ $tourDate->start_date }} -> Ngày về: {{ $tourDate->end_date }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="adults">Người lớn (> 10 tuổi)</label>
                        <input type="number" class="form-control" id="adults" name="adults" value="1" min="1" onchange="updateTotalPrice()" style="padding-left: 12px; padding-right: 12px;">
                    </div>

                    <div class="form-group mb-3">
                        <label for="children">Trẻ em (< 10 tuổi)</label>
                        <input type="number" class="form-control" id="children" name="children" value="0" min="0" onchange="updateTotalPrice()" style="padding-left: 12px; padding-right: 12px;">
                    </div>

                    <div class="form-group mb-3">
                        <label>Giá gốc:</label>
                        <div id="original_price" class="price">{{ number_format($tour->price, 0, '.', '.') }}.000 VND</div>
                    </div>

                    <div class="form-group mb-3">
                        <label>Tổng Giá Tour:</label>
                        <div id="total_price" class="price">0 VND</div>
                    </div>
                    @guest
                        <button href="{{ route('admin.login') }}" class="btn btn-tour w-100 mt-2" style="background-color: #007bff; color: white;">Đăng nhập để đặt tour</button>
                    @else
                        @if($totalNumberOfPeople >= $tour->number_of_participants)
                            <button class="btn btn-tour-disabled w-100 mt-2" style="background-color: #ccc; color: white;" disabled>Tour đã hết chỗ</button>
                        @else
                            <button type="button" class="btn btn-tour w-100 mt-2" id="showConfirmationModal" style="background-color: #28a745; color: white;">Đặt tour</button>
                        @endif
                    @endguest

                </form>
            </div>
        </div>
        <div class="card mb-3 mt-3">
            <div class="card-header">
                <h3>Địa điểm xuất phát</h3>
            </div>
            <div class="card-body">
                <h5 class="card-title">Tên: {{ $area->name }}</h5>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <h3>Khách Sạn</h3>
            </div>
            <div class="card-body">
                <h5 class="card-title">Tên: {{ $hotel->name }}</h5>
                <p class="card-text">Địa chỉ: {{ $hotel->address }}</p>
                <p class="card-text">Đánh giá: {{ $hotel->stars }} <i class="fa fa-star" style="color: yellow;"></i></p>
                <p class="card-text">Điện thoại: {{ $hotel->phone }}</p>
                <p class="card-text">Mô tả: {{ $hotel->description }}</p>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <h3>Phương Tiện</h3>
            </div>
            <div class="card-body">
                <h5 class="card-title">Loại: {{ $vehicle->type }}</h5>
                <p class="card-text">Mẫu: {{ $vehicle->model }}</p>
                <p class="card-text">Biển số: {{ $vehicle->license_plate }}</p>
                <p class="card-text">Sức chứa: {{ $vehicle->capacity }}</p>
                <p class="card-text">ID tài xế: {{ $vehicle->driver_id }}</p>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <h3>Hướng Dẫn Viên</h3>
            </div>
            <div class="card-body">
                <h5 class="card-title">Tên: {{ $guide->name }}</h5>
                <p class="card-text">Điện thoại: {{ $guide->phone }}</p>
                <p class="card-text">Email: {{ $guide->email }}</p>
                <p class="card-text">Tiểu sử: {{ $guide->bio }}</p>
                <div class="mt-3">
                    <img src="{{ asset('storage/' . $guide->avatar) }}" alt="{{ $guide->name }}" class="img-thumbnail" style="max-width: 100%; height: auto;">
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-evenly block-infor">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-location-dot me-1"></i>
                <p class="m-0">Hà Nội</p>
            </div>
            <div class="d-flex align-items-center">
                <i class="fa-regular fa-clock me-1"></i>
                <p class="m-0">3 ngày 2 đêm</p>
            </div>
            <div class="d-flex align-items-center">
                <p class="m-0 me-1">Phương tiện: </p>
                <i class="fa-solid fa-plane me-1"> </i>
                <i class="fa-solid fa-bus"></i>
            </div>
            <p class="m-0">Đánh giá: 4.4 (25)</p>
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

        function calculateTotalPrice() {
            const adults = parseInt(adultsInput.value) || 0;
            const children = parseInt(childrenInput.value) || 0;

            const childrenPrice = originalPrice / 2;
            const totalPrice = (adults * originalPrice) + (children * childrenPrice);

            totalPriceElement.innerText = totalPrice.toLocaleString('vi-VN') + ' VND';

            totalPriceElement.setAttribute('data-total-price', totalPrice);

            bookNowButton.setAttribute('data-total-price', totalPrice);
            bookNowButton.setAttribute('data-adults', adults);
            bookNowButton.setAttribute('data-children', children);
        }

        // Add event listener to input fields
        adultsInput.addEventListener('input', calculateTotalPrice);
        childrenInput.addEventListener('input', calculateTotalPrice);

        calculateTotalPrice();
    </script>
@endsection
