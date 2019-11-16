@extends('layouts.main')

@section('content')

    <div class="container-fluid">
        <h1>{{$title}}</h1>
        <div class="row">
            <div class="col-sm-3 product-menu">
                <ul>
                    <li class = "menu-link"><a href="#">Bâtons </a> <i class="glyphicon glyphicon-chevron-right right"></i>
                        <ul class="dropdown-content">
                            <h4>Fournisseurs</h4>
                            <li><a href ="#">One by One</a></li>
                            <li><a href="#">Blue Ox</a></li>
                            <li><a href="#">D-Gel</a></li>
                            <li><a href="#">Acacia</a></li>
                        </ul></li>
                    <li>Souliers<i class="glyphicon glyphicon-chevron-right right"></i></li>
                    <li>Ballons<i class="glyphicon glyphicon-chevron-right right"></i></li>
                    <li>Pièces détachées<i class="glyphicon glyphicon-chevron-right right"></i></li>
                </ul>
            </div>

            <div class="col-sm-9" >
                <div class = "container-fluid">
                    @foreach($products->chunk(3) as $rows)
                        <div class="row course-set courses__row">
                            @foreach($rows as $product)
                                <article class="col-md-4">

                                        <div class="panel-body-product" >
                                                <div><a href="{{route("customer.product", ['id'=>$product->id])}}"><img class="img-responsive img-product" src ="{{ asset('storage/' . $product->image_path) }}"/></a></div>
                                                <div>
                                                    <p>${{$product->price}}</p>
                                                    <a href="{{route("customer.product", ['id'=>$product->id])}}" class="custom-b btn-details">Voir les détails</a>
                                                </div>
                                        </div>

                                </article>
                            @endforeach
                        </div>
                    @endforeach
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
