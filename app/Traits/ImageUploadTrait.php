<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait ImageUploadTrait
{
    public function uploadImage(Request $request, $inputName, $path)
    {
        if ($request->hasFile($inputName)){

            $image = $request->file($inputName);
            $imageName = 'media_'.rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path($path), $imageName);
            return $imageName;
        }
    }

    public function uploadMultipleImages(Request $request, $inputName, $path)
    {
        $imagesPaths = [];
        if ($request->hasFile($inputName)){

            $images = $request->file($inputName);
            foreach ($images as $image) {
                $imageName = 'media_'.rand().'.'.$image->getClientOriginalExtension();
                $image->move(public_path($path), $imageName);
                $imagesPaths[] = $imageName;
            }

            return $imagesPaths;
        }
    }

    public function updateImage(Request $request, $inputName, $path, $oldPath = null)
    {
        if ($request->hasFile($inputName)){
            // dd($oldPath);
            if (File::exists($oldPath)){
                File::delete($oldPath);
            }
            $image = $request->file($inputName);
            $imageName = 'media_'.rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path($path), $imageName);
            return $imageName;
        } else {
            $oldPathExploded = explode('/', $oldPath);
            return end($oldPathExploded);
        }
    }

    public function deleteImage($path)
    {
        if (File::exists($path)){
            File::delete($path);
        }
    }
}
