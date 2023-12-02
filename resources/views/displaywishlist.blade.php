@extends('app')
@section('body')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>Wishlist</span>
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
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Color</th>
                                <th>Size</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($wishlist) && count($wishlist)>0)
                                @foreach($wishlist as $value)
                                    <tr>
                                        <td class="cart__product__item">
                                            <img width="100px" src="{{asset('public/Assets')}}/img/product-img/{{(isset($pimage[$value->pid]->url)?$pimage[$value->pid]->url:'demo.png')}}" alt="">
                                            <div class="cart__product__item__title">
                                                <h6>{{$value->pname}}</h6>
                                                {{--<div class="rating">--}}
                                                {{--<i class="fa fa-star"></i>--}}
                                                {{--<i class="fa fa-star"></i>--}}
                                                {{--<i class="fa fa-star"></i>--}}
                                                {{--<i class="fa fa-star"></i>--}}
                                                {{--<i class="fa fa-star"></i>--}}
                                                {{--</div>--}}
                                            </div>
                                        </td>
                                        <td class="cart__price">{{$value->price}}</td>
                                        <td class="cart__quantity">{{$value->p_desc}}</td>
                                        <td class="cart__quantity">{{($attr[$value->pid]->name!=''?$attr[$value->pid]->name:'--')}}</td>
                                        <td class="cart__quantity">{{($attr[$value->pid]->size!=''?$attr[$value->pid]->size:'--')}}</td>
                                        <td class="cart__close"><a href="{{url('removewishlist')}}/{{$value->pid}}"><span class="icon_close"></span></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <td class="cart__price">Wishlist IS EMPTY!!!</td>
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
        </div>
    </section>
    <!-- Shop Cart Section End -->

@endsection
