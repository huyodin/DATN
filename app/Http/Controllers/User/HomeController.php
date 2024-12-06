<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index() {
        return view('user.index');
    }

    public function about() {
        return view('user.about');
    }

    public function service() {
        return view('user.service');
    }

    public function package() {
        return view('user.package');
    }

    public function blog() {
        return view('user.blog');
    }

    public function single() {
        return view('user.single');
    }

    public function guide() {
        return view('user.guide');
    }

    public function testimonial() {
        return view('user.testimonial');
    }

    public function contact() {
        return view('user.contact');
    }

    public function destination() {
        return view('user.destination');
    }
}

