@extends('app')
@section('body')
    {{--{{session()->get('message')}}--}}
    <section class="categories">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="categories__item categories__large__item set-bg"
                         data-setbg="{{asset('public/Assets')}}/img/categories/1.jpg">
                        <div class="categories__text">
                            <h1 style="padding-top: 5px">Visiting Cards</h1>
                            <a href="{{url('shop')}}">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg" data-setbg="{{asset('public/Assets')}}/img/categories/2.jpg">
                                <div class="categories__text">
                                    <h4 style="padding-top: 10px">Posters</h4>
                                    <a href="{{url('shop')}}">Shop now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg" data-setbg="{{asset('public/Assets')}}/img/categories/3.jpg">
                                <div class="categories__text">
                                    <h4 style="padding-top: 10px">Pens</h4>
                                    <a href="{{url('shop')}}">Shop now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg" data-setbg="{{asset('public/Assets')}}/img/categories/4.jpg">
                                <div class="categories__text">
                                    <h4 style="padding-top: 7px">Mugs</h4>
                                    <a href="{{url('shop')}}">Shop now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg" data-setbg="{{asset('public/Assets')}}/img/categories/5.jpg">
                                <div class="categories__text">
                                    <h4 style="padding-top: 7px">Clothes</h4>
                                    <a href="{{url('shop')}}">Shop now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="section-title">
                        <h4>New product</h4>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <ul class="filter__controls">
                        <li class="active" data-filter="*">All</li>
                        @foreach($cate as $value)
                            <li data-filter=".{{$value->cname}}">{{$value->cname}}</li>
                        @endforeach
                        {{--<li data-filter=".women">Women’s</li>--}}
                        {{--<li data-filter=".men">Men’s</li>--}}
                        {{--<li data-filter=".kid">Kid’s</li>--}}
                        {{--<li data-filter=".accessories">Accessories</li>--}}
                        {{--<li data-filter=".cosmetic">Cosmetics</li>--}}
                    </ul>
                </div>
            </div>
            <div class="row property__gallery">
                @foreach($product as $value)
                @php
                   $img=\DB::table('p_images')->where('pid',$value->pid)->first();
                @endphp
                <div class="col-lg-3 col-md-4 col-sm-6 mix {{$value->cname}}">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{asset('public/Assets')}}/img/product-img/{{($img!=''?$img->url:'demo.png')}}" style="max-height: 320px;">
                            <div class="label new">New</div>
                            <ul class="product__hover">
                                <li><a href="{{asset('public/Assets')}}/img/product-img/{{($img!=''?$img->url:'demo.png')}}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                <li><a href="{{url('wishlist')}}/{{$value->pid}}"><span class="icon_heart_alt"></span></a></li>
                                {{--<li><a href="{{url('homeaddtocart')}}/{{$value->pid}}"><span class="icon_bag_alt"></span></a></li>--}}
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="{{url('productdetail')}}/{{$value->pid}}">{{$value->pname}}</a></h6>
                            @php
                                $reviews=\DB::table('reviews')->where('pid',$value->pid)->first();
                            @endphp
                            <div class="rating">
                                @if(isset($reviews->rating))
                                    @for($i=0;$i<$reviews->rating;$i++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                    @php
                                        $k=5-$reviews->rating;
                                    @endphp
                                    @for($j=0;$j<$k;$j++)
                                        <i class="fa fa-star-o"></i>
                                    @endfor
                                @endif
                            </div>
                            <div class="product__price">Rs.{{$value->price}}</div>
                        </div>
                    </div>
                </div>
                @endforeach
                {{--<div class="col-lg-3 col-md-4 col-sm-6 mix men">--}}
                    {{--<div class="product__item">--}}
                        {{--<div class="product__item__pic set-bg" data-setbg="{{asset('public/Assets')}}/img/product/product-2.jpg">--}}
                            {{--<ul class="product__hover">--}}
                                {{--<li><a href="{{asset('public/Assets')}}/img/product/product-2.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>--}}
                                {{--<li><a href="#"><span class="icon_heart_alt"></span></a></li>--}}
                                {{--<li><a href="#"><span class="icon_bag_alt"></span></a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="product__item__text">--}}
                            {{--<h6><a href="#">Flowy striped skirt</a></h6>--}}
                            {{--<div class="rating">--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                            {{--</div>--}}
                            {{--<div class="product__price">$ 49.0</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-lg-3 col-md-4 col-sm-6 mix accessories">--}}
                    {{--<div class="product__item">--}}
                        {{--<div class="product__item__pic set-bg" data-setbg="{{asset('public/Assets')}}/img/product/product-3.jpg">--}}
                            {{--<div class="label stockout">out of stock</div>--}}
                            {{--<ul class="product__hover">--}}
                                {{--<li><a href="{{asset('public/Assets')}}/img/product/product-3.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>--}}
                                {{--<li><a href="#"><span class="icon_heart_alt"></span></a></li>--}}
                                {{--<li><a href="#"><span class="icon_bag_alt"></span></a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="product__item__text">--}}
                            {{--<h6><a href="#">Cotton T-Shirt</a></h6>--}}
                            {{--<div class="rating">--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                            {{--</div>--}}
                            {{--<div class="product__price">$ 59.0</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-lg-3 col-md-4 col-sm-6 mix cosmetic">--}}
                    {{--<div class="product__item">--}}
                        {{--<div class="product__item__pic set-bg" data-setbg="{{asset('public/Assets')}}/img/product/product-4.jpg">--}}
                            {{--<ul class="product__hover">--}}
                                {{--<li><a href="{{asset('public/Assets')}}/img/product/product-4.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>--}}
                                {{--<li><a href="#"><span class="icon_heart_alt"></span></a></li>--}}
                                {{--<li><a href="#"><span class="icon_bag_alt"></span></a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="product__item__text">--}}
                            {{--<h6><a href="#">Slim striped pocket shirt</a></h6>--}}
                            {{--<div class="rating">--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                            {{--</div>--}}
                            {{--<div class="product__price">$ 59.0</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-lg-3 col-md-4 col-sm-6 mix kid">--}}
                    {{--<div class="product__item">--}}
                        {{--<div class="product__item__pic set-bg" data-setbg="{{asset('public/Assets')}}/img/product/product-5.jpg">--}}
                            {{--<ul class="product__hover">--}}
                                {{--<li><a href="{{asset('public/Assets')}}/img/product/product-5.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>--}}
                                {{--<li><a href="#"><span class="icon_heart_alt"></span></a></li>--}}
                                {{--<li><a href="#"><span class="icon_bag_alt"></span></a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="product__item__text">--}}
                            {{--<h6><a href="#">Fit micro corduroy shirt</a></h6>--}}
                            {{--<div class="rating">--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                            {{--</div>--}}
                            {{--<div class="product__price">$ 59.0</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-lg-3 col-md-4 col-sm-6 mix women men kid accessories cosmetic">--}}
                    {{--<div class="product__item sale">--}}
                        {{--<div class="product__item__pic set-bg" data-setbg="{{asset('public/Assets')}}/img/product/product-6.jpg">--}}
                            {{--<div class="label sale">Sale</div>--}}
                            {{--<ul class="product__hover">--}}
                                {{--<li><a href="{{asset('public/Assets')}}/img/product/product-6.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>--}}
                                {{--<li><a href="#"><span class="icon_heart_alt"></span></a></li>--}}
                                {{--<li><a href="#"><span class="icon_bag_alt"></span></a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="product__item__text">--}}
                            {{--<h6><a href="#">Tropical Kimono</a></h6>--}}
                            {{--<div class="rating">--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                            {{--</div>--}}
                            {{--<div class="product__price">$ 49.0 <span>$ 59.0</span></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-lg-3 col-md-4 col-sm-6 mix women men kid accessories cosmetic">--}}
                    {{--<div class="product__item">--}}
                        {{--<div class="product__item__pic set-bg" data-setbg="{{asset('public/Assets')}}/img/product/product-7.jpg">--}}
                            {{--<ul class="product__hover">--}}
                                {{--<li><a href="{{asset('public/Assets')}}/img/product/product-7.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>--}}
                                {{--<li><a href="#"><span class="icon_heart_alt"></span></a></li>--}}
                                {{--<li><a href="#"><span class="icon_bag_alt"></span></a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="product__item__text">--}}
                            {{--<h6><a href="#">Contrasting sunglasses</a></h6>--}}
                            {{--<div class="rating">--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                            {{--</div>--}}
                            {{--<div class="product__price">$ 59.0</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-lg-3 col-md-4 col-sm-6 mix women men kid accessories cosmetic">--}}
                    {{--<div class="product__item sale">--}}
                        {{--<div class="product__item__pic set-bg" data-setbg="{{asset('public/Assets')}}/img/product/product-8.jpg">--}}
                            {{--<div class="label">Sale</div>--}}
                            {{--<ul class="product__hover">--}}
                                {{--<li><a href="{{asset('public/Assets')}}/img/product/product-8.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>--}}
                                {{--<li><a href="#"><span class="icon_heart_alt"></span></a></li>--}}
                                {{--<li><a href="#"><span class="icon_bag_alt"></span></a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="product__item__text">--}}
                            {{--<h6><a href="#">Water resistant backpack</a></h6>--}}
                            {{--<div class="rating">--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                            {{--</div>--}}
                            {{--<div class="product__price">$ 49.0 <span>$ 59.0</span></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Banner Section Begin -->
    {{--<section class="banner set-bg" data-setbg="{{asset('public/Assets')}}/img/banner/banner-1.jpgs" style="background-color: #f4f4f4">--}}
        {{--<div class="container">--}}
            {{--<div class="row">--}}
                {{--<div class="col-xl-7 col-lg-8 m-auto">--}}
                    {{--<div class="banner__slider owl-carousel" >--}}
                        {{--<div class="banner__item">--}}
                            {{--<div class="banner__text">--}}
                                {{--<span>The Chloe Collection</span>--}}
                                {{--<h1>The Project Jacket</h1>--}}
                                {{--<a href="#">Shop now</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="banner__item">--}}
                            {{--<div class="banner__text">--}}
                                {{--<span>The Chloe Collection</span>--}}
                                {{--<h1>The Project Jacket</h1>--}}
                                {{--<a href="#">Shop now</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="banner__item">--}}
                            {{--<div class="banner__text">--}}
                                {{--<span>The Chloe Collection</span>--}}
                                {{--<h1>The Project Jacket</h1>--}}
                                {{--<a href="#">Shop now</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}
    <!-- Banner Section End -->

    <!-- Trend Section Begin -->
    <!-- Trend Section End -->

    <section class="discount">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="discount__pic">

                    </div>
                </div>
                <div class="col-lg-6">

                </div>
            </div>
        </div>
    </section>
    <!-- Discount Section Begin -->
    <section class="discount">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="discount__pic">
                        <img src="{{asset('public/Assets')}}/img/a12.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="discount__text">
                        <div class="discount__text__title">
                            <span>Discount</span>
                            <h2>Summer 2021</h2>
                            <h5><span>Sale</span> 50%</h5>
                        </div>
                        <div class="discount__countdown" id="countdown-time">
                            <div class="countdown__item">
                                <span>22</span>
                                <p>Days</p>
                            </div>
                            <div class="countdown__item">
                                <span>18</span>
                                <p>Hour</p>
                            </div>
                            <div class="countdown__item">
                                <span>46</span>
                                <p>Min</p>
                            </div>
                            <div class="countdown__item">
                                <span>05</span>
                                <p>Sec</p>
                            </div>
                        </div>
                        <a href="#">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Discount Section End -->

    <!-- Services Section Begin -->
    <section class="services spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-car"></i>
                        <h6>Free Shipping</h6>
                        <p>For all order over Rs.5000</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-money"></i>
                        <h6>Money Back Guarantee</h6>
                        <p>If Design Or Printing Mistake</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-support"></i>
                        <h6>Online Support 24/7</h6>
                        <p>Dedicated support</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-headphones"></i>
                        <h6>Payment Secure</h6>
                        <p>100% secure payment</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->
    {{--<div class="instagram">--}}
        {{--<div class="container-fluid">--}}
            {{--<div class="row">--}}
                {{--<div class="col-lg-2 col-md-4 col-sm-4 p-0">--}}
                    {{--<div class="instagram__item set-bg" data-setbg="{{asset('public/Assets')}}/img/instagram/insta-1.jpg">--}}
                        {{--<div class="instagram__text">--}}
                            {{--<i class="fa fa-instagram"></i>--}}
                            {{--<a href="#">@ ashion_shop</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-lg-2 col-md-4 col-sm-4 p-0">--}}
                    {{--<div class="instagram__item set-bg" data-setbg="{{asset('public/Assets')}}/img/instagram/insta-2.jpg">--}}
                        {{--<div class="instagram__text">--}}
                            {{--<i class="fa fa-instagram"></i>--}}
                            {{--<a href="#">@ ashion_shop</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-lg-2 col-md-4 col-sm-4 p-0">--}}
                    {{--<div class="instagram__item set-bg" data-setbg="{{asset('public/Assets')}}/img/instagram/insta-3.jpg">--}}
                        {{--<div class="instagram__text">--}}
                            {{--<i class="fa fa-instagram"></i>--}}
                            {{--<a href="#">@ ashion_shop</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-lg-2 col-md-4 col-sm-4 p-0">--}}
                    {{--<div class="instagram__item set-bg" data-setbg="{{asset('public/Assets')}}/img/instagram/insta-4.jpg">--}}
                        {{--<div class="instagram__text">--}}
                            {{--<i class="fa fa-instagram"></i>--}}
                            {{--<a href="#">@ ashion_shop</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-lg-2 col-md-4 col-sm-4 p-0">--}}
                    {{--<div class="instagram__item set-bg" data-setbg="{{asset('public/Assets')}}/img/instagram/insta-5.jpg">--}}
                        {{--<div class="instagram__text">--}}
                            {{--<i class="fa fa-instagram"></i>--}}
                            {{--<a href="#">@ ashion_shop</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-lg-2 col-md-4 col-sm-4 p-0">--}}
                    {{--<div class="instagram__item set-bg" data-setbg="{{asset('public/Assets')}}/img/instagram/insta-6.jpg">--}}
                        {{--<div class="instagram__text">--}}
                            {{--<i class="fa fa-instagram"></i>--}}
                            {{--<a href="#">@ ashion_shop</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection
@section('script')
    <script>
    @if(session()->has('message'))
        alert("{{session()->get('message')}}");
    @endif
    </script>
@endsection
