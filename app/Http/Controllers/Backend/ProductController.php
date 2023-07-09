<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\SubCategory;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required', 'max:600'],
            'long_description' => ['required'],
            'status' => ['required'],
            'seo_title' => ['nullable', 'max:200'],
            'seo_description' => ['nullable', 'max:250'],
        ]);

        $data['thumb_image'] = $this->uploadImage($request, 'image', 'uploads/products');
        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name);
        $data['vendor_id'] = auth()->user()->vendor->id;
        $data['category_id'] = $request->category;
        $data['sub_category_id'] = $request->sub_category;
        $data['child_category_id'] = $request->child_category;
        $data['brand_id'] = $request->brand;
        $data['qty'] = $request->qty;
        $data['short_description'] = $request->short_description;
        $data['long_description'] = $request->long_description;
        $data['video_link'] = $request->video_link;
        $data['sku'] = $request->sku;
        $data['price'] = $request->price;
        $data['offer_price'] = $request->offer_price;
        $data['offer_start_date'] = $request->offer_start_date;
        $data['offer_end_date'] = $request->offer_end_date;
        $data['product_type'] = $request->product_type;
        $data['status'] = $request->status;
        $data['is_approved'] = 1;
        $data['seo_title'] = $request->seo_title;
        $data['seo_description'] = $request->seo_description;

        Product::create($data);
        toastr()->success('Created successfully!');
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $subCategories = SubCategory::whereCategoryId($product->category_id)->get();
        $childCategories = ChildCategory::whereSubCategoryId($product->sub_category_id)->get();
        $brands = Brand::all();
        return view('admin.products.edit', compact('product', 'categories', 'subCategories', 'childCategories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required', 'max:600'],
            'long_description' => ['required'],
            'status' => ['required'],
            'seo_title' => ['nullable', 'max:200'],
            'seo_description' => ['nullable', 'max:250'],
        ]);

        $data['thumb_image'] = $this->updateImage($request, 'image', 'uploads/products', public_path('uploads/products/'.$product->thumb_image));
        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name);
        $data['vendor_id'] = auth()->user()->vendor->id;
        $data['category_id'] = $request->category;
        $data['sub_category_id'] = $request->sub_category;
        $data['child_category_id'] = $request->child_category;
        $data['brand_id'] = $request->brand;
        $data['qty'] = $request->qty;
        $data['short_description'] = $request->short_description;
        $data['long_description'] = $request->long_description;
        $data['video_link'] = $request->video_link;
        $data['sku'] = $request->sku;
        $data['price'] = $request->price;
        $data['offer_price'] = $request->offer_price;
        $data['offer_start_date'] = $request->offer_start_date;
        $data['offer_end_date'] = $request->offer_end_date;
        $data['product_type'] = $request->product_type;
        $data['status'] = $request->status;
        $data['is_approved'] = 1;
        $data['seo_title'] = $request->seo_title;
        $data['seo_description'] = $request->seo_description;

        $product->update($data);
        toastr()->success('Updated successfully!');
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->deleteImage($product->thumb_image);

        $galleryImages = $product->images()->get();
        foreach ($galleryImages as $galleryImage) {
            $this->deleteImage(public_path('uploads/products/'.$galleryImage));
            $galleryImage->delete();
        }

        $variants = $product->variants()->get();
        foreach ($variants as $variant) {
            $variant->items()->delete();
            $variant->delete();
        }
        $product->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Deleted Successfully',
        ]);

    }

    public function changeStatus(Request $request)
    {
        $category = Product::findOrFail($request->id);
        $category->update([
            'status' => $request->status == 'true' ? 1 : 0,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Updated Successfully',
        ]);
    }

    public function getSubCategories(Request $request)
    {
        return SubCategory::whereCategoryId($request->id)->whereStatus(1)->get();
    }

    public function getChildCategories(Request $request)
    {
        return ChildCategory::whereSubCategoryId($request->id)->whereStatus(1)->get();
    }

}
