<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::whereStatus(1)->orderBy('serial')->get();
        $flashSale = FlashSale::first();
        $flashSaleItems = FlashSaleItem::with([
            'product' => [
                'category',
                'images'
            ]
        ])->whereShowAtHome(1)->whereStatus(1)->get();
        return view('frontend.home.home', compact('sliders', 'flashSale', 'flashSaleItems'));
    }
}
