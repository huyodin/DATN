@extends('layout.app_user')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">Tours</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="{{route('index')}}">Trang chủ</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Tours</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


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


    <!-- Packages Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Tours</h6>
                <h1>Các tours du lịch hiện tại của chúng tôi</h1>
            </div>
            <div class="row">
                @foreach($data['tours'] as $tour)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="package-item bg-white mb-2 h-100">
                            <img class="img-fluid" src="{{ asset($tour->firstImage->image) }}" alt="">
                            <div class="p-4">
                                <div class="d-flex justify-content-between mb-3">
                                    <small class="m-0"><i class="fa fa-map-marker-alt text-primary mr-2"></i>{{$tour->area->name}}</small>
                                    @php
                                        $tourStartDate = \Carbon\Carbon::parse($tour->tourDates[0]->start_date);
                                        $tourEndDate = \Carbon\Carbon::parse($tour->tourDates[0]->end_date);
                                        $daysDifference = $tourStartDate->diffInDays($tourEndDate);
                                    @endphp
                                    <small class="m-0"><i class="fa fa-calendar-alt text-primary mr-2"></i>{{$daysDifference}} ngày</small>
                                    <small class="m-0"><i class="fa fa-user text-primary mr-2"></i>{{$tour->number_of_participants}} người</small>
                                </div>
                                <a class="h5 text-decoration-none" href="{{route('detailTour', ['id' => $tour->id])}}">{{$tour->name}}</a>
                                <div class="border-top mt-4 pt-4">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="m-0"><i class="fa fa-home text-primary mr-2"></i>{{ $tour->hotel->name }}</h6>
                                        <h5 class="m-0" style="text-align: right">{{ number_format($tour->price, 0, ',', '.') }}.000 VND</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $data['tours']->links('common.paginate') }}
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
        });
    </script>
@endsection
