<?php

namespace App\Http\Controllers\User;

use App\Models\Area;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index() {
        $areasPreview = Area::withCount('tours')
            ->orderByDesc('tours_count')
            ->take(6)
            ->get();
        $areas = Area::all();
        $data = [
           'areasPreview' => $areasPreview,
           'areas' => $areas
        ];
        return view('user.index')->with('data', $data);
    }

}

