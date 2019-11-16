<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{

    public function showUsers()
    {
        $users = User::orderBy("name", 'asc')->paginate(5);
        return view("ListUsers", ['users'=>$users]);
    }

    public function showProducts(Request $request)
    {
        $products = Product::orderBy($request->orderBy ?? 'created_at', $request->order??'desc')->paginate(10);
        return view("ListProducts", ['products'=> $products])->with("title", trans("product.yourproduct"));
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back()->with("success", trans("validation.changeSaved"));
    }

    public function editUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->type = $request->type;
        $user->save();

        return redirect()->back()->with("success", trans("validation.changeSaved"));
    }

    public function __construct()
    {
        $this->middleware("validateadmin");
        $this->middleware('multilanguages');
    }
}
