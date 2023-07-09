<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{

    use ImageUploadTrait;

    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
        // return view('admin.slider.index');
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'banner' => ['required', 'image', 'max:2000'],
            'type' => ['required', 'max:200'],
            'title' => ['required', 'max:200'],
            'starting_price' => ['max:200'],
            'btn_url' => ['url'],
            'serial' => ['required', 'integer'],
            'status' => ['required'],
        ]);

        $data['banner'] = $this->uploadImage($request, 'banner', 'uploads/sliders');

        $slider = Slider::create($data);

        toastr()->success('Created successfully!');
        return redirect()->back();

    }

    public function show(Slider $slider)
    {
        //
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }


    public function update(Request $request, Slider $slider)
    {
        $data = $request->validate([
            'banner' => ['nullable', 'image', 'max:2000'],
            'type' => ['required', 'max:200'],
            'title' => ['required', 'max:200'],
            'starting_price' => ['max:200'],
            'btn_url' => ['url'],
            'serial' => ['required', 'integer'],
            'status' => ['required'],
        ]);

        $data['banner'] = $this->updateImage($request, 'banner', 'uploads/sliders', public_path('uploads/sliders/'. $slider->banner));

        $slider->update($data);

        toastr()->success('Updated successfully!');
        return redirect()->route('admin.sliders.index');
    }

    public function destroy(Slider $slider)
    {
        $this->deleteImage(public_path('uploads/sliders/'. $slider->banner));
        $slider->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Deleted Successfully',
        ]);
    }
}
