<div class = "container-fluid displayerProduct">
    @foreach($products->chunk(3) as $rows)
        <div class="row course-set courses__row">
            @foreach($rows as $product)
                <article class="col-md-4">

                        <div class="panel-body-product" style="width:{{$width}}">
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


