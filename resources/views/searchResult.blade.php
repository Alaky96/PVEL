
    @foreach($products as $product)
    <div><img style="max-width:50%" src = "{{ asset('storage/' . $product->image_path) }}"/> {{$product->name}}</div>
    @endforeach
