@extends('layout.app_user')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">Khách sạn</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="{{route('index')}}">Trang chủ</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Khách sạn</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Booking Start -->
    <div class="container-fluid booking mt-5 pb-5">
        <div class="container pb-5">
            <div class="bg-light shadow" style="padding: 30px;">
                <div class="row align-items-center" style="min-height: 60px;">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-12 mb-md-0 h-100">
                                    <div class="mb-3 mb-md-0 h-100">
                                        <div id="quantity" class="h-100">
                                            <input class="form-control h-100" id="hotel-name" type="text" placeholder="Tên khách sạn" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-block" type="button" onclick="searchHotels()" style="height: 47px; margin-top: -2px;">Tìm Kiếm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Booking End -->

    <!-- Packages Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Tours</h6>
                <h1>Các khách sạn hiện tại của chúng tôi</h1>
            </div>
            <div class="row" id="hotels">

            </div>
            <div id="pagination-container">

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.area').select2({
                width: '100%',
            });
            loadHotels(); // Gọi hàm khi trang được tải
        });

        // Hàm tìm kiếm khi người dùng nhấn nút "Tìm Kiếm"
        function searchHotels() {
            var hotelName = $('#hotel-name').val(); // Lấy giá trị từ input
            loadHotels(1, hotelName); // Gọi lại hàm loadHotels với tham số tìm kiếm
        }

        // Hàm tải danh sách khách sạn
        function loadHotels(page = 1, search = '') {
            $.ajax({
                url: '/api/hotels?page=' + page + '&name=' + search, // Thêm tham số tìm kiếm vào URL
                method: 'GET',
                success: function(response) {
                    var hotelHtml = '';
                    response.data.data.forEach(function(hotel) {
                        hotelHtml += `
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="package-item bg-white mb-2 h-100">
                                    <div class="p-4">
                                        <div class="d-flex justify-content-between mb-3">
                                            <small class="m-0"><i class="fa fa-star text-primary mr-2"></i>(${hotel.stars})</small>
                                            <small class="m-0"><i class="fa fa-phone text-primary mr-2"></i>${hotel.phone}</small>
                                            <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i>${hotel.address}</small>
                                        </div>
                                        <a class="h5 text-decoration-none">${hotel.name}</a>
                                        ${hotel.description ? `
                                            <div class="border-top mt-4 pt-4">
                                                <div class="d-flex justify-content-between">
                                                    <p>${hotel.description}</p>
                                                </div>
                                            </div>
                                        ` : ''}
                                    </div>
                                </div>
                            </div>
                        `;
                    });

                    $('#hotels').html(hotelHtml); // Hiển thị danh sách khách sạn

                    // Xử lý phân trang
                    var paginationHtml = '';
                    if (response.data.last_page > 1) {
                        for (var i = 1; i <= response.data.last_page; i++) {
                            paginationHtml += `
                                <li class="page-item ${response.data.current_page === i ? 'active' : ''}">
                                    <a class="page-link" href="#" onclick="loadHotels(${i}, '${search}')">${i}</a>
                                </li>
                            `;
                        }
                    }

                    $('#pagination-container').html(`
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                ${paginationHtml}
                            </ul>
                        </nav>
                    `);
                },
                error: function() {
                    alert('Có lỗi khi tải danh sách khách sạn.');
                }
            });
        }
    </script>
@endsection
