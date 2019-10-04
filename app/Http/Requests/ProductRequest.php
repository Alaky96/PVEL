<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'              =>  'required',
            'descr'              =>  'required',
            'price'              =>  'required',
            'shippingprice'              =>  'required',
            'image'     =>  'image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
}