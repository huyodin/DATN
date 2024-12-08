@extends('layout.app_user')

@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">DU LỊCH VÀ TRẢI NGHIỆM</h4>
                            <h1 class="display-3 text-white mb-md-4">Hãy cùng nhau khám phá thế giới</h1>
                            <a href="{{route('tours')}}" class="btn btn-primary py-md-3 px-md-5 mt-2">Đặt ngay</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">DU LỊCH VÀ TRẢI NGHIỆM</h4>
                            <h1 class="display-3 text-white mb-md-4">Khám phá những địa điểm tuyệt vời cùng chúng tôi</h1>
                            <a href="{{route('tours')}}" class="btn btn-primary py-md-3 px-md-5 mt-2">Đặt ngay</a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2"></span>
                </div>
            </a>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Booking Start -->
    <form action="{{ route('tours') }}" method="GET">
        <div class="container-fluid booking mt-5 pb-5">
            <div class="container pb-5">
                <div class="bg-light shadow" style="padding: 30px;">
                    <div class="row align-items-center" style="min-height: 60px;">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3 mb-md-0 h-100">
                                        <input name="number_of_participants" min="0" class="form-control h-100" type="number" placeholder="Số lượng người" value="{{ request()->get('number_of_participants') }}" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 mb-md-0">
                                        <div class="date" id="date1" data-target-input="nearest">
                                            <input name="start_date" type="text" class="form-control p-4 datetimepicker-input" placeholder="Ngày bắt đầu" value="{{ request()->get('start_date') }}" data-target="#date1" data-toggle="datetimepicker"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 mb-md-0">
                                        <div class="date" id="date2" data-target-input="nearest">
                                            <input name="end_date" type="text" class="form-control p-4 datetimepicker-input" placeholder="Ngày trở về" value="{{ request()->get('end_date') }}" data-target="#date2" data-toggle="datetimepicker"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 mb-md-0 h-100">
                                        <select name="area" class="area form-control px-4" style="height: 47px;">
                                            <option selected value="">Địa điểm du lịch</option>
                                            @foreach($data['areas'] as $area)
                                                <option value="{{ $area->id }}" {{ request()->get('area') == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-block" type="submit" style="height: 47px; margin-top: -2px;">Tìm Kiếm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Booking End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-6" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/about.jpg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 pt-5 pb-lg-5">
                    <div class="about-text bg-white p-4 p-lg-5 my-lg-5">
                        <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;"></h6>
                        <h1 class="mb-3">ĐI KHẮP NƠI - CHƠI KHẮP CHỐN</h1>
                        <p>Chào mừng đến với Travel.pro – nền tảng đặt tour du lịch trực tuyến hàng đầu! Với các hành trình độc đáo, gói tour đa dạng và dịch vụ chuyên nghiệp, chúng tôi giúp bạn khám phá thế giới dễ dàng và trọn vẹn. Giao diện thân thiện, đặt tour đơn giản, Travel.pro là người bạn đồng hành tin cậy. Khám phá ngay hôm nay và viết nên câu chuyện du lịch của riêng bạn! 🌟</p>
                        <div class="row mb-4">
                            <div class="col-6">
                                <img class="img-fluid" src="img/about-1.jpg" alt="">
                            </div>
                            <div class="col-6">
                                <img class="img-fluid" src="img/about-2.jpg" alt="">
                            </div>
                        </div>
                        <a href="{{route('tours')}}" class="btn btn-primary mt-1">Đặt ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Feature Start -->
    <div class="container-fluid pb-5">
        <div class="container pb-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="d-flex mb-4 mb-lg-0">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                            <i class="fa fa-2x fa-money-check-alt text-white"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="">Tiện lợi và Nhanh chóng</h5>
                            <p class="m-0">Tìm kiếm tour nhanh chóng, dễ dàng thao tác</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex mb-4 mb-lg-0">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                            <i class="fa fa-2x fa-award text-white"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="">Đa dạng</h5>
                            <p class="m-0">Nhiều gói tour, điểm đến, vé máy bay, khách sạn</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex mb-4 mb-lg-0">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                            <i class="fa fa-2x fa-globe text-white"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="">Linh hoạt</h5>
                            <p class="m-0">Phù hợp với yêu cầu của khách hàng</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->


    <!-- Destination Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;"></h6>
                <h1>Khám phá Top những điểm đến hàng đầu</h1>
            </div>
            <div class="row">
                @foreach($data['areasPreview'] as $area)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="destination-item position-relative overflow-hidden mb-2 h-100">
                            <img class="img-fluid w-100 h-100" style="max-height: 250px" src="{{ asset('storage/' . $area->thumbnail) }}" alt="">
                            <a class="destination-overlay text-white text-decoration-none" href="">
                                <h5 class="text-white">{{$area->name}}</h5>
                                <span>{{$area->tours_count}} Tours</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Destination Start -->


    <!-- Service Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;"></h6>
                <h1>Dịch vụ</h1>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-item bg-white text-center mb-2 py-5 px-4">
                        <i class="fa fa-2x fa-route mx-auto mb-4"></i>
                        <h5 class="mb-2">Booking Tour</h5>
                        <p class="m-0">Đặt tour nhanh chóng, tiện lợi, dễ thao tác</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-item bg-white text-center mb-2 py-5 px-4">
                        <i class="fa fa-2x fa-ticket-alt mx-auto mb-4"></i>
                        <h5 class="mb-2">Tìm kiếm Vé máy bay</h5>
                        <p class="m-0">Tìm kiếm chuyến bay mà bạn cần, thuận tiện cho việc di chuyển</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-item bg-white text-center mb-2 py-5 px-4">
                        <i class="fa fa-2x fa-hotel mx-auto mb-4"></i>
                        <h5 class="mb-2">Tìm kiếm Khách sạn</h5>
                        <p class="m-0">Tìm kiếm khách sạn phù hợp với nhu cầu của bạn</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.area').select2({
                width: '100%',
            });
        });
    </script>
@endsection
