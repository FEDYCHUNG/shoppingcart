<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function addcategory()
    {
        return view('admin.addcategory');
    }

    public function saveCategory(Request $request)
    {
        $this->validate($request, ['category_name' => 'required|unique:categories']);

        $category = new Category();
        $category->category_name = $request->input('category_name');
        $category->save();

        return back()->with('status', 'The category name has been saved successfully !!');
    }

    public function categories()
    {
        $categories = Category::all();
        return view('admin.categories', ["categories" => $categories]);
    }

    public function editCategory(Request $request)
    {
        $category = Category::find($request->id);
        return view('admin.editcategory', ["category" => $category]);
    }

    public function udpateCategory(Request $request)
    {
        $this->validate($request, ['category_name' => 'required']);

        $category = Category::find($request->id);

        $category->category_name = $request->category_name;

        $category->save();

        return redirect()->route("admin.categories.categories")->with('status', 'The category name has been updated successfully !!');
    }

    public function deleteCategory(Request $request)
    {
        $category = Category::find($request->id);
        $category->delete();

        return back()->with('status', 'The category name has been delete successfully !!');
    }
}