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
            @admin
            <th scope="col">{{__("product.By")}}</th>
            @endadmin
            <th scope="col">{{__("product.price")}}</th>
            <th scope="col">{{__("product.shippingprice")}}</th>
            <th scope="col">{{__("product.approved")}} <a href="{{url(Request::url() . '?orderBy=approved&order=asc')}}"><span class = "glyphicon glyphicon-chevron-up"/></a></th>
            <th scope="col">{{__("product.active")}}</th>
            <th scope="col">{{__("product.creationdate")}} <a href="{{url(Request::url() . '?orderBy=created_at&order=desc')}}"><span class = "glyphicon glyphicon-chevron-up"/></a></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
        <tr>

            <td><a href = "{{ url('customer/product/'.$product->id.'') }}">{{$product->name}}</a></td>
            @admin
            <td>{{$product->supplier->name}}</td>
            @endadmin
            <td>{{$product->price}}</td>
            <td>{{$product->shipping_price}}</td>
            <td><input type="checkbox" disabled {{($product->approved) ? 'checked' : ''}}/> </td>
            <td><input type="checkbox" disabled {{($product->active) ? 'checked' : ''}}/> </td>
            <td>{{date_format($product->created_at,'Y-m-d')}}</td>
            <td><a href = "{{ url('supplier/product/'.$product->id.'/edit') }}">{{__("general.details")}}</a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{$products->links()}}
@endsection
