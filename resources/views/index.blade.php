@extends('layouts.main')
@section('content')
<div class="page-content-product">
    <div class="main-product">
        <div class="container">
            <div class="row clearfix">
                <div class="find-box">
                    <h1>{{__("index.findproducts")}}</h1>
                    <h4>{{__("index.neverbeeneasier")}}</h4>
                    <div class="product-sh">

                        <p><a href="{{route("customer.products") }}">{{__("index.orclickhere")}}</a></p>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-3 col-sm-6 col-md-3">
                    <a href="{{route('customer.products', ['category'=>2])}}">
                        <div class="box-img">
                            <h4>{{__("categories.Souliers")}}</h4>
                            <img src="images/product/bullet.png" alt="" />
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-3">
                    <a href="{{route('customer.products', ['category'=>1])}}">
                        <div class="box-img">
                            <h4>{{__("categories.Bâtons")}}</h4>
                            <img src="images/product/cannon.png" alt="" />
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-3">
                    <a href="{{route('customer.products', ['category'=>3])}}">
                        <div class="box-img">
                            <h4>{{__("categories.Ballons")}}</h4>
                            <img src="images/product/b2.png" alt="" />
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-3">
                    <a href="{{url("customer/products/4")}}">
                        <div class="box-img">
                            <h4>{{__("categories.Manches")}}</h4>
                            <img src="images/product/shafts.png" alt="" />
                        </div>
                    </a>
                </div>


                <div class="categories_link">
                    <a href="{{route("customer.products") }}">{{__("index.seeallproducts")}}</a>
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
                        <h4>{{__("index.allproductslogan")}}</h4>
                        <p> {{__("index.allproductdescr")}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 wow fadeIn" data-wow-delay="0.2s">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="images/create-icon.jpg" class="icon-small" alt="">
                        <h4>{{__("index.compareslogan")}}</h4>
                        <p>{{__("index.comparedescr")}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 wow fadeIn hidden-sm" data-wow-delay="0.4s">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="images/get-icon.jpg" class="icon-small" alt="">
                        <h4>{{__("index.innovationslogan")}}</h4>
                        <p>{{__("index.innovationdescr")}}
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
                    <h4><strong>{{__("general.buyers")}} : </strong> {{__("index.buyersslogan")}}
                    </h4>
                    <p>{{__("index.buyersdescr")}}
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 wow fadeIn" data-wow-delay="0.4s">
                <div class="exciting_box l_pd">
                    <img src="images/exciting_img-02.jpg" class="icon-small" alt="" />
                    <h4><strong>{{__("general.suppliers")}} : </strong> {{__("index.suppliersslogan")}}</h4>
                    <p>{{__("index.suppliersdescr")}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection
