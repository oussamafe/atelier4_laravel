<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::id();
        $userProductList = UserProduct::where('user_id',$id)->get('product_id');
        $products = array();
        foreach($userProductList as $product_id) {
            $product = Product::find($product_id)->first();
            array_push($products,$product);
        }
        return view('home')->with('ListeProduit',$products);
    }
}
