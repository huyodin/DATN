<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TRAVELER - Free Travel Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset(env('URL_MAIN')."/lib/owlcarousel/assets/owl.carousel.min.css")}}" rel="stylesheet">
    <link href="{{asset(env('URL_MAIN')."/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css")}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset(env('URL_MAIN')."/css/style.css")}}" rel="stylesheet">
</head>

<body>
<!-- Topbar Start -->
<div class="container-fluid bg-light pt-3 d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <p><i class="fa fa-envelope mr-2"></i>info@example.com</p>
                    <p class="text-body px-3">|</p>
                    <p><i class="fa fa-phone-alt mr-2"></i>+012 345 6789</p>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-primary px-3" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-primary px-3" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-primary px-3" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-primary px-3" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-primary pl-3" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<div class="container-fluid position-relative nav-bar p-0">
    <div class="container-lg position-relative p-0" style="z-index: 9;">
        <nav class="navbar navbar-expand-lg bg-light navbar-light shadow-lg py-3 py-lg-0 pl-3 pl-lg-5">
            <a href="{{ route('index') }}" class="navbar-brand">
                <h1 class="m-0 text-primary"><span class="text-dark">TRAVEL</span>ER</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                <div class="navbar-nav ml-auto py-0">
                    <a href="{{ route('index') }}" class="nav-item nav-link {{ Route::is('index') ? 'active' : '' }}">Trang chủ</a>
                    <a href="{{ route('tours') }}" class="nav-item nav-link {{ Route::is('tours') ? 'active' : '' }}">Tours</a>
                    <a href="{{ route('airline_tickets') }}" class="nav-item nav-link {{ Route::is('airline_tickets') ? 'active' : '' }}">Vé máy bay</a>
                    <a href="{{ route('hotels') }}" class="nav-item nav-link {{ Route::is('hotels') ? 'active' : '' }}">Khách sạn</a>
                    @if (!Auth::check())
                        {{--                    Chưa đăng nhập--}}
                        <div class="d-flex align-items-center">
                            <a href="{{ route('login') }}" class="nav-item nav-link {{ Route::is('login') ? 'active' : '' }}">Đăng nhập</a>
                            /
                            <a href="{{ route('register') }}" class="nav-item nav-link {{ Route::is('register') ? 'active' : '' }}">Đăng ký</a>
                        </div>
                    @else
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Huy Odin</a>
                            <div class="dropdown-menu border-0 rounded-0 m-0">
                                @if(Auth::user()->role !== 0)
                                    <a href="{{ route('admin.tour.index') }}" class="dropdown-item {{ Route::is('admin.tour.index') ? 'active' : '' }}">Quản lý Tours</a>
                                    <a href="{{ route('admin.customers.index') }}" class="dropdown-item {{ Route::is('admin.customers.index') ? 'active' : '' }}">Quản lý khách hàng</a>
                                    <a href="{{ route('admin.hotels.index') }}" class="dropdown-item {{ Route::is('admin.hotels.index') ? 'active' : '' }}">Quản lý khách sạn</a>
                                    <a href="{{ route('admin.tour_guides.index') }}" class="dropdown-item {{ Route::is('admin.tour_guides.index') ? 'active' : '' }}">Quản lý hướng dẫn viên</a>
                                    <a href="{{ route('admin.vehicles.index') }}" class="dropdown-item {{ Route::is('admin.vehicles.index') ? 'active' : '' }}">Quản lý phương tiện</a>
                                    <a href="{{ route('admin.drivers.index') }}" class="dropdown-item {{ Route::is('admin.drivers.index') ? 'active' : '' }}">Quản lý tài xế</a>
{{--                                    <a href="{{ route('admin.banks.edit') }}" class="dropdown-item {{ Route::is('admin.banks.edit') ? 'active' : '' }}">Tài khoản thanh toán</a>--}}
                                    <a href="{{ route('admin.areanew.index') }}" class="dropdown-item {{ Route::is('admin.areanew.index') ? 'active' : '' }}">Quản lý Khu Vực</a>
                                    <a href="{{ route('admin.statistics.index') }}" class="dropdown-item {{ Route::is('admin.statistics.index') ? 'active' : '' }}">Thống kê</a>
                                @else
                                    <a href="{{ route('user.tours') }}" class="dropdown-item {{ Route::is('user.tours') ? 'active' : '' }}">Tours đã đặt</a>
                                @endif
                                <a href="{{ route('user.logout') }}" class="dropdown-item {{ Route::is('user.logout') ? 'active' : '' }}">Đăng xuất</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->

@yield('content')


<!-- Footer Start -->
<div class="container-fluid bg-dark text-white-50 py-5 px-sm-3 px-lg-5" style="margin-top: 90px;">
    <div class="row pt-5">
        <div class="col-lg-3 col-md-6 mb-5">
            <a href="" class="navbar-brand">
                <h1 class="text-primary"><span class="text-white">TRAVEL</span>ER</h1>
            </a>
            <p>Sed ipsum clita tempor ipsum ipsum amet sit ipsum lorem amet labore rebum lorem ipsum dolor. No sed vero lorem dolor dolor</p>
            <h6 class="text-white text-uppercase mt-4 mb-3" style="letter-spacing: 5px;">Follow Us</h6>
            <div class="d-flex justify-content-start">
                <a class="btn btn-outline-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-outline-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-outline-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-outline-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Our Services</h5>
            <div class="d-flex flex-column justify-content-start">
                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>About</a>
                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Destination</a>
                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Services</a>
                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Packages</a>
                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Guides</a>
                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Testimonial</a>
                <a class="text-white-50" href="#"><i class="fa fa-angle-right mr-2"></i>Blog</a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Usefull Links</h5>
            <div class="d-flex flex-column justify-content-start">
                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>About</a>
                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Destination</a>
                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Services</a>
                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Packages</a>
                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Guides</a>
                <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Testimonial</a>
                <a class="text-white-50" href="#"><i class="fa fa-angle-right mr-2"></i>Blog</a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Contact Us</h5>
            <p><i class="fa fa-map-marker-alt mr-2"></i>123 Street, New York, USA</p>
            <p><i class="fa fa-phone-alt mr-2"></i>+012 345 67890</p>
            <p><i class="fa fa-envelope mr-2"></i>info@example.com</p>
            <h6 class="text-white text-uppercase mt-4 mb-3" style="letter-spacing: 5px;">Newsletter</h6>
            <div class="w-100">
                <div class="input-group">
                    <input type="text" class="form-control border-light" style="padding: 25px;" placeholder="Your Email">
                    <div class="input-group-append">
                        <button class="btn btn-primary px-3">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{asset(env('URL_MAIN')."/lib/easing/easing.min.js")}}"></script>
<script src="{{asset(env('URL_MAIN')."/lib/owlcarousel/owl.carousel.min.js")}}"></script>
<script src="{{asset(env('URL_MAIN')."/lib/tempusdominus/js/moment.min.js")}}"></script>
<script src="{{asset(env('URL_MAIN')."/lib/tempusdominus/js/moment-timezone.min.js")}}"></script>
<script src="{{asset(env('URL_MAIN')."/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js")}}"></script>

<!-- Template Javascript -->
<script src="{{asset(env('URL_MAIN')."/js/main.js")}}"></script>
</body>

</html>
