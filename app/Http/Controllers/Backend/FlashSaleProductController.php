<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FlashSaleItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use Illuminate\Http\Request;

class FlashSaleProductController extends Controller
{
    public function index(FlashSaleItemDataTable $dataTable)
    {
        $flashSale = FlashSale::first();
        $products = Product::whereIsApproved(1)->whereStatus(1)->orderBy('id', 'desc')->get();
        return $dataTable->render('admin.flash-sale.index', compact('flashSale', 'products'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'end_date' => ['required'],
        ]);
        FlashSale::updateOrCreate([
            'id' => 1
        ], [
            'end_date' => $request->end_date,
        ]);

        toastr()->success('Updated successfully!');
        return redirect()->back();
    }

    public function addProducts(Request $request)
    {
        $request->validate([
            'product' => ['required', 'unique:flash_sale_items,product_id'],
            'show_at_home' => ['required'],
            'status' => ['required'],
        ], [
            'product.unique' => 'The product is already in flash sale!',
        ]);
        $flashSale = FlashSale::first();
        $flashSaleItem = FlashSaleItem::create([
            'product_id' => $request->product,
            'flash_sale_id' => $flashSale->id,
            'show_at_home' => $request->show_at_home,
            'status' => $request->status,
        ]);

        toastr()->success('Product added successfully!');
        return redirect()->back();
    }

    public function removeProduct($id)
    {
        $item = FlashSaleItem::findOrFail($id);
        $item->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted Successfully',
        ]);
    }

    public function statusChange(Request $request)
    {
        $item = FlashSaleItem::findOrFail($request->id);
        $item->update([
            'status' => $request->status == 'true' ? 1 : 0,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Updated Successfully',
        ]);
    }

    public function showAtHomeStatusChange(Request $request)
    {
        $item = FlashSaleItem::findOrFail($request->id);
        $item->update([
            'show_at_home' => $request->show_at_home == 'true' ? 1 : 0,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Updated Successfully',
        ]);
    }
}
