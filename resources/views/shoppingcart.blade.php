@extends('app')
@section('body')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>Shopping cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Cart Section Begin -->
    <section class="shop-cart spad">
        <div class="container">
            <span style="color:red">{{session()->get('message')}}</span>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        <table>
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Paperstock</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            </thead>
                            @php
                            $data=session()->get('cart');
                            $c=0;
                            $total=0;
                            @endphp
                            <tbody>
                            @if(isset($data) && count($data)>0)
                            @foreach($data as $key=>$value)
                            @php
                                  $total=$total+($value['qty']*$value['price']);
                            @endphp
                            <tr>
                                <td class="cart__product__item">
                                    <img width="100px" src="{{asset('public/Assets')}}/img/product-img/{{($value['url']!=''?$value['url']:'custom_design/'.$value['cus_design'][0])}}" alt="">
                                    <div class="cart__product__item__title">
                                        <h6>{{$value['pname']}}</h6>
                                        {{--<div class="rating">--}}
                                            {{--<i class="fa fa-star"></i>--}}
                                            {{--<i class="fa fa-star"></i>--}}
                                            {{--<i class="fa fa-star"></i>--}}
                                            {{--<i class="fa fa-star"></i>--}}
                                            {{--<i class="fa fa-star"></i>--}}
                                        {{--</div>--}}
                                    </div>
                                </td>
                                <td class="cart__price">{{$value['price']}}</td>
                                <td class="cart__price">{{$value['color']}}</td>
                                @if($value['size']=='')
                                    <td class="cart__price">--</td>
                                @else
                                <td class="cart__price">{{$value['size']}}</td>
                                {{--<td class="cart__price">{{$value['paperstock']}}</td>--}}
                                @endif
                                @if($value['paperstock']=='')
                                    <td class="cart__price">--</td>
                                @else
                                    <td class="cart__price">{{$value['paperstock']}}</td>
                                @endif
                                <td class="cart__quantity">
                                    <div class="pro-qty1">
                                        <span class="dec qtybtn" data="{{$c}}">-</span>
                                        <input type="text" value="{{$value['qty']}}" class="qtyval_{{$c}}" id="{{$key}}" min="{{($value['min_qty']!=''?$value['min_qty']:'50')}}" readonly>
                                        <span class="inc qtybtn" data="{{$c++}}">+</span>
                                    </div>
                                </td>
                                <td class="cart__total">{{$value['price']*$value['qty']}}</td>
                                <td class="cart__close"><a href="{{url('removecart')}}/{{$key}}"><span class="icon_close"></span></a></td>
                            </tr>
                            @endforeach
                            @else
                                <td class="cart__price">CART IS EMPTY!!!</td>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                        <a href="{{url('shop')}}">Continue Shopping</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="discount__content">
                        <h6>Discount codes</h6>
                        <form>
                            <input type="text" id="c_coupon" placeholder="Enter your coupon code">
                            <button type="button" class="site-btn capply">Apply</button>
                            <span class="err"></span>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-2">
                    <div class="cart__total__procced">
                        <h6>Cart total</h6>
                        <ul>
                            @php
                                $d=0;
                            @endphp
                            @if(session()->has('coupon'))
                                @php
                                   $d=session()->get('coupon.amt');
                                @endphp
                            @endif
                            <li>Subtotal <span>Rs.{{$total}}</span></li>
                            <li>Discount <span id="dis">Rs.{{$d}}</span></li>
                            <li>Total <span id="amt">Rs.{{$total-$d}}</span></li>
                        </ul>
                        <a href="{{url('checkout')}}" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Cart Section End -->

@endsection
@section('script')
    <script>
        $('.qtybtn').click(function () {
           var key=$(this).attr('data');
           var pkey=$("input").filter(".qtyval_"+key).attr('id');
            var min=$("input").filter(".qtyval_"+key).attr('min');
           var cartqty=$(".qtyval_"+key).val();
           if($(this).hasClass('inc')){
               $(".qtyval_"+key).val(parseInt(cartqty)+1);
               updatecart(pkey,parseInt(cartqty)+1);
           }else if($(this).hasClass('dec')){
               if(cartqty>min){
                   $(".qtyval_"+key).val(parseInt(cartqty)-1);
                   updatecart(pkey,parseInt(cartqty)-1);
               }else{
                   alert('Minimum Quantity Must Be:'+min);
               }

           }
        });
        function updatecart(key,qty) {
           $.ajax({
               url:"{{url('updatecart')}}/"+key+"/"+qty,
               success:function (result) {
                   location.reload();
               }
           });
        }
        $('.capply').click(function () {
           var code=$('#c_coupon').val();
           $.ajax({
              url:"{{url('couponcheck')}}/"+code,
              dataType:'json',
              success:function ($result) {
                  $('.err').html($result.err);
                  $('#dis').html("Rs."+$result.dis);
                  $('#amt').html("Rs."+$result.amt);
              }
           });
        });
    </script>
@endsection