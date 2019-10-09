@extends('layouts.main')

@section('content')
    <h2>{{$title}}</h2>
    <div style = "text-align:right"><a class="btn btn-primary" href="{{route("product.create")}}">{{__("general.add")}}</a></div>
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ __('product.error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
        <tr>
            <th scope="col">{{__("product.name")}}</th>
            <th scope="col">{{__("product.price")}}</th>
            <th scope="col">{{__("product.shippingprice")}}</th>
            <th scope="col">{{__("product.approved")}}</th>
            <th scope="col">{{__("product.active")}}</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
        <tr>

            <td><a href = "{{ url('customer/product/'.$product->id.'') }}">{{$product->name}}</a></td>
            <td>{{$product->price}}</td>
            <td>{{$product->shipping_price}}</td>
            <td><input type="checkbox" disabled {{($product->approved) ? 'checked' : ''}}/> </td>
            <td><input type="checkbox" disabled {{($product->active) ? 'checked' : ''}}/> </td>
            <td><a href = "{{ url('supplier/product/'.$product->id.'/edit') }}">{{__("general.details")}}</a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
