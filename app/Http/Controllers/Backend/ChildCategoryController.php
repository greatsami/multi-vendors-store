<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.child-categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.child-categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200', 'unique:child_categories,name'],
            'category' => ['required'],
            'sub_category' => ['required'],
            'status' => ['required'],
        ]);
        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name);
        $data['category_id'] = Str::slug($request->category);
        $data['sub_category_id'] = Str::slug($request->sub_category);
        $data['status'] = $request->status;

        ChildCategory::create($data);

        toastr()->success('Created successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(ChildCategory $childCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChildCategory $childCategory)
    {
        $categories = Category::all();
        $subCategories = SubCategory::whereCategoryId($childCategory->category_id)->get();
        return view('admin.child-categories.edit', compact('childCategory', 'categories', 'subCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChildCategory $childCategory)
    {
        $request->validate([
            'name' => ['required', 'max:200', 'unique:child_categories,name,'.$childCategory->id],
            'category' => ['required'],
            'sub_category' => ['required'],
            'status' => ['required'],
        ]);

        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name);
        $data['category_id'] = Str::slug($request->category);
        $data['sub_category_id'] = Str::slug($request->sub_category);
        $data['status'] = $request->status;

        $childCategory->update($data);

        toastr()->success('Updated successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChildCategory $childCategory)
    {
        $childCategory->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Deleted Successfully',
        ]);
    }

    public function changeStatus(Request $request)
    {
        $childCategory = ChildCategory::findOrFail($request->id);
        $childCategory->update([
            'status' => $request->status == 'true' ? 1 : 0,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Updated Successfully',
        ]);
    }

    public function getSubCategories(Request $request)
    {
        $subCategories = SubCategory::whereCategoryId($request->id)->whereStatus(1)->get();
        return $subCategories;
    }
}
