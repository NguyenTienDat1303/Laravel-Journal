<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function homeSlider()
    {
        $sliders = Slider::latest() -> get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function addSlider()
    {
        return view('admin.slider.create');
    }

    public function storeSlider(Request $request)
    {
        $image = $request -> file('image');

        $name_gen = hexdec(uniqid()).'.'.$image -> getClientOriginalExtension();
        Image::make($image) -> resize(1920, 1080) -> save('images/sliders/'.$name_gen);
        $last_img = 'images/sliders/'.$name_gen;

        Slider::insert([
            'title' => $request -> title,
            'description' => $request -> description,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);
        return Redirect() -> route('home.slider') -> with('success', 'Slider inserted successfully');
    }
}
