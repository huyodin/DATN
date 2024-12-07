<?php

namespace App\Http\Controllers\User;

use App\Models\AirLineTicket;
use App\Models\Area;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AirlineTicketsController
{
    public function AirlineTickets() {
        $areas = Area::all();
        $data = [
            'areas' => $areas,
        ];
        return view('user.airline_tickets')->with('data', $data);
    }

    public function getAPI(Request $request) {
        try {
            $area_id_start = $request->input('area_id_start', null);
            $startDate = $request->input('start_date', null);
            $endDate = $request->input('end_date', null);
            $area_id_end = $request->input('area_id_end', null);

            $query = AirLineTicket::with(['areaStart', 'areaEnd']);

            if ($area_id_start) {
                $query->where('area_id_start', $area_id_start);
            }

            if ($startDate) {
                // Chuyển đổi start_date thành Carbon và so sánh
                $startDate = Carbon::parse($startDate)->startOfDay();
                $query->where('start_date', '>=', $startDate);
            }

            if ($endDate) {
                // Chuyển đổi end_date thành Carbon và so sánh
                $endDate = Carbon::parse($endDate)->endOfDay();
                $query->where('end_date', '<=', $endDate);
            }

            if ($area_id_end) {
                $query->where('area_id_end', $area_id_end);
            }

            $airLineTicket = $query->paginate(6);

            $airLineTicket->getCollection()->transform(function ($ticket) {
                $ticket->logo_url = asset($ticket->logo); // Tạo URL hình ảnh từ storage
                return $ticket;
            });

            return response()->json(['success' => true, 'data' => $airLineTicket]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 404);
        }
    }
}
