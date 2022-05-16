<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function home()
    {
        $sliders = Slider::where("status", config("constants.SLIDER_ACTIVE"))->get();
        $products = Product::where("status", config("constants.PRODUCT_ACTIVE"))->get();
        return view('client.home', ["sliders" => $sliders, "products" => $products]);
    }

    public function shop($id = "")
    {
        $categories = Category::all();

        $product_category_operand = ($id == "") ? "!=" : "=";
        $products = Product::where("status", config("constants.PRODUCT_ACTIVE"))->where("product_category", $product_category_operand, $id)->paginate(4);

        return view('client.shop', ["categories" => $categories, "products" => $products]);
    }

    public function cart()
    {
        return view('client.cart');
    }

    public function checkout()
    {
        return view('client.checkout');
    }

    public function login()
    {
        return view('client.login');
    }

    public function signup()
    {
        return view('client.signup');
    }

    public function orders()
    {
        return view('admin.orders');
    }
}