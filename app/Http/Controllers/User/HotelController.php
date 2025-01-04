<?php

namespace App\Http\Controllers\User;

use App\Models\Area;
use App\Models\Hotel;
use App\Models\Tour;
use Illuminate\Http\Request;

class HotelController
{
    public function hotels() {
        return view('user.hotels');
    }

    public function getAPI(Request $request) {
        try {
            $search = $request->input('name', '');

            $hotels = Hotel::where('name', 'like', '%' . $search . '%')
                        ->paginate(6);

            return response()->json(['success' => true, 'data' => $hotels]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 404);
        }
    }

}
