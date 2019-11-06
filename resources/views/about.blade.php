@extends('layouts.main')

@section('content')
    <div class="main-template-about">
        <div class="section-gradient">
            <div class="map"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="wow fadeIn" data-wow-delay="0.0s">
                            <h1>Rendre le ballon sur glace accessible partout au Canada.
                            </h1>
                            <p class="lead"> Notre but est de rendre les meilleurs produits de ballon sur glace accessible à travers le pays, afin de permettre à tous les joueurs de profiter de l'équipement qui leurs plaît.
                                <br>
                                <br>
                                N'attendez plus, inscrivez-vous !
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="section do">
            <div class="blue-light"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="does-box">
                            <div class="panel-body">
                                <h2>Que faisons-nous ?</h2>
                                <p>Nous regroupons les plus grands fournisseurs de produits de ballon sur glace sous une même bannière et leur fournissons des outils
                                    pour qu'ils puissent afficher facilement leurs équipements à tous les joueurs.<br/>
                                    De plus, nous nous faisons un devoir de plaire à toutes les générations de balayeurs pour que tous puissent représenter notre sport avec un équipement digne de ce nom.
                                </p>
                            </div>
                            <img class="wow fadeIn" src="images/goal_light.png" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="seciton create">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <p>L'inscription n'est pas obligatoire pour consulter les produits disponible et leurs prix. Par contre, il est nécéssaire d'avoir un compte pour passer une commande.
                        </p>

                    </div>
                </div>
            </div>
        </div>
        <div class="section account-box">
            <div class="blue-dark"></div>
            <div class="light-blue-grad"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="blue-form">
                            <h2>Créer votre compte dès maintenant.</h2>
                            <form class="form-inline">
                                <input type="email" placeholder="Entrer votre adresse courriel" />
                                <button type="submit" class="btn btn-primary">Continuer</button>
                            </form>
                            <p>Gratuit - Aucune carte de crédit nécéssaire - Aucune obligation</p>
                            <div class="blue-form_question"><strong>Questions?</strong> Écrivez-vous info@XYZ.com</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="seciton create">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <p>PVEL est une Plateforme de Vente En Ligne qui s'adresse autant aux fournisseurs (vendeurs) qu'aux clients (acheteurs). L'idée derrière ce projet est de fournir  des outils simple pour permettre aux fournisseurs d'afficher
                            leurs produits sur un site web sans connaissance informatique. Cela est bénéfique pour le fournisseur, car il peut montrer et vendre ses produits, mais aussi pour le client, car tous les produits, de toutes les marques, sont centralisés au même endroit.
                            <img src="{{URL::asset('images/screenshot1.PNG')}}"/>
                            <small>Ajouter un produit en tant que fournisseur</small><br/>
                            <img src="{{URL::asset('images/screenshot2.PNG')}}"/>
                            <small>Consulter le produit, en tant que client</small><br/>
                            <img src="{{URL::asset('images/screenshot4.PNG')}}"/>
                            <small>Ajouter ce produit au panier, afin de le commander</small><br/>
                            <img src="{{URL::asset('images/screenshot3.PNG')}}"/>
                            <small>Suivre l'expédition d'une commande, grâce aux informations de repérage renseignés par le fournisseur</small><br/>
                        </p>

                    </div>
                </div>
            </div>
        </div>

        <div class="section-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <h2>N'hésitez plus</h2>
                        <p>Que vous soyez un joueur ou un fournisseur, il n'y a aucune raison de ne pas s'inscrire !</p>
                    </div>
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="row">
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.2s">
                                <div class="rectange">
                                    <h3 class="rectange_title">Acheteurs</h3>
                                    <p class="rectange_text">Rejoignez-nous pour parcourir les produits des plus grands fournisseurs de ballon sur glace !</p>
                                    <a href="" class="rectange_link">Je m'inscris</a>
                                </div>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.4s">
                                <div class="rectange">
                                    <h3 class="rectange_title">Fournisseurs</h3>
                                    <p class="rectange_text">Ne laissez pas passer l'opportunité de vendre aux joueurs de ballon sur glace à travers le Canada !</p>
                                    <a href="" class="rectange_link">Je m'inscris</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
