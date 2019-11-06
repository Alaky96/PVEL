<?php
namespace App\Service;
use App\Cart;
class CartService
{
    public function showView($with = null, $message = null)
    {
        $carts = Cart::where("fk_owner", auth()->user()->id)->get();

        $subtotal = 0.0;
        $shipping = 0.0;

        foreach($carts as $cart)
        {
        $subtotal += $cart->product->price * $cart->qty;
        $shipping += $cart->product->shipping_price * $cart->qty;
        }
        if(is_null($with) || is_null($message))
        return view("cart", ['carts'=> $carts, 'subtotal'=>$subtotal, 'shipping'=>$shipping]);
        else
        return view("cart", ['carts'=> $carts, 'subtotal'=>$subtotal, 'shipping'=>$shipping])->with($with, $message);
    }
}
