<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //

    public function addproduct()
    {
        $categories = Category::all();

        return view("admin.addproduct", ["categories" => $categories]);
    }

    public function products()
    {
        $products = DB::table('products')->select("products.*", "categories.category_name")
            ->join("categories", 'products.product_category', "=", "categories.id")->get();

        return view("admin.products", ["products" => $products]);
    }

    public function saveProduct(Request $request)
    {

        $this->validate($request, [
            "product_name" => "required",
            "product_price" => "required",
            "product_category" => "required",
            "product_image" => "image|nullable|mimes:jpeg,jpg,png,bmp,gif,svg|max:1999",
        ]);

        $products = new Product();
        $products->product_name = $request->product_name;
        $products->product_price = $request->product_price;
        $products->product_category = $request->product_category;

        $file_name_to_store = "no_image.jpg";
        if ($request->hasFile("product_image")) {
            $file_name_with_ext = $request->file("product_image")->getClientOriginalName();
            $file_name = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
            $extension = $request->file("product_image")->getClientOriginalExtension();
            $file_name_to_store = $file_name . "_" . time() . "." . $extension;

            $path = $request->file("product_image")->storeAs('public/product_images', $file_name_to_store);
        }
        $products->product_image = $file_name_to_store;
        $products->status = config("constants.PRODUCT_ACTIVE");

        $products->save();

        return back()->with('status', 'The product name has been saved successfully !!');
    }

    public function editProduct($id)
    {
        $categories = Category::all();
        $product = Product::find($id);

        return view("admin.editproduct", ["categories" => $categories, "product" => $product]);
    }

    public function updateProduct(Request $request)
    {
        $this->validate($request, [
            "product_name" => "required",
            "product_price" => "required",
            "product_category" => "required",
            "product_image" => "image|nullable|mimes:jpeg,jpg,png,bmp,gif,svg|max:1999",
        ]);

        $products = Product::find($request->id);

        $products->product_name = $request->product_name;
        $products->product_price = $request->product_price;
        $products->product_category = $request->product_category;

        if ($request->hasFile("product_image")) {
            $file_name_with_ext = $request->file("product_image")->getClientOriginalName();
            $file_name = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
            $extension = $request->file("product_image")->getClientOriginalExtension();
            $file_name_to_store = $file_name . "_" . time() . "." . $extension;

            $path = $request->file("product_image")->storeAs('public/product_images', $file_name_to_store);


            if ($products->product_image != "no_image.jpg") {
                Storage::delete("public/product_images/" . $products->product_image);
            }

            $products->product_image = $file_name_to_store;
        }

        $products->save();

        return redirect()->route('admin.products.products')->with('status', 'The product name has been updated successfully !!');
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);

        if ($product->product_image != "no_image.jpg")
            Storage::delete("public/product_images/" . $product->product_image);

        $product->delete();

        return back()->with("status", "The product name has been deleted successfully !!!");
    }

    public function activeUnactiveProduct($id, $status_update)
    {
        $product = Product::find($id);
        $product->status = (int) $status_update;
        $product->save();
        return back()->with("status", "The product has been " . (intval($status_update) == config('constants.PRODUCT_ACTIVE') ? "Active" : "Unactivate") . " successfully !!!");
    }
}