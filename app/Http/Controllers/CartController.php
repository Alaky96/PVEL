<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //Add an item to cart
    public function addItem(Request $request)
    {
        //First we check if we already have this combination product/user
        $cart = Cart::where("fk_owner", auth()->user()->id)->where("fk_product", $request->productid)->first();
        if(empty($cart))
        {
            $cartItem =  new Cart();
            $cartItem->fk_owner = auth()->user()->id;
            $cartItem->fk_product = $request->productid;
            $cartItem->qty = 1;
            $cartItem->save();
        }
        else
        {
            $updatedCart = Cart::find($cart->id);
            $updatedCart->qty = $cart->qty + 1;
            $updatedCart->save();
        }

        //if yes, we update with qty++

        //We add new record
        //Need to add config key eventually

       return redirect()->back()->with("success", trans("cart.itemadded"));
    }

    public function show(Request $request)
    {
        $carts = Cart::where("fk_owner", auth()->user()->id)->get();

        $subtotal = 0.0;
        $shipping = 0.0;

        foreach($carts as $cart)
        {
            $subtotal += $cart->product->price * $cart->qty;
            $shipping += $cart->product->shipping_price * $cart->qty;
        }
        return view("cart", ['carts'=> $carts, 'subtotal'=>$subtotal, 'shipping'=>$shipping]);
    }

    public function delete(Request $request, $id)
    {
        Cart::destroy($id);
        return redirect()->back();
    }
    public function checkout(Request $request)
    {
        return view("checkout");
    }

    public function __construct()
    {
        //User need to be logged in to view this
        $this->middleware('auth');
        $this->middleware('multilanguages');
    }
}
