<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserProfileController extends Controller
{
    public function index()
    {
        return view('frontend.dashboard.profile');
    }
    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,'.auth()->user()->id],
            'image' => ['image', 'max:2048'],
        ]);

        if ($request->hasFile('image')){
            if (auth()->user()->image != '' && File::exists(public_path('uploads/').auth()->user()->image)){
                File::delete(public_path('uploads/').auth()->user()->image);
            }

            $image = $request->file('image');
            $imageName = rand().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $data['image'] = $imageName;
        }

        auth()->user()->update($data);
        toastr()->success('Profile updated successfully!');
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        auth()->user()->update([
            'password' => bcrypt($data['password'])
        ]);
        toastr()->success('Password updated successfully!');
        return redirect()->back();

    }

}
