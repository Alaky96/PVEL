@extends('layouts.main')

@section('content')

    <h2>Expéditions #{{sprintf('%06d', $shipment->id)}}</h2>

    <form method="post" action="/shipments/{{$shipment->id}}">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="shipTo">Expédié à</label>
                <input type="text" class="form-control" id="shipTo" name="shipTo" value="{{$shipment->po->full_name}}" disabled>
            </div>
            <div class="form-group col-md-4">
                <label for="carrier">Transporteur</label>
                <input type="text" class="form-control" id="carrier" placeholder="Transporteur" name="carrier" value="{{$shipment->carrier}}" @if($shipment->po->fk_customer == Auth()->id()) disabled @endif>
            </div>
            <div class="form-group col-md-4">
                <label for="trackingnumber">Numéro de suivi</label>
                <input type="text" class="form-control" id="trackingnumber" placeholder="Numéro de suivi" name="trackingnumber" value="{{$shipment->tracking_number}}" @if($shipment->po->fk_customer == Auth()->id()) disabled @endif>
            </div>
        </div>
        <div class="form-group col-md-12">
            <label for="inputAddress">Adresse 1</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" value="{{$shipment->po->adresse_line_1}}" disabled>
        </div>
        <div class="form-group col-md-12">
            <label for="inputAddress2">Adresse 2</label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="" value="{{$shipment->po->adresse_line_2}}" disabled>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">Ville</label>
                <input type="text" class="form-control" id="inputCity" value="{{$shipment->po->city}}" disabled>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Province</label>
                <input type="text" class="form-control" id="inputState" value="{{$shipment->po->prov}}" disabled>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Code Postale</label>
                <input type="text" class="form-control" id="inputZip" value="{{$shipment->po->postal_code}}" disabled>
            </div>
        </div>

        <div class="form-row">

            <div class="form-group col-md-6">
                <label for="carrier">Status</label>
                <select id="status" name="status" class="form-control" @if($shipment->po->fk_customer == Auth()->id()) disabled @endif>
                    @foreach($shipment->statuses as $status)
                        <option @if($status->code === $shipment->status) selected @endif value="{{$status->code}}">{{__("status.".$status->value)}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="shipTo">Date de la commande</label>
                <input type="text" class="form-control" id="shipTo" name="shipTo" value="{{$shipment->po->purchase_date}}" disabled>
            </div>
        </div>
        <h3>Produit(s) à expédiés</h3>
        <table style="width:100%" class="table">
            <thead>
            <tr>
                <th class="text-center"></th>
                <th class="text-center">Produit</th>
                <th class="text-center">Quantité</th>
            </tr>
            </thead>
            <tbody>
            @foreach($shipment->lines as $line)
            <tr>
                <td class="text-center"><img style="max-width:300px;max-height:300px;" class="img-responsive" src="{{ asset('storage/' . $line->product->image_path) }}"/></td>
                <td class="text-center">{{$line->product->name}}</td>
                <td class="text-center">{{$line->qty}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="form-row">
            <button type="submit" class="btn btn-primary">{{__("general.save")}}</button>
        </div>
    </form>
@endsection
