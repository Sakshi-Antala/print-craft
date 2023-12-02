@extends('app')
@section('body')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>My Order</span>
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
                                <th>Order Id</th>
                                <th>Order Date</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th style="text-align: center;">Order Detail</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order as $value)
                                    <tr>
                                        <td class="cart__product__item__title">{{$value->o_id}}</td>
                                        <td class="cart__quantity">{{$value->o_date}}</td>
                                        <td class="cart__quantity">{{$value->amount}}</td>
                                        <td class="cart__quantity">
                                        @if($value->status==0)
                                            <span class="badge badge-pill badge-warning">Placed</span>
                                        @elseif($value->status==1)
                                            <span class="badge badge-pill badge-warning">Printing</span>
                                        @elseif($value->status==2)
                                            <span class="badge badge-pill badge-danger">Printed</span>
                                        @elseif($value->status==3)
                                            <span class="badge badge-pill badge-success">Delivered</span>
                                        @endif
                                        </td>
                                        <td class="" style="text-align: center;"><a href="{{url('orderdetail')}}/{{$value->o_id}}" style="color: black;"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                        <td><a href="{{url('invoice')}}/{{$value->o_id}}"><button type="button" class="site-btn" id="register">Invoice</button></a></td>
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
