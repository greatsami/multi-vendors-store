<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class VendorProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, VendorProductVariantDataTable $dataTable)
    {
        $product = Product::findOrFail($request->product);
        if ($product->vendor_id !== auth()->user()->vendor->id) {
            abort(404);
        }

        return $dataTable->render('vendor.products.variants.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.products.variants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'max:200'],
            'product_id' => ['required', 'integer'],
            'status' => ['required'],
        ]);

        ProductVariant::create($data);

        toastr()->success('Created Successfully!');
        return redirect()->route('vendor.product-variants.index', ['product' => $request->product_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductVariant $productVariant)
    {
        if ($productVariant->product->vendor_id !== auth()->user()->vendor->id) {
            abort(404);
        }

        return view('vendor.products.variants.edit', compact('productVariant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductVariant $productVariant)
    {
        if ($productVariant->product->vendor_id !== auth()->user()->vendor->id) {
            abort(404);
        }

        $data = $request->validate([
            'name' => ['required', 'max:200'],
            'product_id' => ['required', 'integer'],
            'status' => ['required'],
        ]);

        $productVariant->update($data);

        toastr()->success('Updated Successfully!');
        return redirect()->route('vendor.product-variants.index', ['product' => $request->product_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductVariant $productVariant)
    {
        if ($productVariant->product->vendor_id !== auth()->user()->vendor->id) {
            abort(404);
        }

        $variantItemsCheck = ProductVariantItem::whereProductVariantId($productVariant->id)->count();
        if ($variantItemsCheck > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'This variant contains items in it, delete the items first for delete this variant.',
            ]);
        }
        $productVariant->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Deleted Successfully',
        ]);
    }

    public function changeStatus(Request $request)
    {
        $variant = ProductVariant::findOrFail($request->id);
        if ($variant->product->vendor_id !== auth()->user()->vendor->id) {
            abort(404);
        }


        $variant->update([
            'status' => $request->status == 'true' ? 1 : 0,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Updated Successfully',
        ]);
    }
}
