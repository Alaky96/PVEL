<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$products = Product::where("fk_owner", auth()->user()->id);
        $products = Product::where("fk_owner", auth()->user()->id)->orderBy("created_at", "asc")->get();
        return view("ListProducts", ['products'=> $products])->with("title", @trans("product.yourproduct"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("addProduct");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {


        $product = new Product();
        self::saveProduct($product, $request);
        return redirect()->route("product.index")->with("success", trans("product.product added"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view("addProduct")->with(['product'=> $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        self::saveProduct($product, $request);
        return redirect()->back()->with("success", trans("product.product updated"));
    }


    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route("product.index")->with("success", trans("product.deleted"));
    }

    //private methods

    //for upload
    public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : str_random(25);

        $file = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);

        return $file;
    }

    public function saveProduct(Product $product, ProductRequest $request)
    {
        $product->name = $request->name;
        $product->descr = $request->descr;
        $product->price = $request->price;
        $product->shipping_price = $request->shippingprice;
        $product->fk_owner = auth()->user()->id;
        $product->approved = false;
        $product->active = true;
        $product->out_of_stock = false;
        $product->featured = false;


        if ($request->has('image')) {
            // Get image file
            $image = $request->file('image');
            // Make a image name based on user name and current timestamp
            $name = time();
            // Define folder path
            $folder = '/uploads/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            $product->image_path = $filePath;
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
        }

        $product->save();
    }
}