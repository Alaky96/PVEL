<?php

namespace App\Http\Controllers;

use App\Category;
use App\Mail\AskToSupplier;
use App\Mail\OrderConfirmation;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Comment;

class CustomerProductController extends Controller
{

    public function __construct()
    {
        //User need to be logged in to view this
        $this->middleware('multilanguages');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $product = Product::find($id);
        $comments = Comment::where('fk_product',$product->id)->orderBy('comment_date', 'desc')->paginate(5);
        $rating = Comment::where('fk_product', $product->id)->avg('rating');

        //Si le produit n'existe pas, 404
        if(is_null($product))
            abort(404);

        if(!Auth::check() && ($product->active == false || $product->approved == false))
            abort(404);

        //Si le produit existe, mais qu'il n'est pas activé ou approuvé et que l'utilisateur n'est pas admin ou sont propriétaire

        else if(($product->approved == false || $product->active == false) && (auth()->user()->type == "ad" || auth()->user()->id == $product->fk_owner))
            return view('productpage', ['product'=>$product, 'comments'=>$comments, 'rating'=>$rating])->with("error", "Le produit n'est pas activé ou approuvé.");
        else if(($product->approved == false || $product->active == false) && !(auth()->user()->type == "ad" || auth()->user()->id == $product->fk_owner))
            abort("404");
        return view('productpage', ['product'=>$product, 'comments'=>$comments, 'rating'=>$rating]);
    }

    public function askQuestion(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'text' => 'required',
            'name' => 'required',
        ]);

        Mail::to('g.brunet96@gmail.com')->send(new AskToSupplier($request->email, $request->name, $request->text));
        return redirect()->back()->with('success', trans("general.messageSent"));
    }

    public function storeComment(Request $request)
    {
        if(empty($request->text))
            return redirect()->back()->with('commentError', trans("validation.required", ['attribute'=>trans("general.comment")]));
        if($request->newRating === "0")
            return redirect()->back()->with('commentError', trans("validation.required", ['attribute'=>trans("general.rating")]))->with('oldComment', $request->text);
        $comment = new Comment();
        $comment->fk_product = $request->productID;
        $comment->fk_user = Auth::id();
        $comment->user_text = $request->text;
        $comment->rating = $request->newRating;
        $comment->comment_date = date('Y-m-d H:i:s');
        $comment->save();
        return redirect()->back()->with('commentSuccess',trans('general.commentAdded'));
    }

    public function deleteComment($id)
    {
        Comment::find($id)->delete();
        return redirect()->back()->with('success', trans("general.commentDeleted"));
    }

    public function index($category = null, $supplier = null)
    {
        $title = "";
        $suppliers = User::where('type', "su")->get();
        $categories = Category::all();
        if(is_null($supplier) && is_null($category))
        {
            $products = Product::where('approved', true)->where('active', true)->paginate(9);
            $title = trans("product.allProducts");
        }

        else if(is_null($supplier))
            return 'category';
        else
            return 'category and supplier';
        return view("products", ['products'=>$products, 'suppliers'=>$suppliers, 'categories'=>$categories])->with('title', $title);

    }

    public function supplier($supplier)
    {
        return 'supplier';
    }

    public function getProducts(Request $request)
    {
        sleep(1);
        $suppliers = $request->get('suppliers');
        $categories = $request->get('categories');
        $result = null;
        if(is_null($suppliers))
            $result = Product::where('approved', true)->where('active', true);
        else
            $result = Product::whereIn('fk_owner', $suppliers)->where('approved', true)->where('active', true);
        if(!is_null($categories))
            $result->whereHas('category', function($q) use($categories)
            {
                $q->whereIn('id', $categories);

            });

        return \View::make('productPartial')->with('products', $result->paginate(9))->with("width", $request->get("width"));
    }
}
