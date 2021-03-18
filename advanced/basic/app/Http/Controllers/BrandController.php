<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Multipic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth');
    }
    
    public function allBrand()
    {
        $brands = Brand::latest() -> paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function storeBrand(Request $request)
    {
        $validatedData = $request -> validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg.jpeg,png'
        ], [
            'brand_name.required' => 'Please input brand name!',
            'brand_name.min' => 'Brand longer than 4 characters!'
        ]);

        $brand_image = $request -> file('brand_image');
        
        // $name_gen = hexdec(uniqid());
        // $img_ext = Str::lower($brand_image -> getClientOriginalExtension());
        // $img_name = $name_gen.'.'.$img_ext;
        // $up_location = 'images/brands/';
        // $last_img = $up_location.$img_name;
        // $brand_image -> move($up_location, $img_name);

        $name_gen = hexdec(uniqid()).'.'.$brand_image -> getClientOriginalExtension();
        Image::make($brand_image) -> resize(300, 200) -> save('images/brands/'.$name_gen);
        $last_img = 'images/brands/'.$name_gen;

        Brand::insert([
            'brand_name' => $request -> brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);
        return Redirect() -> back() -> with('success', 'Brand inserted successfully');
    }

    public function edit($id)
    {
        $brands = Brand::find($id);
        return view('admin.brand.edit', compact('brands'));
    }
    
    public function update(Request $request, $id)
    {
        $validatedData = $request -> validate([
            'brand_name' => 'required|min:4',
        ], [
            'brand_name.required' => 'Please input brand name!',
            'brand_name.min' => 'Brand longer than 4 characters!'
        ]);
        $old_image = $request -> old_image;
        $brand_image = $request -> file('brand_image');
 
        if($brand_image){
            $name_gen = hexdec(uniqid());
            $img_ext = Str::lower($brand_image -> getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'images/brands/';
            $last_img = $up_location.$img_name;
            $brand_image -> move($up_location, $img_name);

            unlink($old_image);

            Brand::find($id) -> update([
                'brand_name' => $request -> brand_name,
                'brand_image' => $last_img,
                'updated_at' => Carbon::now()
            ]);
            return Redirect() -> back() -> with('success', 'Brand updated successfully');
        } else {
            Brand::find($id) -> update([
                'brand_name' => $request -> brand_name,
                'updated_at' => Carbon::now()
            ]);
            return Redirect() -> back() -> with('success', 'Brand updated successfully');
        }
    }

    public function delete($id)
    {
        $brand = Brand::find($id);
        $old_image = $brand -> brand_image;
        unlink($old_image);
        $brand -> delete();
        return Redirect() -> back() -> with('success', 'Brand deleted successfully');
    }

    public function multiPic()
    {
        $images = Multipic::all();
        return view('admin.multipic.index', compact('images'));
    }

    public function storeImg(Request $request)
    {
          $image = $request -> file('image');
        foreach($image as $multi_image) {
            $name_gen = hexdec(uniqid()).'.'.$multi_image -> getClientOriginalExtension();
            Image::make($multi_image) -> resize(300, 300) -> save('images/multi/'.$name_gen);
            $last_img = 'images/multi/'.$name_gen;

            Multipic::insert([
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);
        }  

        return Redirect() -> back() -> with('success', 'Brand inserted successfully');
    }

    public function logout()
    {
        Auth::logout();
        return Redirect() -> route('login') -> with('success', 'User logout');
    }
}
