<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index()
    {
        $flashSale = FlashSale::first();
        $flashSaleItems = FlashSaleItem::with([
            'product' => [
                'category',
                'images'
            ]
        ])
            ->whereStatus(1)
            ->orderBy('id', 'desc')
            ->paginate(1);
        return view('frontend.pages.flash-sale', compact('flashSale', 'flashSaleItems'));
    }
}
