@extends('layouts.main')

@section('content')
    <div class="product-page-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="prod-page-title">
                        <h2>Manche C405</h2>
                        <p>By <span>Blue Ox</span></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-sm-4">
                    <div class="left-profile-box-m prod-page">
                        <div class="pro-img">
                            <img src="{{ URL::asset('images/blueox.jpg') }}" alt="#" />
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-sm-8">
                    <div class="md-prod-page">
                        <div class="md-prod-page-in">
                            <div class="page-preview">
                                <div class="preview">
                                    <div class="preview-pic tab-content">
                                        <div class="tab-pane active" id="pic-1"><img src="{{ URL::asset('images/product/shafts.png') }}" alt="#" /></div>
                                        <div class="tab-pane" id="pic-2"><img src="{{ URL::asset('images/lag-61.png') }}" alt="#" /></div>
                                        <div class="tab-pane" id="pic-3"><img src="{{ URL::asset('images/lag-60.png') }}" alt="#" /></div>
                                        <div class="tab-pane" id="pic-4"><img src="{{ URL::asset('images/lag-61.png') }}" alt="#" /></div>
                                    </div>
                                    <ul class="preview-thumbnail nav nav-tabs">
                                        <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="{{ URL::asset('images/product/shafts.png') }}" alt="#" /></a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="description-box">
                            <div class="dex-a">
                                <h4>Description</h4>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                    when an unknown printer took a galley of type and scrambled it to make a
                                    type specimen book..
                                </p>
                                <br>
                                <p>Small: H 25 cm / &Oslash; 12 cm</p>
                                <p>Large H 24 cm / &Oslash; 25 cm</p>
                            </div>
                            <div class="spe-a">
                                <h4>Specifications</h4>
                                <ul>
                                    <li class="clearfix">
                                        <div class="col-md-4">
                                            <h5>Measurments</h5>
                                        </div>
                                        <div class="col-md-8">
                                            <p>H25 cm / 0 12 cm and H 24 cm / 0 25 cm</p>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="col-md-4">
                                            <h5>Material</h5>
                                        </div>
                                        <div class="col-md-8">
                                            <p>Material Name</p>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="col-md-4">
                                            <h5>Wire</h5>
                                        </div>
                                        <div class="col-md-8">
                                            <p>Wire Name</p>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="col-md-4">
                                            <h5>Comdition</h5>
                                        </div>
                                        <div class="col-md-8">
                                            <p>Brand new</p>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="col-md-4">
                                            <h5>SKU number</h5>
                                        </div>
                                        <div class="col-md-8">
                                            <p>SKU number</p>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="col-md-4">
                                            <h5>Shipping</h5>
                                        </div>
                                        <div class="col-md-8">
                                            <p>Shipping worldwide</p>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="col-md-4">
                                            <h5>Warranty</h5>
                                        </div>
                                        <div class="col-md-8">
                                            <p>1 years</p>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="col-md-4">
                                            <h5>Delivery</h5>
                                        </div>
                                        <div class="col-md-8">
                                            <p>Choose country</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="price-box-right">
                        <h4>Price</h4>
                        <h3>$120 <span></span></h3>
                        <p>Couleurs</p>
                        <select class="form-control select2">
                            <option>Or</option>
                            <option value="BK">Noir</option>
                        </select>
                        <p>Longueur</p>
                        <select class="form-control select2">
                            <option>46"</option>
                            <option value="">52"</option>
                        </select>
                        <a href="#">Ajouter au panier</a>
                        <h5><i class="fa fa-clock-o" aria-hidden="true"></i> Le fournisseur signal que cet item est <strong>disponible</strong>.</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
