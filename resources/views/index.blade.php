@extends('layouts.main')
@section('content')
<div class="page-content-product">
    <div class="main-product">
        <div class="container">
            <div class="row clearfix">
                <div class="find-box">
                    <h1>Trouver des articles de ballon sur glace</h1>
                    <h4>n'a jamais été aussi facile au Canada</h4>
                    <div class="product-sh">
                        <div class="col-sm-6">
                            <div class="form-sh">
                                <input type="text" placeholder="Commencer par une recherche" >
                            </div>
                        </div>
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-3">
                            <div class="form-sh"> <a class="btn" href="#">Rechercher</a> </div>
                        </div>
                        <p>Ou <a href="{{route("customer.products") }}"> cliquez ici </a> pour voir tous les produits</p>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-3 col-sm-6 col-md-3">
                    <a href="{{route('customer.products', ['category'=>2])}}">
                        <div class="box-img">
                            <h4>Souliers</h4>
                            <img src="images/product/bullet.png" alt="" />
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-3">
                    <a href="{{route('customer.products', ['category'=>1])}}">
                        <div class="box-img">
                            <h4>Bâtons</h4>
                            <img src="images/product/cannon.png" alt="" />
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-3">
                    <a href="{{route('customer.products', ['category'=>3])}}">
                        <div class="box-img">
                            <h4>Ballons</h4>
                            <img src="images/product/b2.png" alt="" />
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-3">
                    <a href="{{url("customer/products/4")}}">
                        <div class="box-img">
                            <h4>Pièces Détachées</h4>
                            <img src="images/product/shafts.png" alt="" />
                        </div>
                    </a>
                </div>


                <div class="categories_link">
                    <a href="#">Voir tous les produits</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="cat-main-box">
    <div class="container">
        <div class="row panel-row">
            <div class="col-md-4 col-sm-6 wow fadeIn" data-wow-delay="0.0s">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="images/xpann-icon.jpg" class="icon-small" alt="">
                        <h4>Tous les produits au même endroit</h4>
                        <p>XYZ regroupe les plus grands fournisseurs de ballon sur glace au même endroit.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 wow fadeIn" data-wow-delay="0.2s">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="images/create-icon.jpg" class="icon-small" alt="">
                        <h4>Comparer afin de mieux choisir</h4>
                        <p>XYZ vous offres des outils pour comparer les produits afin de choisir ce qui vous convient le mieux.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 wow fadeIn hidden-sm" data-wow-delay="0.4s">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="images/get-icon.jpg" class="icon-small" alt="">
                        <h4>Découvrir les dernières innovations</h4>
                        <p>Le ballon sur glace est un sport en constante évolution. Découvrez les produits de derniers cris.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="products_exciting_box">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 wow fadeIn" data-wow-delay="0.2s">
                <div class="exciting_box f_pd">
                    <img src="images/exciting_img-01.jpg" class="icon-small" alt="" />
                    <h4><strong>Acheteurs : </strong> Découvrez toute notre gamme de produits.
                    </h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris..
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 wow fadeIn" data-wow-delay="0.4s">
                <div class="exciting_box l_pd">
                    <img src="images/exciting_img-02.jpg" class="icon-small" alt="" />
                    <h4><strong>Fournisseurs : </strong> Exposez vos produits à la communauté de ballon sur glace.</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris..
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection
