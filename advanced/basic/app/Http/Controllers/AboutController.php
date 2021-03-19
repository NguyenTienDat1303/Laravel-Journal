<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth');
    }

    public function homeAbout()
    {
        $homeAbout = HomeAbout::latest() -> get();
        return view('admin.home.index', compact('homeAbout'));
    }

    public function addAbout()
    {
        return view('admin.home.create');
    }

    public function storeAbout(Request $request)
    {
        HomeAbout::insert([
            'title' => $request -> title,
            'short_dis' => $request -> short_dis,
            'long_dis' => $request -> long_dis,
            'created_at' => Carbon::now()
        ]);
        return Redirect() -> route('home.about') -> with('success', 'About inserted successfully');
    }

    public function editAbout($id)
    {
        $about = HomeAbout::find($id);
        return view('admin.home.edit', compact('about'));
    }

    public function updateAbout(Request $request, $id)
    {
        HomeAbout::find($id) -> update([
            'title' => $request -> title,
            'short_dis' => $request -> short_dis,
            'long_dis' => $request -> long_dis,
            'updated_at' => Carbon::now()
        ]);
        return Redirect() -> route('home.about') -> with('success', 'About updated successfully');
    }

    public function deleteAbout($id)
    {
        HomeAbout::find($id) -> delete();
        return Redirect() -> route('home.about') -> with('success', 'About deleted successfully');
    }
}
