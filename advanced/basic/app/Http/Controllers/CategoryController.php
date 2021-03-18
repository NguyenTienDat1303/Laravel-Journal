<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this -> middleware('auth');
    }

    public function allCat()
    {
        //Join table
        // $categories = DB::table('categories') 
        //     -> join('users', 'categories.user_id', 'users.id') 
        //     -> select('categories.*', 'users.name') 
        //     -> latest() 
        //     -> paginate(5);

        // Use eloquent
        // $categories = Category::all();
        $categories = Category::latest() -> paginate(5);//User with order by desc
        $trashCat = Category::onlyTrashed() -> latest() -> paginate(3);

        // Use query builder
        // $categories = DB::table('categories') -> latest() -> paginate(5);
        return view('admin.category.index', compact('categories', 'trashCat'));
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

    public function edit($id)
    {
        //Eloquent update item
        // $categories = Category::find($id);

         //Query bulder update item
        $categories = DB::table('categories') -> where('id', $id) -> first();
        return view('admin.category.edit', compact('categories'));
    }

    public function update(Request $request, $id)
    {
        //Eloquent update item
        // $categories = Category::find($id) -> update([
        //     'category_name' => $request -> category_name
        // ]);
        //Query bulder update item
        $data = array();
        $data['category_name'] = $request -> category_name;
        $categories = DB::table('categories') -> where('id', $id) -> update($data);

        return Redirect() -> route('all.category') -> with('success', 'Category updated successfully');
    }

    public function softDelete($id)
    {
        $delete = Category::find($id) -> delete();
        return Redirect() -> back() -> with('success', 'Category soft deleted successfully');
    }

    public function restore($id)
    {
        $delete = Category::withTrashed() -> find($id) -> restore();
        return Redirect() -> back() -> with('success', 'Category restored successfully');
    }

    public function pDelete($id)
    {
        $delete = Category::onlyTrashed() -> find($id) -> forceDelete();
        return Redirect() -> back() -> with('success', 'Category permanently deleted successfully');
    }
}
