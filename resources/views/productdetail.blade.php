@extends('app')
@section('body')
    <style>
        .rate {
            float: left;
            height: 46px;
            padding: 0 5px;
        }
        .rate:not(:checked) > input {
            position:absolute;
            top:-9999px;
        }
        .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ccc;
        }
        .rate:not(:checked) > label:before {
            content: '★ ';
        }
        .rate > input:checked ~ label {
            color: #ffc700;
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }
        .custom-control-input:checked~.custom-control-label::before {
            background-color: #ca1515;
        }
    </style>
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <a href="#">{{$cat->cname}}</a>
                        <span>{{$product[0]->pname}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <span style="color:red;">{{session()->get('msg')}}</span>
            <div class="row">
                <div class="col-lg-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__left product__thumb nice-scroll">
                            @foreach($product as $value)
                                <a class="pt" href="#{{$value->url}}">
                                    <img src="{{asset('public/Assets')}}/img/product-img/{{$value->url}}" alt="">
                                </a>
                            @endforeach
                        </div>
                        <div class="product__details__slider__content">
                            <div class="product__details__pic__slider owl-carousel">
                                @foreach($product as $value)
                                    <img data-hash="{{$value->url}}" class="product__big__img" src="{{asset('public/Assets')}}/img/product-img/{{$value->url}}" alt="">
                                @endforeach
                                {{--<img data-hash="product-2" class="product__big__img" src="{{asset('public/Assets')}}/img/product-img/demo.png" alt="">--}}
                                {{--<img data-hash="product-3" class="product__big__img" src="{{asset('public/Assets')}}/img/product/details/product-2.jpg" alt="">--}}
                                {{--<img data-hash="product-4" class="product__big__img" src="{{asset('public/Assets')}}/img/product/details/product-4.jpg" alt="">--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        <h3>{{$product[0]->pname}}</h3>
                        @php
                            $reviews=\DB::table('reviews')->where('pid',$product[0]->pid)->first();
                            $count=count($review);
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
                            <span>({{$count}} Reviews)</span>
                        </div>
                        <div class="product__details__price">Rs.{{$product[0]->price}}</div>
                        <p>{{$product[0]->p_desc}}</p>
                        <form action="{{url('addtocart')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$product[0]->pid}}" name="pid">
                        <div class="product__details__widget temp">
                            <ul>
                                <li id="color">
                                    <span>Available color:</span>
                                    <div class="color__checkbox">
                                        @if(isset($cresult) && count($cresult)>0)
                                            @foreach($cresult as $val)
                                            <label for="{{$val['name']}}">
                                                <input type="radio" name="color" id="{{$val['name']}}" value="{{$val['name']}}">
                                                <span class="checkmark {{$val['name']}}-bg"></span>
                                            </label>
                                            @endforeach
                                        @else
                                            <div id="emptycolor"></div>
                                        @endif
                                    </div>
                                </li>
                                <li id="size">
                                    <span>Available size:</span>
                                    <div class="size__btn">
                                        @if(isset($sresult) && count($sresult)>0)
                                            @foreach($sresult as $val)
                                                <label for="{{$val['size']}}">
                                                    <input type="radio" id="{{$val['size']}}" name="size" value="{{$val['size']}}">
                                                        {{$val['size']}}
                                                </label>
                                            @endforeach
                                        @else
                                            <div id="empty"></div>
                                        @endif
                                        {{--@foreach($attr as $val)--}}
                                            {{--<label for="{{$val->size}}">--}}
                                                {{--<input type="radio" id="{{$val->size}}" name="size" value="{{$val->size}}">--}}
                                                {{--@if($val->size!='')--}}
                                                    {{--{{$val->size}}--}}
                                                {{--@else--}}
                                                    {{--<div id="empty"></div>--}}
                                                {{--@endif--}}
                                            {{--</label>--}}
                                        {{--@endforeach--}}
                                    </div>
                                </li>
                                @if($cat->cname=='VisitingCards' || $cat->cname=='Invitation' ||$cat->cname=='Banners-Posters')
                                <li>
                                    <span>Paper Stock:</span>
                                    <div class="">
                                        @foreach($paperstock as $value)
                                            <label for="{{$value->m_type}}">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="{{$value->m_type}}" name="paperstock" value="{{$value->m_type}}">
                                                    <label class="custom-control-label" for="{{$value->m_type}}"> {{$value->m_type}} </label>
                                                </div>
                                                {{--<input type="radio" id="{{$value->m_type}}" name="paperstock" value="{{$value->m_type}}">--}}
                                                {{--{{$value->m_type}}--}}
                                            </label>
                                        @endforeach
                                    </div>
                                </li>
                                @endif
                            </ul>
                        </div>
                        <div class="product__details__button mt-4">
                            <div class="quantity">
                                <span>Quantity:</span>
                                <div class="pro-qty">
                                    <input type="text" value="{{$product[0]->min_qty}}" name="qty" min="{{$product[0]->min_qty}}" readonly>
                                </div>
                            </div>
                            {{--<a href="#" class="cart-btn"><span class="icon_bag_alt"></span> Add to cart</a>--}}
                            <button type="submit" class="cart-btn"><span class="icon_bag_alt"></span> Add to cart</button>
                            <ul>
                                <li><a href="{{url('wishlist')}}/{{$product[0]->pid}}"><span class="icon_heart_alt"></span></a></li>
                                {{--<li><a href="#"><span class="icon_adjust-horiz"></span></a></li>--}}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12" style="margin-top: 30px;">
                    <h4 style="font-weight: bold;">Select Design:</h4>
                    <br>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input design" id="customRadio1" name="udesign" value="0" checked>
                        <label class="custom-control-label" for="customRadio1"> Agency's Design</label>
                    </div><br>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input design" id="customRadio" name="udesign" value="1">
                        <label class="custom-control-label" for="customRadio"> Your Custom Design</label>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Required Data</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                @if($product[0]->required_data!='')
                                <h6>REQUIRED DATA</h6>
                                    <div class="contact__form udata">
                                        <p class=" text-muted" style="color: red;">
                                            If You Want To Choose Our Design Then You Have To Fill These Data.
                                        </p>
                                    @foreach(explode(",",$product[0]->required_data) as $value)
                                               @if(strpos($value,':')==false)
                                                <input type="text" placeholder="{{$value}}" name="items[{{$value}}]">
                                               @else
                                                @php $str=substr("$value",0,-6)@endphp
                                                <label style="padding-left: 6px;">{{$str}}</label>
                                                <input type="file" style="border: none;padding-left: 6px;" name="uimage">
                                               @endif
                                    @endforeach
                                    </div>
                                    <div id="second" style="display: none;">
                                    <span style="color: red;">You Have To First Upload Jpg And Then Pdf File:</span><br><br>
                                    <label for="fileUpload" class="file-upload btn btn-danger btn-block rounded-pill shadow" name="cus_design"><i class="fa fa-upload mr-2"></i>Browse for file ...
                                        <input id="fileUpload" type="file" name="cus_design[]" multiple>
                                    </label>
                                    </div>
                                @else
                                    <h6>Specification</h6>
                                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                        quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                        Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                        voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                        consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                                        consequat massa quis enim.</p>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                        dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                                        quis, sem.</p>
                                @endif
                            </div>
                            </form>
                            <div class="tab-pane contact__form" id="tabs-3" role="tabpanel">
                                <h6>Reviews</h6>
                                <form action="{{url('addreview')}}" method="post">
                                    @csrf
                                    <div class="rate">
                                        <input type="radio" id="star5" name="rate" value="5" />
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" id="star4" name="rate" value="4" />
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" name="rate" value="3" />
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" name="rate" value="2" />
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" name="rate" value="1" />
                                        <label for="star1" title="text">1 star</label>
                                    </div>
                                    <input type="hidden" name="pid" value="{{$product[0]->pid}}">
                                <textarea placeholder="Write Your Review" name="r_desc" ></textarea>
                                    <button type="submit" class="site-btn" id="register">Submit</button>
                                </form>
                                <div class="blog__details__quote mt-4">
                                    <div class="icon"><i class="fa fa-quote-left"></i></div>
                                </div>
                                <div class="blog__details__comment">
                                    @php
                                    $c=count($review);
                                    @endphp
                                    <h5>{{$c}} Review</h5>
                                    @foreach($review as $val)
                                    <div class="blog__comment__item__pic">
                                            <img src="img/blog/details/comment-3.jpg" alt="">
                                    </div>
                                    <div class="blog__comment__item">
                                        <div class="blog__comment__item__text">
                                            <h6>{{$val->name}}</h6>
                                            <p>{{$val->r_desc}}</p>
                                            <div class="rating">
                                            @for($i=0;$i<$val->rating;$i++)
                                                    <i class="fa fa-star"></i>
                                            @endfor
                                            @php
                                               $k=5-$val->rating;
                                            @endphp
                                            @for($j=0;$j<$k;$j++)
                                                    <i class="fa fa-star-o"></i>
                                            @endfor
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
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



        function change_image(img) {
//            $('.owl-item').html('<img data-hash="16171236342.jpg" class="product__big__img" src="'+img+'" alt="">');

        }
        if($('#empty').is(':empty')){
            $('#size').css("display","none");
        }
        if($('#emptycolor').is(':empty')){
            $('#color').css("display","none");
        }
        $('.design').click(function () {
           var value=$(this).val();
           if(value==1){
               $('.udata').hide();
               $('.temp').hide();
               $('#second').show();
           }
           if(value==0){
               $('.udata').show();
               $('.temp').show();
               $('#second').hide();
           }
        });
    </script>
@endsection