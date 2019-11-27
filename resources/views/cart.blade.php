@extends('layouts.main')

@section('content')

    <div class="card-body">
        <div class="product-page-main">
            @if (isset($sucess))
                <div class="alert alert-success">
                    {{ $sucess }}
                </div>
            @endif

                @if (isset($failed))
                    <div class="alert alert-danger">
                        {{ $failed }}
                    </div>
                @endif

            <h2>{{__("cart.yourcart")}}</h2>
            @if(($carts->count() > 0 ))

                @foreach($carts as $cart)
                    <div class="container cartitem">
                        <div class="row justify-content-md-center ">
                            <div class="col col-sm-2">
                                <div><img src="{{ asset('storage/' . $cart->product->image_path) }}" alt="#" /></div>
                            </div>
                            <div class="col col-sm-4">
                                <p>
                                    {{$cart->product->name}}<br/>
                                    Size 10<br/><br/>
                                    SKU : 1234567788<br/>
                                    In Stock : {{$cart->product->out_of_stock ? __("general.no" ): __("general.yes" )}}<br/><br/>

                                    By : {{$cart->product->supplier->name}}
                                </p>
                            </div>
                            <div class="col col-sm-2">
                                <p>Quantity : <input type ="number" value="{{$cart->qty}}"/></p>
                            </div>
                            <div class="col col-sm-2">
                                <p>${{$cart->product->price}}</p>
                            </div>
                            <div class="col col-sm-2">
                                <a href="{{URL("/cart/delete") .'/'. $cart->id}}" class ="btn-danger">Delete</a>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="cartitem-box">Item Total : ${{number_format($cart->product->price * $cart->qty, 2)}}</div>
                        </div>
                    </div>
                @endforeach
                <div class="container cartitem checkout-box">
                    <div class="row justify-content-md-center ">
                        <div class="col col-sm-6">
                            <table>
                                <tr>
                                    <td>Sous-Total : </td>
                                    <td>${{$subtotal}}</td>
                                </tr>
                                <tr>
                                    <td>Livraison : </td>
                                    <td>${{$shipping}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Total : </strong></td>
                                    <td><strong>${{$subtotal + $shipping}}</strong></td>
                                </tr>
                            </table>

                        </div>
                        <div class="col col-sm-6">
                            <div style="text-align:right"><a href ="{{URL("/cart/payment?amount=5")}}"><img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-large.png" alt="Check out with PayPal" /></a> ou  <a href ="{{route("checkout")}}"><button class = "btn-checkout">Passer à la caisse</button></a></div></div>
                    </div>
                </div>
        </div>
        @else
            <h3 style = "text-align: center">Votre panier est vide pour l'instant</h3>
        @endif


        </div>
    </div>
@endsection
