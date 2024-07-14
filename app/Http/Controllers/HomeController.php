<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use App\Models\Product;
use diglactic\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;



class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $array=[];
        //News
        $news = Product::take(2)->get();

        //Latest Products
        $latestProducts = Product::orderBy('id', 'DESC')->take(8)->get();

        //Best Sellers
        $orders = OrderProduct::all()->groupBy('product_id');
        foreach($orders as $order) {
            foreach($order as $product) {
                array_push($array, $product->product_id);
            }
        }
        $bestsellers = Product::whereIn('id', $array)->take(8)->get();

        return view('home', [
            'latestProducts' => $latestProducts,
            'news' => $news,
            'bestsellers' => $bestsellers
        ]);
    }
    public function cart() {
        return view('cart');
    }

    public function orders() {
        $user =auth()->user();
        return view('orders', [
            'orders' => $user->orders
        ]);
    }

    public function contact() {
        return view('contact');
    }
    // public function checkout() {
    //     return view('checkout');
    // }
}
