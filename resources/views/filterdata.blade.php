@extends('app')
@section('body')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>Filter</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <form action="{{url('filter')}}" method="post">
                        @csrf
                        <div class="shop__sidebar">
                            {{--<div class="sidebar__categories">--}}
                            {{--<div class="section-title">--}}
                            {{--<h4>Categories</h4>--}}
                            {{--</div>--}}
                            {{--<div class="categories__accordion">--}}
                            {{--<div class="accordion" id="accordionExample">--}}
                            {{--<div class="card">--}}
                            {{--<div class="card-heading active">--}}
                            {{--<a data-toggle="collapse" data-target="#collapseOne">Women</a>--}}
                            {{--</div>--}}
                            {{--<div id="collapseOne" class="collapse show" data-parent="#accordionExample">--}}
                            {{--<div class="card-body">--}}
                            {{--<ul>--}}
                            {{--<li><a href="#">Coats</a></li>--}}
                            {{--<li><a href="#">Jackets</a></li>--}}
                            {{--<li><a href="#">Dresses</a></li>--}}
                            {{--<li><a href="#">Shirts</a></li>--}}
                            {{--<li><a href="#">T-shirts</a></li>--}}
                            {{--<li><a href="#">Jeans</a></li>--}}
                            {{--</ul>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="card">--}}
                            {{--<div class="card-heading">--}}
                            {{--<a data-toggle="collapse" data-target="#collapseTwo">Men</a>--}}
                            {{--</div>--}}
                            {{--<div id="collapseTwo" class="collapse" data-parent="#accordionExample">--}}
                            {{--<div class="card-body">--}}
                            {{--<ul>--}}
                            {{--<li><a href="#">Coats</a></li>--}}
                            {{--<li><a href="#">Jackets</a></li>--}}
                            {{--<li><a href="#">Dresses</a></li>--}}
                            {{--<li><a href="#">Shirts</a></li>--}}
                            {{--<li><a href="#">T-shirts</a></li>--}}
                            {{--<li><a href="#">Jeans</a></li>--}}
                            {{--</ul>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="card">--}}
                            {{--<div class="card-heading">--}}
                            {{--<a data-toggle="collapse" data-target="#collapseThree">Kids</a>--}}
                            {{--</div>--}}
                            {{--<div id="collapseThree" class="collapse" data-parent="#accordionExample">--}}
                            {{--<div class="card-body">--}}
                            {{--<ul>--}}
                            {{--<li><a href="#">Coats</a></li>--}}
                            {{--<li><a href="#">Jackets</a></li>--}}
                            {{--<li><a href="#">Dresses</a></li>--}}
                            {{--<li><a href="#">Shirts</a></li>--}}
                            {{--<li><a href="#">T-shirts</a></li>--}}
                            {{--<li><a href="#">Jeans</a></li>--}}
                            {{--</ul>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="card">--}}
                            {{--<div class="card-heading">--}}
                            {{--<a data-toggle="collapse" data-target="#collapseFour">Accessories</a>--}}
                            {{--</div>--}}
                            {{--<div id="collapseFour" class="collapse" data-parent="#accordionExample">--}}
                            {{--<div class="card-body">--}}
                            {{--<ul>--}}
                            {{--<li><a href="#">Coats</a></li>--}}
                            {{--<li><a href="#">Jackets</a></li>--}}
                            {{--<li><a href="#">Dresses</a></li>--}}
                            {{--<li><a href="#">Shirts</a></li>--}}
                            {{--<li><a href="#">T-shirts</a></li>--}}
                            {{--<li><a href="#">Jeans</a></li>--}}
                            {{--</ul>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="card">--}}
                            {{--<div class="card-heading">--}}
                            {{--<a data-toggle="collapse" data-target="#collapseFive">Cosmetic</a>--}}
                            {{--</div>--}}
                            {{--<div id="collapseFive" class="collapse" data-parent="#accordionExample">--}}
                            {{--<div class="card-body">--}}
                            {{--<ul>--}}
                            {{--<li><a href="#">Coats</a></li>--}}
                            {{--<li><a href="#">Jackets</a></li>--}}
                            {{--<li><a href="#">Dresses</a></li>--}}
                            {{--<li><a href="#">Shirts</a></li>--}}
                            {{--<li><a href="#">T-shirts</a></li>--}}
                            {{--<li><a href="#">Jeans</a></li>--}}
                            {{--</ul>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <div class="sidebar__filter">
                                <div class="section-title">
                                    <h4>Shop by price</h4>
                                </div>
                                <div class="filter-range-wrap">
                                    <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                         data-min="100" data-max="100000"></div>
                                    <div class="range-slider">
                                        <div class="price-input">
                                            <p>Price:</p>
                                            <input type="text" id="minamount" name="min">
                                            <input type="text" id="maxamount" name="max">
                                        </div>
                                    </div>
                                </div>
                                {{--<a href="#">Filter</a>--}}
                            </div>
                            <div class="sidebar__sizes">
                                <div class="section-title">
                                    <h4>Shop by category</h4>
                                </div>
                                <div class="size__list">
                                    @foreach($sub as $subcat)
                                        @if(isset($cat) && in_array($subcat->sub_cat_id,$cat))
                                        <label for="sub_{{$subcat->sub_cat_id}}">
                                            {{$subcat->s_c_name}}
                                            <input type="checkbox" id="sub_{{$subcat->sub_cat_id}}" name="cat[]" value="{{$subcat->sub_cat_id}}" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                        @else
                                            <label for="sub_{{$subcat->sub_cat_id}}">
                                                {{$subcat->s_c_name}}
                                                <input type="checkbox" id="sub_{{$subcat->sub_cat_id}}" name="cat[]" value="{{$subcat->sub_cat_id}}">
                                                <span class="checkmark"></span>
                                            </label>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="sidebar__color">
                                <div class="section-title">
                                    <h4>Shop by color</h4>
                                </div>
                                <div class="size__list color__list">
                                    @foreach($color as $c)
                                        @if(isset($col) && in_array($c->color_id,$col))
                                        <label for="color_{{$c->color_id}}">
                                            {{$c->name}}
                                            <input type="checkbox" id="color_{{$c->color_id}}" name="col[]" value="{{$c->color_id}}" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                        @else
                                            <label for="color_{{$c->color_id}}">
                                                {{$c->name}}
                                                <input type="checkbox" id="color_{{$c->color_id}}" name="col[]" value="{{$c->color_id}}">
                                                <span class="checkmark"></span>
                                            </label>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="sidebar__sizes">
                                <div class="section-title">
                                    <h4>Shop by size</h4>
                                </div>
                                <div class="size__list">
                                    @foreach($size as $s)
                                        @if(isset($sizes) && in_array($s->size_id,$sizes))
                                        <label for="size_{{$s->size_id}}">
                                            {{$s->size}}
                                            <input type="checkbox" id="size_{{$s->size_id}}" name="sizes[]" value="{{$s->size_id}}" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                        @else
                                            <label for="size_{{$s->size_id}}">
                                                {{$s->size}}
                                                <input type="checkbox" id="size_{{$s->size_id}}" name="sizes[]" value="{{$s->size_id}}">
                                                <span class="checkmark"></span>
                                            </label>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="site-btn">FILTER</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        {{--<div class="col-lg-4 col-md-6">--}}
                        {{--<div class="product__item">--}}
                        {{--<div class="product__item__pic set-bg" data-setbg="{{asset('public/Assets')}}/img/shop/1.png">--}}
                        {{--<ul class="product__hover">--}}
                        {{--<li><a href="{{asset('public/Assets')}}/img/shop/shop-2.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>--}}
                        {{--<li><a href="#"><span class="icon_heart_alt"></span></a></li>--}}
                        {{--<li><a href="#"><span class="icon_bag_alt"></span></a></li>--}}
                        {{--</ul>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        @php
                            $c=0;
                            $f=0;
                        @endphp
                        @foreach($pro as $key=>$val)
                            <div class="col-lg-4 col-md-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="{{asset('public/Assets')}}/img/product-img/{{(isset($image[$val->pid]->url)?$image[$val->pid]->url:'demo.png')}}" id="{{$key}}">
                                        <div class="label new">New</div>
                                        <ul class="product__hover">
                                            {{--{{asset('public/Assets')}}/img/product-img/{{(isset($image[$val->pid]->url)?$image[$val->pid]->url:'demo.png')}}--}}
                                            <li><a href="{{url('productdetail')}}/{{$val->pid}}" class=""><span class=""><i class="fa fa-1x fa-info-circle" aria-hidden="true"></i></span></a></li>
                                            <li><a href="{{url('wishlist')}}/{{$val->pid}}"><span class="icon_heart_alt"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">

                                        <h6><a href="{{url('productdetail')}}/{{$val->pid}}">{{$val->pname}}</a></h6>
                                        @php
                                            $reviews=\DB::table('reviews')->where('pid',$val->pid)->first();
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
                                                {{--@else--}}
                                                {{--<i class="fa fa-star-o"></i>--}}
                                                {{--<i class="fa fa-star-o"></i>--}}
                                                {{--<i class="fa fa-star-o"></i>--}}
                                                {{--<i class="fa fa-star-o"></i>--}}
                                                {{--<i class="fa fa-star-o"></i>--}}
                                            @endif
                                            {{--<i class="fa fa-star"></i>--}}
                                            {{--<i class="fa fa-star"></i>--}}
                                            {{--<i class="fa fa-star"></i>--}}
                                            {{--<i class="fa fa-star"></i>--}}
                                            {{--<i class="fa fa-star"></i>--}}
                                        </div>
                                        @php
                                            $value=\DB::table('product_attrs')->leftjoin('pcolors','pcolors.color_id','product_attrs.color_id')->where('product_attrs.pid',$val->pid)->get();
                                        @endphp
                                        <div class="color__checkbox">
                                            @foreach($value as $colors)
                                                @if($colors->name!='')
                                                    <label for="">
                                                        <input name="color"  value="{{$colors->name}}" >
                                                        <span class="checkmark" id="colors{{$c}}"  onmouseenter="change('{{asset('public/Assets')}}/img/product-color-img/{{$colors->url}}','{{$key}}','{{$c}}','{{url('productdetail')}}/{{$val->pid}}')" onmouseleave="leave('{{$key}}','{{$c++}}','{{url('productdetail')}}/{{$val->pid}}')" style="border: 1px solid black;background-color: {{$colors->name}}"></span>
                                                    </label>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="product__price">Rs.{{$val->price}}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{--<div class="col-lg-4 col-md-6">--}}
                        {{--<div class="product__item">--}}
                        {{--<div class="product__item__pic set-bg" data-setbg="{{asset('public/Assets')}}/img/shop/shop-2.jpg">--}}
                        {{--<ul class="product__hover">--}}
                        {{--<li><a href="{{asset('public/Assets')}}/img/shop/shop-2.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>--}}
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
                        {{--<div class="col-lg-4 col-md-6">--}}
                        {{--<div class="product__item">--}}
                        {{--<div class="product__item__pic set-bg" data-setbg="{{asset('public/Assets')}}/img/shop/shop-3.jpg">--}}
                        {{--<ul class="product__hover">--}}
                        {{--<li><a href="{{asset('public/Assets')}}/img/shop/shop-3.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>--}}
                        {{--<li><a href="#"><span class="icon_heart_alt"></span></a></li>--}}
                        {{--<li><a href="#"><span class="icon_bag_alt"></span></a></li>--}}
                        {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="product__item__text">--}}
                        {{--<h6><a href="#">Croc-effect bag</a></h6>--}}
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
                        {{--<div class="col-lg-4 col-md-6">--}}
                        {{--<div class="product__item">--}}
                        {{--<div class="product__item__pic set-bg" data-setbg="{{asset('public/Assets')}}/img/shop/shop-4.jpg">--}}
                        {{--<ul class="product__hover">--}}
                        {{--<li><a href="{{asset('public/Assets')}}/img/shop/shop-4.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>--}}
                        {{--<li><a href="#"><span class="icon_heart_alt"></span></a></li>--}}
                        {{--<li><a href="#"><span class="icon_bag_alt"></span></a></li>--}}
                        {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="product__item__text">--}}
                        {{--<h6><a href="#">Dark wash Xavi jeans</a></h6>--}}
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
                        {{--<div class="col-lg-4 col-md-6">--}}
                        {{--<div class="product__item sale">--}}
                        {{--<div class="product__item__pic set-bg" data-setbg="{{asset('public/Assets')}}/img/shop/shop-5.jpg">--}}
                        {{--<div class="label">Sale</div>--}}
                        {{--<ul class="product__hover">--}}
                        {{--<li><a href="{{asset('public/Assets')}}/img/shop/shop-5.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>--}}
                        {{--<li><a href="#"><span class="icon_heart_alt"></span></a></li>--}}
                        {{--<li><a href="#"><span class="icon_bag_alt"></span></a></li>--}}
                        {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="product__item__text">--}}
                        {{--<h6><a href="#">Ankle-cuff sandals</a></h6>--}}
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
                        {{--<div class="col-lg-4 col-md-6">--}}
                        {{--<div class="product__item">--}}
                        {{--<div class="product__item__pic set-bg" data-setbg="{{asset('public/Assets')}}/img/shop/shop-6.jpg">--}}
                        {{--<ul class="product__hover">--}}
                        {{--<li><a href="{{asset('public/Assets')}}/img/shop/shop-6.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>--}}
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
                        {{--<div class="col-lg-4 col-md-6">--}}
                        {{--<div class="product__item">--}}
                        {{--<div class="product__item__pic set-bg" data-setbg="{{asset('public/Assets')}}/img/shop/shop-7.jpg">--}}
                        {{--<ul class="product__hover">--}}
                        {{--<li><a href="{{asset('public/Assets')}}/img/shop/shop-7.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>--}}
                        {{--<li><a href="#"><span class="icon_heart_alt"></span></a></li>--}}
                        {{--<li><a href="#"><span class="icon_bag_alt"></span></a></li>--}}
                        {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="product__item__text">--}}
                        {{--<h6><a href="#">Circular pendant earrings</a></h6>--}}
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
                        {{--<div class="col-lg-4 col-md-6">--}}
                        {{--<div class="product__item">--}}
                        {{--<div class="product__item__pic set-bg" data-setbg="{{asset('public/Assets')}}/img/shop/shop-8.jpg">--}}
                        {{--<div class="label stockout stockblue">Out Of Stock</div>--}}
                        {{--<ul class="product__hover">--}}
                        {{--<li><a href="{{asset('public/Assets')}}/img/shop/shop-8.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>--}}
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
                        {{--<div class="col-lg-4 col-md-6">--}}
                        {{--<div class="product__item sale">--}}
                        {{--<div class="product__item__pic set-bg" data-setbg="{{asset('public/Assets')}}/img/shop/shop-9.jpg">--}}
                        {{--<div class="label">Sale</div>--}}
                        {{--<ul class="product__hover">--}}
                        {{--<li><a href="{{asset('public/Assets')}}/img/shop/shop-9.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>--}}
                        {{--<li><a href="#"><span class="icon_heart_alt"></span></a></li>--}}
                        {{--<li><a href="#"><span class="icon_bag_alt"></span></a></li>--}}
                        {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="product__item__text">--}}
                        {{--<h6><a href="#">Water resistant zips backpack</a></h6>--}}
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

                        {{--<div class="col-lg-12 text-center">--}}
                            {{--{{$product->links('pagination')}}--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        @if(session()->has('message'))
               alert("{{session()->get('message')}}");
                @endif
        var count=0;
        function change(img,c,key,url) {
            $('#'+c).html('<div class="product__item__pic set-bg" data-setbg="'+img+'" style="background-image: url(&quot;'+img+'&quot;)">\
                 <div class="label new">New</div>\
                 <ul class="product__hover">\
                 <li><a href="'+url+'" class="image-popup"><span class=""><i class="fa fa-1x fa-info-circle" aria-hidden="true"></i></span></a></li>\
                 <li><a href="#"><span class="icon_heart_alt"></span></a></li>\
                 </ul>\
                 </div>');
            $('#colors'+key).css("border","3px solid gray");
//         alert($("div").filter('.product__item').attr('id'));
        }
        function leave(c,key,url) {
            $('#'+c).html('<div class="product__item__pic set-bg" data-setbg="'+url+'" style="background-image: url(&quot;&quot;)">\
                 <div class="label new">New</div>\
                 <ul class="product__hover">\
                 <li><a href="'+url+'" class="image-popup"><span class=""><i class="fa fa-1x fa-info-circle" aria-hidden="true"></i></span></a></li>\
                 <li><a href="#"><span class="icon_heart_alt"></span></a></li>\
                 </ul>\
                 </div>');
            $('#colors'+key).css("border","1px solid black");
        }
    </script>
@endsection