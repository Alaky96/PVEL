@extends('layouts.main')

@section('content')
    <h2>{{$title}}</h2>
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
            <th scope="col">Client</th>
            <th scope="col">Fournisseur</th>
            <th scope="col">Status</th>
            <th scope="col">Transporteur</th>
            <th scope="col">Numéro de suivi</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($shipments as $shipment)
        <tr>

            <td><a href = "{{route("shipments.edit", ["shipment"=>$shipment->id])}}">{{sprintf('%06d', $shipment->id)}}</a></td>
            <td>{{$shipment->po->purchase_date}}</td>
            <td>{{$shipment->po->customer->name}}</td>
            <td>{{$shipment->supplier->name}}</td>
            <td>{{trans("status.".$shipment->getStatus->value)}}</td>
            <td>{{$shipment->carrier}}</td>
            <td>{{$shipment->tracking_number}}</td>
            <td><a href = "{{route("shipments.edit", ["shipment"=>$shipment->id])}}">{{__("general.details")}}</a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
