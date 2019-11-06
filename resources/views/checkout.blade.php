@extends('layouts.main')

@section('content')

<style>
    /* setup tooltips */
    .tooltip1 {
        position: relative;
        background-color: #0a284c;
        color: #fff;
        padding: 2.5px 10px;
        border-radius: 50%;
        font-size: 20px;
        font-weight: bolder;
    }
    .tooltip1:before,
    .tooltip1:after {
        display: block;
        opacity: 0;
        pointer-events: none;
        position: absolute;
    }
    .tooltip1:after {
        border-right: 6px solid transparent;
        border-bottom: 6px solid rgba(0,0,0,.75);
        border-left: 6px solid transparent;
        content: '';
        height: 0;
        top: 20px;
        left: 20px;
        width: 0;
    }
    .tooltip1:before {
        background: rgba(0,0,0,.75);
        border-radius: 2px;
        color: #fff;
        content: attr(data-title);
        font-size: 14px;
        padding: 6px 10px;
        top: 26px;
        white-space: nowrap;
    }

    /* the animations */
    /* fade */
    .tooltip1.fade:after,
    .tooltip1.fade:before {
        transform: translate3d(0,-10px,0);
        transition: all .15s ease-in-out;
    }
    .tooltip1.fade:hover:after,
    .tooltip1.fade:hover:before {
        opacity: 1;
        z-index: 1;
        transform: translate3d(0,0,0);
    }

    /* expand */
    .tooltip1.expand:before {
        transform: scale3d(.2,.2,1);
        transition: all .2s ease-in-out;
    }
    .tooltip1.expand:after {
        transform: translate3d(0,6px,0);
        transition: all .1s ease-in-out;
    }
    .tooltip1.expand:hover:before,
    .tooltip1.expand:hover:after {
        opacity: 1;
        z-index: 1;
        transform: scale3d(1,1,1);
    }
    .tooltip1.expand:hover:after {
        transition: all .2s .1s ease-in-out;
    }

    /* swing */
    .tooltip1.swing:before,
    .tooltip1.swing:after {
        transform: translate3d(0,30px,0) rotate3d(0,0,1,60deg);
        transform-origin: 0 0;
        transition: transform .15s ease-in-out, opacity .2s;
    }
    .tooltip1.swing:after {
        transform: translate3d(0,60px,0);
        transition: transform .15s ease-in-out, opacity .2s;
    }
    .tooltip1.swing:hover:before,
    .tooltip1.swing:hover:after {
        opacity: 1;
        z-index: 1;
        transform: translate3d(0,0,0) rotate3d(1,1,1,0deg);
    }




</style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h2>Informations de Paiement</h2>

                    <div class="card-body">
                        <form method="POST" action="{{ route('chargecheckout') }}" id ="payment-form">
                            @csrf

                            <div class="form-group row">
                                <label for="firstname" class="col-md-4 col-form-label text-md-right">Prénom</label>

                                <div class="col-md-6">
                                    <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname"  required >

                                    @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lastname" class="col-md-4 col-form-label text-md-right">Nom de famille</label>

                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname"  required >

                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">Téléphone</label>

                                <div class="col-md-6">
                                    <input id="phone" type="tel" class="form-control phone @error('phone') is-invalid @enderror" name="phone"  required >

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="address1" class="col-md-4 col-form-label text-md-right">Addresse Ligne 1</label>

                                <div class="col-md-6">
                                    <input id="address1" type="text" class="form-control @error('address1') is-invalid @enderror" name="address1"  required autofocus>

                                    @error('address1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address2" class="col-md-4 col-form-label text-md-right">Addresse Ligne 2</label>

                                <div class="col-md-6">
                                    <input id="address2" type="text" class="form-control @error('address2') is-invalid @enderror" name="address2"  >

                                    @error('address2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="city" class="col-md-4 col-form-label text-md-right">Ville</label>

                                <div class="col-md-6">
                                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city"  required >

                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="postalcode" class="col-md-4 col-form-label text-md-right">Code Postale</label>

                                <div class="col-md-6">
                                    <input id="postalcode" type="text" class="form-control @error('postalcode') is-invalid @enderror" name="postalcode"  required >

                                    @error('postalcode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="prov" class="col-md-4 col-form-label text-md-right">Province</label>

                                <div class="col-md-6">
                                    <input id="prov" type="text" class="form-control @error('prov') is-invalid @enderror" name="prov"  required >

                                    @error('prov')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="country" class="col-md-4 col-form-label text-md-right">Pays</label>

                                <div class="col-md-6">
                                    <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country"  required >

                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row">
                                <label  class="col-md-4 col-form-label text-md-right">Carte de Crédit</label>

                                <div class="col-md-6">


                                    <label for="card-element">Card</label>
                                    <div id="card-element" style = " border: 1px solid #ccc; border-radius: 4px; padding: 6px 12px;font-size: 14px;">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>

                                    <span class="tooltip1 swing" data-title="Les informations de paiement sont traités de façon sécurisée.">?</span>


                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert" style="color:#fa755a"></div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Continuer
                                    </button>
                                </div>
                                <small id="emailHelp" class="form-text text-muted">Votre carte ne sera pas chargée avant la confirmation.</small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Create a Stripe client.
        var stripe = Stripe('pk_test_J9zR4p4BWaEmdHIxMUHGzGSf0018V414fQ');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        var myPostalCodeField = document.querySelector('input[name="postalcode"]');
        myPostalCodeField.addEventListener('change', function(event) {
            card.update({value: {postalCode: event.target.value}});
        });

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>
@endsection
