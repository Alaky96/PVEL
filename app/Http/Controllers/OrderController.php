<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseOrders;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('multilanguages');
    }

    public function index(Request $request)
    {
        $orders = PurchaseOrders::where("fk_customer", auth()->user()->id)->orderBy("created_at", "desc")->paginate(10);
        return view("ListOrders", ['orders'=> $orders]);
    }

    public function track(Request $request, $id)
    {
        $po = PurchaseOrders::find($id);
        if($po->fk_customer != Auth()->id())
            abort("403");

        return view("ListShipments", ['shipments'=>$po->shipments])->with('title', "Expéditions");
    }
}
