<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class VendorProductVariantItemController extends Controller
{

    public function index(VendorProductVariantItemDataTable $dataTable, $productId, $variantId)
    {
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);
        if ($product->vendor_id !== auth()->user()->vendor->id) {
            abort(404);
        }
        return $dataTable->render('vendor.products.variant-items.index', compact('product', 'variant'));
    }

    public function create($productId, $variantId)
    {
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);
        return view('vendor.products.variant-items.create', compact('product', 'variant'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'integer'],
            'variant_id' => ['required', 'integer'],
            'name' => ['required', 'max:200'],
            'price' => ['required', 'integer'],
            'is_default' => ['required'],
            'status' => ['required']
        ]);

        ProductVariantItem::create([
            'product_variant_id' => $request->variant_id,
            'name' => $request->name,
            'price' => $request->price,
            'is_default' => $request->is_default,
            'status' => $request->status,
        ]);

        toastr()->success('Created successfully!');
        return redirect()->route('vendor.product-variant-items.index', ['productId' => $request->product_id, 'variantId' => $request->variant_id]);
    }

    public function show(ProductVariantItem $productVariantItem)
    {

    }

    public function edit(ProductVariantItem $productVariantItem)
    {
        if ($productVariantItem->product->vendor_id !== auth()->user()->vendor->id) {
            abort(404);
        }

        return view('vendor.products.variant-items.edit', compact('productVariantItem'));
    }

    public function update(Request $request, ProductVariantItem $productVariantItem)
    {
        if ($productVariantItem->product->vendor_id !== auth()->user()->vendor->id) {
            abort(404);
        }

        $request->validate([
            'product_id' => ['required', 'integer'],
            'variant_id' => ['required', 'integer'],
            'name' => ['required', 'max:200'],
            'price' => ['required', 'integer'],
            'is_default' => ['required'],
            'status' => ['required']
        ]);

        $productVariantItem->update([
            'product_variant_id' => $request->variant_id,
            'name' => $request->name,
            'price' => $request->price,
            'is_default' => $request->is_default,
            'status' => $request->status,
        ]);

        toastr()->success('Updated successfully!');
        return redirect()->route('vendor.product-variant-items.index', ['productId' => $request->product_id, 'variantId' => $request->variant_id]);

    }

    public function destroy($itemId)
    {
        $item = ProductVariantItem::findOrFail($itemId);

        if ($item->product->vendor_id !== auth()->user()->vendor->id) {
            abort(404);
        }


        $item->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted Successfully',
        ]);

    }

    public function changeStatus(Request $request)
    {
        $item = ProductVariantItem::findOrFail($request->id);
        if ($item->product->vendor_id !== auth()->user()->vendor->id) {
            abort(404);
        }

        $item->update([
            'status' => $request->status == 'true' ? 1 : 0,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Updated Successfully',
        ]);
    }


}
