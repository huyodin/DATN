@extends('layout.app_user')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">Vé Máy Bay</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="{{route('index')}}">Trang chủ</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Vé Máy Bay</p>
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
                            <div class="col-md-3">
                                <div class="mb-3 mb-md-0 h-100">
                                    <select name="area_id_start" class="area custom-select px-4" style="height: 47px;" id="area_id_start">
                                        <option value="" selected>Địa điểm xuất phát</option>
                                        @foreach($data['areas'] as $area)
                                            <option value="{{$area->id}}">{{$area->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 mb-md-0">
                                    <div class="date" id="date1" data-target-input="nearest">
                                        <input type="text" id="start_date" class="form-control p-4 datetimepicker-input" placeholder="Ngày bắt đầu" data-target="#date1" data-toggle="datetimepicker"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 mb-md-0">
                                    <div class="date" id="date2" data-target-input="nearest">
                                        <input type="text" id="end_date" class="form-control p-4 datetimepicker-input" placeholder="Ngày trở về" data-target="#date2" data-toggle="datetimepicker"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 mb-md-0 h-100">
                                    <select name="area_id_end" class="area custom-select px-4" style="height: 47px;" id="area_id_end">
                                        <option value="" selected>Địa điểm đến</option>
                                        @foreach($data['areas'] as $area)
                                            <option value="{{$area->id}}">{{$area->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-block" type="button" style="height: 47px; margin-top: -2px;" onclick="searchBooking()">Tìm Kiếm</button>
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
                <h1>Các tours du lịch hiện tại của chúng tôi</h1>
            </div>
            <div class="row" id="airline-tickets">

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
            loadAirlineTickets();
        });

        function searchBooking(page = 1) {
            var area_id_start = $('#area_id_start').val();
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();
            var area_id_end = $('#area_id_end').val();

            loadAirlineTickets(page, area_id_start, startDate, endDate, area_id_end);
        }

        function loadAirlineTickets(page = 1, area_id_start = '', startDate = '', endDate = '', area_id_end = '') {
            $.ajax({
                url: '/api/airline-tickets?page=' + page, // Thêm tham số page vào URL
                method: 'GET',
                data: {
                    area_id_start: area_id_start,
                    start_date: startDate,
                    end_date: endDate,
                    area_id_end: area_id_end
                },
                success: function(response) {
                    var ticketHtml = '';
                    response.data.data.forEach(function(ticket) {
                        var startDate = new Date(ticket.start_date);
                        var endDate = new Date(ticket.end_date);
                        var daysDifference = Math.ceil((endDate - startDate) / (1000 * 3600 * 24));

                        ticketHtml += `
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="package-item bg-white mb-2 h-100">
                            <img class="img-fluid" src="${ticket.logo_url}" alt="Logo">
                            <div class="p-4">
                                <div class="d-flex justify-content-between mb-3">
                                    <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i>${ticket.area_start.name} → ${ticket.area_end.name}</small>
                                    <small class="m-0"><i class="fa fa-calendar-alt text-primary mr-2"></i>${daysDifference} ngày</small>
                                    <small class="m-0"><i class="fa fa-user text-primary mr-2"></i>${ticket.quantity} người</small>
                                </div>
                                <a class="h5 text-decoration-none">${ticket.name}</a>
                                <div class="border-top mt-4 pt-4">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="m-0" style="text-align: right">${ticket.price.toLocaleString()} VND</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                    });

                    $('#airline-tickets').html(ticketHtml); // Hiển thị danh sách vé

                    // Xử lý phân trang
                    var paginationHtml = '';
                    if (response.data.last_page > 1) {
                        for (var i = 1; i <= response.data.last_page; i++) {
                            paginationHtml += `
                                <li class="page-item ${response.data.current_page === i ? 'active' : ''}">
                                    <a class="page-link" href="#" onclick="loadAirlineTickets(${i}, '${area_id_start}', '${startDate}', '${endDate}', '${area_id_end}')">${i}</a>
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
                    alert('Có lỗi khi tải danh sách vé máy bay.');
                }
            });
        }
    </script>
@endsection
