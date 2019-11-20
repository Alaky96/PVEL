@extends('layouts.main')

@section('content')
    <style>
        /* The container */
        .checkbox {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            font-weight: normal;
        }

        /* Hide the browser's default checkbox */
        .checkbox input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            margin: 2px;
            top: 0;
            left: 0;
            height: 15px;
            width: 15px;
            background-color: #919191;
        }

        /* On mouse-over, add a grey background color */
        .checkbox:hover input ~ .checkmark {
            background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .checkbox input:checked ~ .checkmark {
            background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .checkbox input:checked ~ .checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .checkbox .checkmark:after {
            left: 5px;
            top: 5px;
            width: 5px;
            height: 5px;
            border: solid white;
            border-width: 0 1px 1px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }
    </style>
    <div class="container-fluid">
        <h1>{{$title}}</h1>
        <div class="row">
            <div class="col-sm-3 product-menu">
                <div>
                    <h2>Marques</h2>
                    @foreach($suppliers as $supplier)
                        <div class="custom-sq">
                            <label class="checkbox">
                                {{$supplier->name}}
                                <input class ="checkbox" type="checkbox" name="supplier[]" data-type="supplier" value="{{$supplier->id}}" >
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    @endforeach
                </div>

                <div>
                    <h2>Catégories</h2>
                    @foreach($categories as $category)
                        <div class="custom-sq">
                            <label class="checkbox">
                                {{__("categories.".$category->name)}}
                                <input class ="checkbox" type="checkbox" @if($selectedCategory == $category->id) checked @endif name="supplier[]" data-type="categorie" value="{{$category->id}}" >
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    @endforeach
                </div>

            </div>
            <div class = "loader" style="text-align: center;display: none"><img src="{{URL::asset("images/ajax-loader.gif")}}"/></div>
            <div class="col-sm-9" >
                <div class = "container-fluid displayerProduct">
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
    <script src="{{ URL::asset('js/jquery-1.12.4.min.js') }}"></script>
    <script>
        $(document).ready(function () {

            var suppliers = [];
            var categories = [];

            // Listen for 'change' event, so this triggers when the user clicks on the checkboxes labels
            $('input[name="supplier[]"]').on('change', function (e) {

                e.preventDefault();
                suppliers = []; // reset
                categories = [];

                $('input[name="supplier[]"]:checked').each(function()
                {
                    if($(this).data("type") == "supplier")
                        suppliers.push($(this).val());
                    else if($(this).data("type") == "categorie")
                        categories.push($(this).val());
                });
                $(".loader").show();
                $(".displayerProduct").hide();
                $.post('/customer/products/ajax/getProducts', { "_token": "{{ csrf_token() }}", "width": $(".panel-body-product").first().width(), suppliers: suppliers, categories:categories}, function(markup)
                {
                    $('.displayerProduct').html(markup);
                    $(".loader").hide();
                    $(".displayerProduct").show();
                });

            });

        });
    </script>
@endsection
