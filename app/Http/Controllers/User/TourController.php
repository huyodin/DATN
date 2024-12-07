<?php

namespace App\Http\Controllers\User;

use App\Models\Area;
use App\Models\Booking;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TourController
{
    public function tours(Request $request) {
        // Lấy danh sách các địa điểm du lịch
        $areas = Area::all();

        // Tạo query cơ bản cho Tour
        $query = Tour::with(['firstImage', 'area', 'hotel', 'tourDates']);

        // Tìm kiếm theo số lượng người
        if ($request->has('number_of_participants') && $request->number_of_participants) {
            $query->where('number_of_participants', '>=', $request->number_of_participants);
        }

        // Tìm kiếm theo ngày bắt đầu
        if ($request->has('start_date') && $request->start_date) {
            // Chuyển đổi ngày bắt đầu từ request về định dạng Y-m-d
            $startDate = Carbon::parse($request->start_date)->format('Y-m-d');

            // So sánh ngày bắt đầu trong bảng tourDates
            $query->whereHas('tourDates', function ($query) use ($startDate) {
                // So sánh ngày bắt đầu lớn hơn hoặc bằng start_date
                $query->whereDate('start_date', '>=', $startDate);
            });
        }

        // Tìm kiếm theo ngày kết thúc
        if ($request->has('end_date') && $request->end_date) {
            // Chuyển đổi ngày kết thúc từ request về định dạng Y-m-d
            $endDate = Carbon::parse($request->end_date)->format('Y-m-d');

            // So sánh ngày kết thúc trong bảng tourDates
            $query->whereHas('tourDates', function ($query) use ($endDate) {
                // So sánh ngày kết thúc nhỏ hơn hoặc bằng end_date
                $query->whereDate('end_date', '<=', $endDate);
            });
        }

        // Tìm kiếm theo địa điểm du lịch
        if ($request->has('area') && $request->area) {
            $query->where('area_id', $request->area);
        }

        // Lấy danh sách các tour đã được lọc
        $tours = $query->paginate(3);

        // Trả về view với dữ liệu
        $data = [
            'areas' => $areas,
            'tours' => $tours
        ];
        return view('user.tours')->with('data', $data);
    }

    public function detailTour($id) {
        $tour = Tour::with(['images', 'tourDates', 'area', 'hotel', 'vehicle'])->whereId($id)->first();
        $totalNumberOfPeople = Booking::where('tour_id', $tour->id)
            ->sum(DB::raw('number_of_adults + number_of_children'));
        $data = [
            'tour' => $tour,
            'totalNumberOfPeople' => $totalNumberOfPeople
        ];
        return view('user.detail_tour')->with('data', $data);
    }

    public function payment(Request $request) {
        try{
            $tour = Tour::find($request->tour_id);
            $request->validate([
                'tour_id' => 'required|integer|exists:tours,id',
            ]);

            $start_date = explode("|", $request->tour_dates)[0];
            $end_date = explode("|", $request->tour_dates)[1];

            $pricePerAdult = $tour->price;
            $pricePerChild = $pricePerAdult * 0.5;

            $totalPrice = ($request->input('adults') * $pricePerAdult) +
                ($request->input('children') * $pricePerChild);

            $bookings = Booking::where('tour_id', $tour->id)->get();
            if ($bookings) {
                $totalNumberOfAdultsBooked = $bookings->sum('number_of_adults');
                $totalNumberOfChildrenBooked = $bookings->sum('number_of_children');
                $totalNumberOfPeopleBooked = $totalNumberOfAdultsBooked + $totalNumberOfChildrenBooked;

                $newAdults = $request->input('adults');
                $newChildren = $request->input('children');
                $totalNumberOfPeopleIncludingNew = $totalNumberOfPeopleBooked + $newAdults + $newChildren;

                if ($totalNumberOfPeopleIncludingNew > $tour->number_of_participants) {
                    return redirect()->back()->withErrors(['error' => 'Tour đã hết chỗ'])->withInput();
                }
            }

            $booking = new Booking();
            $booking->user_id = Auth::id();
            $booking->tour_id = $request->input('tour_id');
            $booking->start_date = $start_date;
            $booking->end_date = $end_date;
            $booking->number_of_adults = $request->input('adults');
            $booking->number_of_children = $request->input('children');
            $booking->total_price = $totalPrice;
            $booking->save();

            return view('user.payment')->with('booking', $booking);
        }
        catch(\Exception $e){
            \Log::error('Error: ' . $e->getMessage());

            // Chuyển hướng về trang danh sách với thông báo lỗi
            return redirect()->back()->with('error', 'Đã xảy ra lỗi!!');
        }
    }

    public function ToursByUser() {
        $bookings = Booking::where('user_id', auth()->id())->get();

        return view('user.user_tours')->with('bookings', $bookings);
    }
}
