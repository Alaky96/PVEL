@extends('layouts.main')

@section('content')
    <style>

        .orderdetail
        {
            border: 1px gray solid;
        }
    </style>
    <h2>Vos Commandes</h2>
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
            <th scope="col">#</th>
            <th scope="col">Date</th>
            <th scope="col">Total</th>
            <th scope="col">Status</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
        <tr>

            <td>{{sprintf('%06d', $order->id)}}</td>
            <td>{{$order->purchase_date}}</td>
            <td>${{$order->total}}</td>
            <td>{{trans("status.".$order->getStatus->value)}}</td>
            <td><a data-toggle="collapse" href="#collapse{{$order->id}}" role="button" aria-expanded="false" aria-controls="collapse{{$order->id}}">{{__("general.details")}}</a> <a href="{{route("customerOrder.track", ['id'=>$order->id])}}">Expéditions</a></td>
        </tr>
        </tbody>
        <tbody class="collapse orderdetail" id="collapse{{$order->id}}">
        @foreach($order->lines as $line)
            <tr>
                <td> - <a href = "{{route("customer.product", ['id'=>$line->product->id])}}">{{$line->product->name}}</a></td>
                <td>{{$line->vendor->name}}</td>
            </tr>
        @endforeach

        </tbody>

        @endforeach
    </table>
@endsection
