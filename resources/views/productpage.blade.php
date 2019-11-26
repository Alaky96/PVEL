@extends('layouts.main')

@section('content')

    <script src="{{ URL::asset('js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ URL::asset('js/starrr.js') }}"></script>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('commentError'))
            <div class="alert alert-danger">
                {{session('commentError')}}
            </div>
        @endif
        @if(session('commentSuccess'))
            <div class="alert alert-success">
                {{session('commentSuccess')}}
            </div>
        @endif


        @if (session('error') || !empty($error))
            <div class="alert alert-danger">
                {{ empty(session('error')) ? $error : session('error') }}
            </div>
        @endif
        @if (session('success') ||!empty($success))
            <div class="alert alert-success">
                {{ empty(session('success')) ? $success : session('success') }}
            </div>
        @endif
    <div class="product-page-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="prod-page-title">
                        <h2>{{$product->name}}</h2>
                        <p>{{__("product.By")}} <span>{{$product->supplier->name}}</span></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-sm-4">
                    <div class="left-profile-box-m prod-page">
                        <div class="pro-img">
                            <img src="{{ URL::asset('images/blueox.jpg') }}" alt="#" />
                        </div>
                        <a href ="#" data-toggle="modal" data-target="#AskSupplierModal">Une question ? Posez-là au fournisseur !</a>
                    </div>
                </div>
                <div class="modal fade" id="AskSupplierModal" tabindex="-1" role="dialog" aria-labelledby="AskSupplierModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Posez une question à {{$product->supplier->name}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="askForm" method="post" action="{{route('askQuestion')}}">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="email">Courriel</label>
                                            <input  type="email" class="form-control" id="email" placeholder="Courriel" name="email" value="{{Auth()->user()->email ?? ''}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name">Votre Nom</label>
                                            <input  type="text" class="form-control" id="name" name="name" placeholder="Votre Nom" value="{{Auth()->user()->name ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="text">Votre Question</label>
                                        <textarea  type="text" class="form-control" id="text" name="text" placeholder="Votre question"></textarea>
                                    </div>

                                    <input type="hidden"value="{{$product->supplier->id}}" id="'supplierID" name="supplierID"/>

                                    <button class="custom-b">Envoyer</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-sm-8">
                    <div class="md-prod-page">
                        <div class="md-prod-page-in">
                            <div class="page-preview">
                                <div class="preview">
                                    <div class="preview-pic tab-content">
                                        <div class="tab-pane active" id="pic-1"><img src="{{ asset('storage/' . $product->image_path) }}" alt="#" /></div>
                                        <div class="tab-pane" id="pic-2"><img src="{{ asset('storage/' . $product->image_path) }}" alt="#" /></div>
                                        <div class="tab-pane" id="pic-3"><img src="{{ URL::asset('images/lag-60.png') }}" alt="#" /></div>
                                        <div class="tab-pane" id="pic-4"><img src="{{ URL::asset('images/lag-61.png') }}" alt="#" /></div>
                                    </div>
                                    <ul class="preview-thumbnail nav nav-tabs">
                                        <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="{{ asset('storage/' . $product->image_path) }}" alt="#" /></a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="description-box">
                            <div class="dex-a">
                                <h4>{{__("product.descr")}}</h4>
                                <p>{{$product->descr}}</p>
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
                    <div class = "comment-section">
                        <h3>Commentaires</h3>
                        <div id="rating" style="display:inline"></div> {{number_format($rating, 1, ',', '')}} étoiles sur 5
                        <div class="" >
                            @foreach($comments as $comment)
                            <div class="panel panel-default">
                                <div class="panel-heading" style="background-color:#09294c;color:white">{{date_format(date_create($comment->comment_date), "Y-n-d")}} <div id="rating{{$comment->id}}" style="display:inline"></div></div>
                                <div class="panel-body">{{$comment->user_text}}<br/><br/>
                                    <i>{{$comment->user->name}}</i>
                                    @admin
                                    <div style="text-align:right"><a href="{{route("comment.delete", ['id'=>$comment->id])}}" class="btn-danger">Supprimer le commentaire</a></div>
                                    @endadmin

                                </div>
                            </div>
                            @endforeach
                        </div>
                        {{$comments->links()}}

                        @guest
                            Connectez-vous pour laisser un commentaire
                        @else
                            <h3>Laisser un commentaire</h3>
                            @if(session('commentError'))
                                <div class="alert alert-danger">
                                   {{session('commentError')}}
                                </div>
                            @endif
                            <form method="post" action="{{route('comment.store')}}">
                                @csrf
                                <div class="form-group col-md-12">
                                    <label for="text">Qu'avez vous pensé de ce produit ?</label>
                                    <textarea  type="text" class="form-control" id="text" name="text" placeholder="Votre commentaire">{{session('oldComment')}}</textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Note</label>
                                    <div id = "commentRating"></div>
                                </div>

                                <input type="hidden"value="0" id="newRating" name="newRating"/>
                                <input type="hidden"value="{{$product->id}}" id="productID" name="productID"/>

                                <button class="custom-b">Envoyer</button>
                            </form>
                        @endguest
                    </div>

                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="price-box-right">
                        <h4>{{__("product.price")}}</h4>
                        <h3>${{$product->price}} <span></span></h3>
                        <h6>{{__("product.shippingprice")}} : ${{$product->shipping_price}}</h6>
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
                        <form method="post" action="{{route("cart.addItem")}}">
                            @csrf
                            <input type="hidden" name="productid" value="{{$product->id}}"/>
                            <button class="custom-b" href="#"  {{$product->out_of_stock ? 'disabled' : ''}}>Ajouter au panier</button>
                        </form>
                        <h5 class ="{{$product->out_of_stock ? 'notinstock' : ''}}"><i class="fa fa-clock-o " aria-hidden="true"></i> {{$product->out_of_stock ? __('product.noinstock') : __('product.instock')}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

            <script>
                $('#rating').starrr({
                    rating: {{$rating ?? 0}},
                    readOnly: true
                })

                $('#commentRating').starrr({
                })
                $('#commentRating').on('starrr:change', function(e, value){
                   $("#newRating").val(value);
                })

                @foreach($comments as $comment)
                $('#rating{{$comment->id}}').starrr({
                    rating: {{$comment->rating}},
                    readOnly: true
                })
                @endforeach
            </script>
@endsection
