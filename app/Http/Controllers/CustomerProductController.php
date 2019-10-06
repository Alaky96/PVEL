<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\ProductRequest;

class CustomerProductController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        //Si le produit n'existe pas, 404
        if(is_null($product))
            abort(404);

        //Si le produit existe, mais qu'il n'est pas activé ou approuvé et que l'utilisateur n'est pas admin ou sont propriétaire

        else if(($product->approved == false || $product->active == false) && (auth()->user()->type == "ad" || auth()->user()->id == $product->fk_owner))
            return view('productpage', ['product'=>$product])->with("error", "Le produit n'est pas activé ou approuvé.");
        else if(($product->approved == false || $product->active == false) && !(auth()->user()->type == "ad" || auth()->user()->id == $product->fk_owner))
            abort("404");
        return view('productpage', ['product'=>$product]);
    }
}
