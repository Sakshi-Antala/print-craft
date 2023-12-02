<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vistaprint</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
          rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('public/Assets')}}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/Assets')}}/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/Assets')}}/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/Assets')}}/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/Assets')}}/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/Assets')}}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/Assets')}}/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/Assets')}}/css/style.css" type="text/css">
</head>

<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__close">+</div>
    <ul class="offcanvas__widget">
        <li><span class="icon_search search-switch"></span></li>
        <li><a href="#"><span class="icon_heart_alt"></span>
                <div class="tip">2</div>
            </a></li>
        <li><a href="#"><span class="icon_bag_alt"></span>
                <div class="tip">2</div>
            </a></li>
    </ul>
    <div class="offcanvas__logo">
        <a href="{{url('/')}}"><img src="{{asset('public/Assets')}}/img/logo.png" alt=""></a>
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__auth">
        <a href="#">Login</a>
        <a href="#">Register</a>
    </div>
</div>
<!-- Offcanvas Menu End -->

<!-- Header Section Begin -->
<header class="header noprint">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-2">
                <div class="header__logo">
                    <a href="{{url('/')}}"><img src="{{asset('public/Assets')}}/img/demo5.png" alt=""></a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-7">
                <nav class="header__menu">
                    <ul style="text-align: center">
                        <li class="active"><a href="{{url('/')}}">Home</a></li>
                        <li><a href="{{url('/shop')}}">Shop</a></li>
                        <li><a href="#">Categories</a>
                            <ul class="dropdown">
                                @php
                                    $cate=\DB::table('categories')->get();
                                @endphp
                                @foreach($cate as $value)
                                    <li><a href="{{url('categoryproduct')}}\{{$value->cat_id}}">{{$value->cname}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        {{--<li><a href="#">Women’s</a></li>--}}
                        {{--<li><a href="#">Men’s</a></li>--}}
                        <li><a href="{{url('contact')}}">Contact</a></li>
                        @php
                            $getuid=\DB::table('user')->where('uid',session()->get('user.uid'))->first();
                        @endphp
                        @if(session()->has('user') && $getuid->status==1)
                            <li><a href="{{url('joinasagency')}}">Join As Agency</a></li>
                        @endif
                        {{--@if(session()->has('user') && session()->get('user.status')==2)--}}
                            {{--<li><a href="#">You Are Agency</a></li>--}}
                        {{--@endif--}}
                        @if(session()->has('user'))
                        <li><a href="#">Profile</a>
                            <ul class="dropdown">
                                <li><a href="{{url('profile')}}">My Profile</a></li>
                                <li><a href="{{url('changepassword')}}">Change Password</a></li>
                                <li><a href="{{url('myorder')}}">My Order</a></li>
                                <li><a href="{{url('logout')}}">Logout</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__right">
                    <div class="header__right__auth">
                        @if(session()->has('user'))
                            Welcome {{$getuid->name}}!
                        @else
                            <a href="{{url('login')}}">Login</a>
                            <a href="{{url('registration')}}">Register</a>
                        @endif
                    </div>
                    <ul class="header__right__widget">
                        <li><span class="icon_search search-switch"></span></li>
                        <li><a href="{{url('displaywishlist')}}"><span class="icon_heart_alt"></span>
                                @php
                                    if (session()->has('user')){
                                    $uid=session()->get('user.uid');
                                    }else{
                                    $uid=0;
                                    }
                                    $wishlist=\DB::table('wishlists')->where('uid',$uid)->get();
                                @endphp
                                <div class="tip">{{(isset($wishlist)?count($wishlist):"0")}}</div>
                            </a></li>
                        <li><a href="{{url('shoppingcart')}}"><span class="icon_bag_alt"></span>
                                @php
                                $cart=session()->get('cart');
                                @endphp
                                <div class="tip">{{(isset($cart)?count(session()->get('cart')):"0")}}</div>
                            </a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="canvas__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
