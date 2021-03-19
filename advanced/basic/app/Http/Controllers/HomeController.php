<?php

namespace App\Http\Controllers;

use App\Models\Multipic;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth');
    }

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

    public function editSlider($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function updateSlider(Request $request, $id)
    {
        $image = $request -> file('image');
        if($image){
            $name_gen = hexdec(uniqid()).'.'.$image -> getClientOriginalExtension();
            Image::make($image) -> resize(1920, 1080) -> save('images/sliders/'.$name_gen);
            $last_img = 'images/sliders/'.$name_gen;
            Slider::find($id) -> update([
                'title' => $request -> title,
                'description' => $request -> description,
                'image' => $last_img,
                'updated_at' => Carbon::now()
            ]);
        } else {
            Slider::find($id) -> update([
                'title' => $request -> title,
                'description' => $request -> description,
                'updated_at' => Carbon::now()
            ]);
        }
        return Redirect() -> route('home.slider') -> with('success', 'Slider updated successfully');
    }

    public function deleteSlider($id)
    {
        Slider::find($id) -> delete();
        return Redirect() -> route('home.slider') -> with('success', 'Slider deleted successfully');
    }

    public function portfolio()
    {
        $images = Multipic::all();
        return view('layouts.pages.portfolio', compact('images'));
    }
}
