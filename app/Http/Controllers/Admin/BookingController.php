<?php

namespace App\Http\Controllers\Admin;

use App\Mail\StatusBooking;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController
{

    public function index(Request $request)
    {
        $query = $request->input('query');
        if (!$query) {
            $bookings = Booking::with(['tour.area', 'tour.hotel', 'tour.vehicle', 'tour.guide'])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $bookings = Booking::with(['tour.area', 'tour.hotel', 'tour.vehicle', 'tour.guide'])
            ->when($query, function ($queryBuilder, $query) {
                return $queryBuilder->whereHas('tour', function ($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%');
                })
                    ->orWhere('order_code', 'like', '%' . $query . '%')
                    ->orWhere('payment_status', 'like', '%' . $query . '%');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function destroy($id)
    {
        try {
            $booking = Booking::with(['user', 'tour'])->find($id);

            if ($booking) {
                Mail::to($booking->user->email)->send(new StatusBooking($booking, 'delete'));
                $booking->delete();
                return redirect()->route('admin.bookings.index')->with('success', 'Hủy booking thành công!');
            }
        } catch (\Exception $e) {
            \Log::error('Error updating area: ' . $e->getMessage());

            // Chuyển hướng về trang danh sách với thông báo lỗi
            return redirect()->route('admin.bookings.index')->with('error', 'Đã xảy ra lỗi !!');
        }
    }

    public function updatePaymentStatus(Request $request)
    {
        $booking = Booking::with(['user', 'tour'])->find($request->id);

        if ($booking) {
            $booking->payment_status = $request->payment_status;
            $booking->save();

            Mail::to($booking->user->email)->send(new StatusBooking($booking, 'action'));

            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }
}
