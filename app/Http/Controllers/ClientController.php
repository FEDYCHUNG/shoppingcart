<?php

namespace App\Http\Controllers;

use App\Classes\Cart;
use App\Models\Category;
use App\Models\Client;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
        $products = Product::where("status", config("constants.PRODUCT_ACTIVE"))->where("product_category", $product_category_operand, $id)->paginate(16);

        return view('client.shop', ["categories" => $categories, "products" => $products]);
    }

    public function cart()
    {
        $delivery_price = 0;
        $discount = 0;

        if (!Session::has('cart'))
            return view('client.cart', ["carts" => false, "delivery_price" => $delivery_price, "discount" => $discount]);

        $old_cart = (Session::has('cart')) ? Session::get('cart') : null;
        $carts = new Cart($old_cart);

        return view('client.cart', ["carts" => $carts, "delivery_price" => $delivery_price, "discount" => $discount]);
    }

    public function checkout()
    {
        if (!Session::has("client")) return view("client.login");

        return view('client.checkout');
    }

    public function login(Request $request)
    {
        if (!$request->has("email")) return view('client.login');

        $this->validate($request, [
            "email" => "required|email",
            "password" => "required|min:4",
        ]);

        $client = Client::where(['email' => $request->email])->firstOrFail();

        if (!$client) return back()->with("status", "You do not have an account. Please Sign Up !!!");

        if (Hash::check($request->password, $client->password)) {
            Session::put("client", $client);
            return redirect("/");
        } else {
            return back()->with("status", "Wrong Email or Password !!!");
        }
    }

    public function signup()
    {
        return view('client.signup');
    }

    public function orders()
    {
        return view('admin.orders');
    }

    public function addToCart($id)
    {
        $product = Product::find($id);

        $old_cart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($old_cart);
        $cart->add($product, $id);
        Session::put("cart", $cart);

        return redirect()->route("shop");
    }

    public function updateQty(Request $request, $id)
    {
        $old_cart = Session::has('cart') ? Session::get("cart") : null;

        $cart = new Cart($old_cart);
        $cart->updateQty($id, $request->quantity);
        Session::put("cart", $cart);

        return back();
    }

    public function removeFromCart($id)
    {
        $old_cart = Session::has('cart') ? Session::get("cart") : null;
        $cart = new Cart($old_cart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put("cart", $cart);
            return back();
        } else {
            Session::forget("cart");
            return redirect()->route("shop");
        }
    }

    public function createAccount(Request $request)
    {
        $this->validate($request, [
            "email" => "required|email|unique:clients",
            "password" => "required|min:4",
        ]);

        $client = new Client();
        $client->email = $request->email;
        $client->password = Hash::make($request->password);

        $client->save();

        return back()->with("status", "Your account has been successfully created !!!");
    }

    public function logout()
    {
        Session::flush();
        return redirect("/");
    }
}