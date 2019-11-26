
    @foreach($products as $product)
        <a href="{{route("customer.product", ['id'=>$product->id])}}"> <div><img style="max-width:50%" src = "{{ asset('storage/' . $product->image_path) }}"/> {{$product->name}}</div></a>
    @endforeach
