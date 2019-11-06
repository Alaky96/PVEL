<?php

namespace App\Http\Controllers;

use App\Shipment;
use App\ShipmentDet;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipments = Shipment::where("fk_vendor", Auth()->id())->get();
        return view("ListShipments", ['shipments'=>$shipments])->with('title', "Vos Expéditions");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("ShipmentDetails", ['shipment'=>Shipment::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $shipment = Shipment::find($id);
        $shipment->tracking_number = $request->trackingnumber;
        $shipment->carrier = $request->carrier;
        $shipment->status = $request->status;
        $shipment->save();
        return redirect()->back();
    }

}
