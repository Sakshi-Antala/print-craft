@extends('app')
@section('body')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <a href="{{url('myorder')}}">My Order</a>
                        <span>Order Detail</span>
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
                                <th>NO.</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th class="text-center">Logo On Design</th>
                                <th style="text-align: center;">Uploaded Design</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($odetail as $key=>$value)
                                <tr>
                                    <td class="cart__product__item__title">{{$key+1}}</td>
                                    <td class="cart__quantity">{{$value->pname}}</td>
                                    <td class="cart__quantity">{{$value->qty}}</td>
                                    <td class="cart__quantity">{{$value->price}}</td>
                                    <td class="cart__quantity">color:{{($value->color!=''?$value->color:'  --')}}
                                    <br>size:{{($value->size!=''?$value->size:'  --')}}<br>
                                    paperstock:{{($value->paperstock!=''?$value->paperstock:'  --')}}<br>
                                    Required Data:{{$value->required_datas}}<br>
                                    </td>
                                    <td style="text-align: center;">
                                        <img width="80px"  src="{{asset('public/Assets')}}/img/cimage/{{($value->logo_url!=''?$value->logo_url:'none.png')}}" alt="">
                                    </td>
                                    @php
                                    $arr=explode(",",$value->user_uploaded_design);
                                    @endphp
                                    <td class="" style="text-align: center;"><img width="100px"  src="{{asset('public/Assets')}}/img/product-img/custom_design/{{(isset($arr) && count($arr)>0 && $arr[0]!=''?$arr[0]:'none.png')}}" alt=""></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Cart Section End -->

@endsection
