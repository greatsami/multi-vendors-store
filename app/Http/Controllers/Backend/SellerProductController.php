<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SellerPendingProductDataTable;
use App\DataTables\SellerProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SellerProductController extends Controller
{
    public function index(SellerProductDataTable $dataTable)
    {
        return $dataTable->render('admin.products.seller-products.index');
    }

    public function pendingProducts(SellerPendingProductDataTable $dataTable)
    {
        return $dataTable->render('admin.products.seller-pending-products.index');
    }

    public function changeApproveStatus(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->is_approved = $request->value;
        $product->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Approve status updated successfully',
        ]);
    }
}
