@extends('layouts.main')

@section('content')
    <style>
        h1, h2
        {
            text-align: center;
            margin: 10px;
        }

        .box-container
        {

        }

        .box
        {
            text-align: center;
            margin:10px;
            padding:10px;
            border: 1px #e8e8e8 solid;
            border-radius: 5px;
            box-shadow: 5px 10px 8px #888888;
            height: 50vh;
        }
    </style>
   <h1>Que pouvons-nous faire pour vous aidez ?</h1>

    <div class="container-fluid">
       <p>Toutes notre équipe est à votre disposition pour répondre à vos demandes.</p>
        <div class="row">
            <div class="col-sm-4 box-container">
                <div class = "box">
                    <div style="text-align:center"><img src = "{{URL::asset("/images/works-icon-02.png")}}"/></div>
                    <h2>F.A.Q.</h2>
                    <p>
                        Consultez la F.A.Q. pour obtenir réponse à vos questions les plus fréquentes
                    </p>
                </div>
            </div>
            <div class="col-sm-4 box-container">
                <div class = "box">
                    <div style="text-align:center"><img src = "{{URL::asset("/images/exciting_img-02.jpg")}}"/></div>
                    <h2>Contactez un fournisseur</h2>
                    <p>Une question sur un produit ou sur la progression de votre commande ? Posez-là directement au fournisseur !</p>
                </div>
            </div>
            <div class="col-sm-4 box-container">
                <div class = "box">
                    <div style="text-align:center"><img src = "{{URL::asset("/images/exciting_img-01.jpg")}}"/></div>
                    <h2>Contactez-nous</h2>
                    <p>Nous restons à votre dispostion pour toutes questions générales ou pour résoudre tous problèmes liés à votre commande.
                       <br/> Envoyez-nouvs un courriel à support@shopbroomball.ca, nous vous répondrons dans les plus brefs délais.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
