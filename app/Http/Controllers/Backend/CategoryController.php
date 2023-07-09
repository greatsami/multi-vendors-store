<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.categories.index');
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'max:200', 'unique:categories,name'],
            'icon' => ['required', 'not_in:empty'],
            'status' => ['required'],
        ]);
        $data['slug'] = Str::slug($request->name);

        Category::create($data);

        toastr()->success('Created successfully!');
        return redirect()->back();
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required', 'max:200', 'unique:categories,name,'.$category->id],
            'icon' => ['required', 'not_in:empty'],
            'status' => ['required'],
        ]);
        $data['slug'] = Str::slug($request->name);

        $category->update($data);

        toastr()->success('Updated successfully!');
        return redirect()->back();
    }

    public function destroy(Category $category)
    {
        $subCategories = SubCategory::whereCategoryId($category->id)->count();
        if ($subCategories > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'This Item contains sub items for delete this you have to delete sub items first!',
            ]);
        }
        $category->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Deleted Successfully',
        ]);
    }

    public function changeStatus(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->update([
            'status' => $request->status == 'true' ? 1 : 0,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Updated Successfully',
        ]);
    }

}
