<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function home()
    {
        $sliders = Slider::all();
        return view('client.home', ["sliders" => $sliders]);
    }

    public function shop()
    {
        return view('client.shop');
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