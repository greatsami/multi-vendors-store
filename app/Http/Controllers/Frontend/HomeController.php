<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::whereStatus(1)->orderBy('serial')->get();

        return view('frontend.home.home', compact('sliders'));
    }
}
