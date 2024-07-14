<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;


class CartController extends Controller
{
    public function index() {
        return view('cart');
    }

  /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Cart::add($request->id, $request->name, 1,$request->price)->associate('App\Models\Product');

        return redirect()->route('cart.index')->with('success', 'Product Added to cart !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Cart::remove($id);
        return back()->with('success', 'the product has been removed from cart !');
    }
    public function reset() {
        Cart::destroy();
    }
    public function save($id) {
        $item = Cart::get($id);
        Cart::remove($id);

        Cart::instance('save')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');

        return redirect()->route('cart.index')->with('success', 'Product saved for later !');
    }
}
