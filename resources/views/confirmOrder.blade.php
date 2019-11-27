@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h2>Vous êtes à un clique de finaliser votre commande...</h2>

                    <div class="card-body">
                        <form method="POST" action="{{ route('chargecheckout') }}" id="payment-form">
                            @csrf
                            <div class="form-group row">
                                <label for="firstname" class="col-md-4 col-form-label text-md-right">Prénom</label>

                                <div class="col-md-6">
                                    <input id="firstname" type="text" class="form-control" value="{{$po->first_name}}"
                                           disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lastname" class="col-md-4 col-form-label text-md-right">Nom de
                                    famille</label>

                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control" value="{{$po->last_name}}"
                                           disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">Téléphone</label>

                                <div class="col-md-6">
                                    <input id="phone" type="tel" class="form-control phone" value="{{$po->phone}}"
                                           name="phone" disabled>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="address1" class="col-md-4 col-form-label text-md-right">Addresse Ligne
                                    1</label>

                                <div class="col-md-6">
                                    <input id="address1" type="text" class="form-control " name="address1"
                                           value="{{$po->adresse_line_1	}}" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address2" class="col-md-4 col-form-label text-md-right">Addresse Ligne
                                    2</label>

                                <div class="col-md-6">
                                    <input id="address2" type="text" class="form-control"
                                           value="{{$po->adresse_line_2}}" name="address2" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="city" class="col-md-4 col-form-label text-md-right">Ville</label>

                                <div class="col-md-6">
                                    <input id="city" type="text" class="form-control" value="{{$po->city}}" name="city"
                                           disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="postalcode" class="col-md-4 col-form-label text-md-right">Code
                                    Postale</label>

                                <div class="col-md-6">
                                    <input id="postalcode" type="text" class="form-control" value="{{$po->postal_code}}"
                                           name="postalcode" disabled>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="prov" class="col-md-4 col-form-label text-md-right">Province</label>

                                <div class="col-md-6">
                                    <input id="prov" type="text" class="form-control" value='{{$po->prov}}' name="prov"
                                           disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="country" class="col-md-4 col-form-label text-md-right">Pays</label>

                                <div class="col-md-6">
                                    <input id="country" type="text" class="form-control" value="{{$po->country}}"
                                           name="country" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="totalamount" class="col-md-4 col-form-label text-md-right">Total</label>

                                <div class="col-md-6">
                                    <input id="totalamount" type="text" class="form-control" value="${{number_format($po->total, 2)}}"
                                           name="totalamount" disabled>
                                </div>
                                <small id="emailHelp" class="form-text text-muted">Montant qui sera chargé sur votre
                                    carte.</small>
                            </div>
                        </form>
                        <a href="{{route("confirm", ['po'=>$po->id, 'ans'=>1, 'id'=>$id, 'method'=>$method, 'paymentId'=> Request::get('paymentId'),'token'=> Request::get('token'), 'PayerID'=> Request::get('PayerID')])}}">
                            <button class="btn btn-primary">{{__("general.confirm")}}</button>
                        </a> <a href="{{route("confirm", ['po'=>$po->id, 'ans'=>0, 'id'=>$id, 'method'=>$method])}}">
                            <button class="btn btn-danger">{{__("general.cancel")}}</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
