
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shop Broomball</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--enable mobile device-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--fontawesome css-->
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}">
    <!--bootstrap css-->
    <link rel="stylesheet" href=" {{ URL::asset('css/bootstrap.min.css') }}">
    <!--animate css-->
    <link rel="stylesheet" href=" {{ URL::asset('css/animate-wow.css') }}">
    <!--main css-->
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/slick.min.css') }}">
    <!--responsive css-->
    <link rel="stylesheet" href="{{ URL::asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/starrr.css') }}">
</head>
<script src="https://js.stripe.com/v3/"></script>
<body>
<header id="header" class="top-head">
    <!-- Static navbar -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-12 left-rs">
                    <div class="navbar-header">
                        <button type="button" id="top-menu" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
                            <span class="sr-only">{{__("general.showmenu")}}</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="{{route("home")}}" class="navbar-brand"><img src="{{ URL::asset('images/logo.png') }}" alt="" /></a>
                    </div>
                    <form class="navbar-form navbar-left web-sh">
                        <div class="form autocomplete">
                            <input type="text" class="form-control mainsearch" id="{{time()}}" placeholder="{{__("general.search products")}}">
                            <div class="autocomplete-items"></div>
                        </div>
                    </form>
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="right-nav">
                        <div class="login-sr">
                            <div class="login-signup">
                                <ul>
                                    @guest
                                        <li><a href ="{{route("login")}}">{{__("general.signin")}}</a></li>
                                        <li><a class="custom-b" href="{{route("register")}}">{{__("general.signup")}}</a></li>
                                    @else
                                        <li><div class="dropdown">
                                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="profileMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{ Auth::user()->name }} <span class="glyphicon glyphicon-chevron-down"></span>
                                                </a>

                                                <div class="dropdown-menu" aria-labelledby="profileMenu">
                                                    <a class="dropdown-item" href="{{route("profile")}}">{{__("profile.Profile")}}</a>
                                                    <a class="dropdown-item" href="{{route("customerOrder.index")}}">{{__("general.myorders")}}</a>
                                                    <a class="dropdown-item" href="{{ url('/logout') }}">{{__("general.signout")}}</a>
                                                </div>
                                            </div></li>
                                        <li><a href="{{route("cart.show")}}"> {{__("general.cart")}} </a></li>
                                    @endguest

                                </ul>
                            </div>
                        </div>
                        <div class="help-r hidden-xs">
                            <div class="help-box">
                                <ul>
                                    <li> <a data-toggle="modal" data-target="#myModal" href="#"> <img src="{{URL::asset('images/') . '/flag' . Config::get('app.locale') . '.png'}}" alt="" /> </a> </li>
                                    <li> <a href="{{route("support")}}"><img class="h-i" src="{{URL::asset('images/help-icon.png')}} " alt="" /> Support </a> </li>
                                </ul>
                            </div>
                        </div>
                        <div class="nav-b hidden-xs">
                            <div class="nav-box">
                                <ul>
                                    <li><a href="howitworks.html">{{__("general.howitworks")}}</a></li>
                                    @supplier
                                        <li><div class="dropdown">
                                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="profileMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{__("general.suppliers")}} <span class="glyphicon glyphicon-chevron-down"></span>
                                                </a>

                                                <div class="dropdown-menu" aria-labelledby="profileMenu">
                                                    <a class="dropdown-item dropd-item" href="{{route("product.index")}}">{{__("general.myproducts")}}</a>
                                                    <a class="dropdown-item dropd-item" href="{{route("shipments.index")}}">{{__("general.myshipments")}}</a>
                                                </div>
                                            </div></li>
                                    @endsupplier
                                    @admin
                                    <li><div class="dropdown">
                                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="adminMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Admin <span class="glyphicon glyphicon-chevron-down"></span>
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="adminMenu">
                                                <a class="dropdown-item dropd-item" href="{{route("admin.users")}}">{{__("general.users")}}</a>
                                                <a class="dropdown-item dropd-item" href="{{route("admin.products")}}">{{__("general.products")}}</a>
                                            </div>
                                        </div></li>
                                    @endadmin

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.container-fluid -->
    </nav>
</header>
<!-- Modal -->
<div class="modal fade lug" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change</h4>
            </div>
            <div class="modal-body">
                <ul>
                    <li><a href="{{ url("/locale/en")}}"><img src="{{ URL::asset('images/flag-up-1.png') }}" alt="" /> English</a></li>
                    <li><a href="{{ url("/locale/fr")}}"><img src="{{ URL::asset('images/flag-up-2.png') }}" alt="" /> Français </a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="sidebar" class="top-nav">
    <ul id="sidebar-nav" class="sidebar-nav">
        <li><a href="#">{{__("general.howitworks")}}</a></li>
        @supplier
        <li><a href="{{route("product.index")}}">{{__("general.myproducts")}}</a></li>
        <li><a href="{{route("shipments.index")}}">{{__("general.myshipments")}}</a></li>
        @endsupplier
        @admin
        <li><a href="{{route("admin.users")}}">{{__("general.users")}}</a></li>
        <li><a href="{{route("admin.products")}}">{{__("general.products")}}</a></li>
        @endadmin
        <li><a href="#">Support</a></li>
    </ul>
</div>

@section('content')

@show

<footer>
    <div class="main-footer">
        <div class="container">
            <div class="row">
                <div class="footer-top clearfix">
                    <div class="col-md-2 col-sm-6">
                        <h2>{{__("general.signupslogan")}}
                        </h2>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-box">
                            <input type="text" placeholder="{{__("general.enteremail")}}" />
                            <button>{{__("general.signup")}}</button>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="help-box-f">
                            <h4>{{__("general.questionslogan")}}</h4>
                        </div>
                    </div>
                </div>
                <div class="footer-link-box clearfix">
                    <div class="col-md-6 col-sm-6">
                        <div class="left-f-box">
                            <div class="col-sm-4">
                                <h2> {{__("general.suppliers")}}</h2>
                                <ul>
                                    <li><a href="#">{{__("general.accountrequest")}}</a></li>
                                    <li><a href="howitworks.html">{{__("general.howitworks")}}</a></li>
                                    <li><a href="pricing.html">{{__("general.pricing")}}</a></li>
                                    <li><a href="#">FAQ</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <h2>{{__("general.buyers")}}</h2>
                                <ul>
                                    <li><a href="#">{{__("general.signup")}}</a></li>
                                    <li><a href="#">{{__("general.howitworks")}}</a></li>
                                    <li><a href="#">FAQ</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <h2>Shopbroomball</h2>
                                <ul>
                                    <li><a href="about-us.html">{{__("general.aboutshopbroomball")}}</a></li>
                                    <li><a href="#">{{__("general.contactus")}}</a></li>
                                    <li><a href="#">{{__("general.termsofuse")}}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <p><img width="90" src="{{url::asset("images/logo.png")}}" alt="logo" style="margin-top: -5px;" /> {{__("general.allrightsreserved")}} Shopbroomball.ca © 2019</p>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline socials">
                        <li>
                            <a href="">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-linkedin" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="right-flag">
                        <li><a href="#"><img src="{{URL::asset('images/') . '/flag' . Config::get('app.locale') . '.png'}}" alt="" /></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--main js-->

<script src="{{ URL::asset('js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery.mask.min.js') }}"></script>
<!--bootstrap js-->
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap-select.min.js') }}"></script>
<script src="{{ URL::asset('js/slick.min.js') }}"></script>
<script src="{{ URL::asset('js/wow.min.js') }}"></script>
<!--custom js-->
<script src="{{ URL::asset('js/custom.js') }}"></script>

<script>
    $('.mainsearch').on('input',function(e){
        if($(this).val().trim().length !== 0)
        {
            $.post('/ajax/getSearchResult', { "_token": "{{ csrf_token() }}", q: $(this).val()}, function(markup)
            {
                $('.autocomplete-items').html(markup);
                $(".autocomplete-items").show();
            });
        }
        else
        {
            $(".autocomplete-items").hide();
        }
    });
</script>

<script>
    $(document).ready(function(){
        $('.phone').mask('(000) 000-0000');
    });
</script>
</body>
</html>
