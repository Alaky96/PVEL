<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('productpage');
    }
}
