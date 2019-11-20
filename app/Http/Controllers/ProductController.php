<?php

namespace App\Http\Controllers;

use App\Category;
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
    public function index(Request $request)
    {
        //$products = Product::where("fk_owner", auth()->user()->id);
        $products = Product::where("fk_owner", auth()->user()->id)->orderBy($request->orderBy ?? 'created_at', $request->order??'desc')->paginate(10);
        return view("ListProducts", ['products'=> $products])->with("title", @trans("product.yourproduct"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view("addProduct", ['categories'=>$categories]);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        if(Auth::check())
        {
            if($product->fk_owner != Auth::id() && Auth::user()->type != 'ad')
                abort(403);
        }
        return view("addProduct", ['categories'=>$categories])->with(['product'=> $product]);
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
        self::saveProduct($product, $request, true);
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

    public function saveProduct(Product $product, ProductRequest $request, $edit = false)
    {
        $product->name = $request->name;
        $product->descr = $request->descr;
        $product->price = $request->price;
        $product->shipping_price = $request->shippingprice;
        if(!$edit)
            $product->fk_owner = auth()->user()->id;
        $product->fk_category = $request->category;
        if(Auth::user()->type === "su")
            $product->approved = (false);
        else
            $product->approved = ($request->approved == 'on' ? true : false);
        $product->active = ($request->active == 'on' ? true : false);
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
