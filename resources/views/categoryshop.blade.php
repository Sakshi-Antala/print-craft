@extends('app')
@section('body')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>Category-Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <form action="{{url('filtercategory')}}" method="post">
                        @csrf
                    <div class="shop__sidebar">
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
                        </div>
                        <div class="sidebar__sizes">
                            <div class="section-title">
                                <h4>Shop by subcategory</h4>
                            </div>
                            <div class="size__list">
                                @foreach($sub as $subcat)
                                    <label for="sub_{{$subcat->sub_cat_id}}">
                                        {{$subcat->s_c_name}}
                                        <input type="checkbox" id="sub_{{$subcat->sub_cat_id}}" name="cat[]" value="{{$subcat->sub_cat_id}}">
                                        <span class="checkmark"></span>
                                    </label>
                                    <input type="hidden" name="cat_id" value="{{$subcat->cat_id}}">
                                @endforeach
                            </div>
                        </div>
                        <div class="sidebar__color">
                            <div class="section-title">
                                <h4>Shop by color</h4>
                            </div>
                            <div class="size__list color__list">
                                @foreach($color as $c)
                                    <label for="color_{{$c->color_id}}">
                                        {{$c->name}}
                                        <input type="checkbox" id="color_{{$c->color_id}}" name="col[]" value="{{$c->color_id}}">
                                        <span class="checkmark"></span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="site-btn">FILTER</button>
                    </div>
                    </form>
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="row">
                    @php
        $c=0;
        $f=0;
    @endphp
    @foreach($product as $key=>$val)
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
                        @endif
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