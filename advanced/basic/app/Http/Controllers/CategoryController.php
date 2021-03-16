<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Redirect;

class CategoryController extends Controller
{
    public function allCat()
    {
        //Join table
        $categories = DB::table('categories') 
            -> join('users', 'categories.user_id', 'users.id') 
            -> select('categories.*', 'users.name') 
            -> latest() 
            -> paginate(5);

        // Use eloquent
        // $categories = Category::all();
        // $categories = Category::latest() -> paginate(5);//User with order by desc

        // Use query builder
        // $categories = DB::table('categories') -> latest() -> paginate(5);
        return view('admin.category.index', compact('categories'));
    }

    public function addCat(Request $request)
    {
        $validatedData = $request -> validate([
            'category_name' => 'required|unique:categories|max:255'
        ], [
            'category_name.required' => 'Please input category name!',
            'category_name.max' => 'Category less than 255 characters!'
        ]);

        //This doesn't auto created_at, updated_at
        // Category::insert([
        //     'category_name' => $request -> category_name,
        //     'user_id' => Auth::user() -> id,
        //     'created_at' => Carbon::now()
        // ]);

        //Use it for auto created_at, updated_at
        $category = new Category();
        $category -> category_name = $request -> category_name;
        $category -> user_id = Auth::user() -> id;
        $category -> save();

        // Use query builder
        // $data = array();
        // $data['category_name'] = $request -> category_name;
        // $data['user_id'] = Auth::user() -> id;
        // DB::table('categories') -> insert($data);

        return Redirect() -> back() -> with('success', 'Category inserted successfully');
    }
}
