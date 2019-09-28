@extends('layouts.main')

@section('content')
    <div class="modal fade lug" id="modalDelete" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{__("product.delete product")}}</h4>
                </div>
                <div class="modal-body">
                   <p>
                       {{__("product.confirm delete")}} <br/><br/>
                       <button class="btn btn-danger">{{__("product.delete")}}</button>
                   </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h2>{{ __('product.Add Product') }}</h2>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ __('product.error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form method="POST"
                              action="{{ isset($product) ? url("supplier/product/".$product->id)   : route('product.store') }}"
                              enctype="multipart/form-data">
                            @if(isset($product))
                                @method("PUT");
                            @endif
                            @csrf

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('product.name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control is-invalid " name="name"
                                           value="{{ empty(old('name')) ? $product->name ?? '' : old('name') }}">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="descr"
                                       class="col-md-4 col-form-label text-md-right">{{ __('product.descr') }}</label>

                                <div class="col-md-6">
                                    <textarea id="descr" rows="10" class="form-control"
                                              name="descr">{{ empty(old('descr')) ? $product->descr ?? '' : old('descr') }} </textarea>

                                    @error('descr')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="price"
                                       class="col-md-4 col-form-label text-md-right">{{ __('product.price') }}</label>

                                <div class="col-md-6">
                                    <input id="price" type="number" class="form-control" name="price"
                                           value="{{ empty(old('price')) ? $product->price ?? '' : old('price') }}"/>
                                    @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="shippingprice"
                                       class="col-md-4 col-form-label text-md-right">{{ __('product.shippingprice') }}</label>

                                <div class="col-md-6">
                                    <input id="shippingprice" type="number" class="form-control" name="shippingprice"
                                           value="{{ empty(old('shippingprice')) ? $product->shipping_price ?? '' : old('shippingprice') }}"/>
                                    @error('shippingprice')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image"
                                       class="col-md-4 col-form-label text-md-right">{{ __('product.image') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control" name="image"/>
                                    @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <img id = "imagepreview" src="{{ (empty($product->image_path)) ? asset('images/noimage.png') :  asset('storage/'.$product->image_path)}}" class="img-fluid" alt="Responsive image"/>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('product.save') }}
                                    </button>
                                    @if(isset($product))
                                    <a data-toggle="modal" data-target="#modalDelete" class="btn btn-danger">
                                        {{ __('product.delete') }}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
