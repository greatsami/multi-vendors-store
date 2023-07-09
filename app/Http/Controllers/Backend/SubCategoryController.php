<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.sub-categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.sub-categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200', 'unique:sub_categories,name'],
            'category' => ['required'],
            'status' => ['required'],
        ]);
        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name);
        $data['category_id'] = Str::slug($request->category);
        $data['status'] = $request->status;

        SubCategory::create($data);

        toastr()->success('Created successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        $categories = Category::all();
        return view('admin.sub-categories.edit', compact('subCategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $request->validate([
            'name' => ['required', 'max:200', 'unique:sub_categories,name,'.$subCategory->id],
            'category' => ['required'],
            'status' => ['required'],
        ]);

        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name);
        $data['category_id'] = Str::slug($request->category);
        $data['status'] = $request->status;

        $subCategory->update($data);

        toastr()->success('Updated successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        $childCategories = ChildCategory::whereSubCategoryId($subCategory->id)->count();
        if ($childCategories > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'This Item contains sub items for delete this you have to delete sub items first!',
            ]);
        }

        $subCategory->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Deleted Successfully',
        ]);
    }

    public function changeStatus(Request $request)
    {
        $subCategory = SubCategory::findOrFail($request->id);
        $subCategory->update([
            'status' => $request->status == 'true' ? 1 : 0,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Updated Successfully',
        ]);
    }

}
