@extends('app')
@section('body')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
            </div>
            <form action="#" class="checkout__form">
                <div class="row">
                    <div class="col-lg-8">
                        <h5>Billing detail</h5>
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="hidden" name="_token"  id="token" value="{{csrf_token()}}">
                                <div class="checkout__form__input">
                                    <p>Full Name <span>*</span></p>
                                    <input type="text" name="name" id="name">
                                </div>
                                {{--<div class="checkout__form__input">--}}
                                    {{--<p>Country <span>*</span></p>--}}
                                    {{--<input type="text">--}}
                                {{--</div>--}}
                                <div class="checkout__form__input">
                                    <p>Address <span>*</span></p>
                                    <input type="text" id="address" name="address">
                                </div>
                                <div class="checkout__form__input">
                                    <p>Town/City <span>*</span></p>
                                    <input type="text" id="city" name="city">
                                </div>
                                <div class="checkout__form__input">
                                    <p>Postcode/Zip <span>*</span></p>
                                    <input type="text" id="pincode" name="pincode">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Phone <span>*</span></p>
                                    <input type="text" name="phone" id="phone">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Email <span>*</span></p>
                                    <input type="text" id="email" name="email">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="checkout__order">
                            <h5>Your order</h5>
                            <div class="checkout__order__product">
                                <ul>
                                    <li>
                                        <span class="top__text">Product</span>
                                        <span class="top__text__right">Total</span>
                                    </li>
                                    @php
                                        $i=1;
                                        $total=0;
                                    @endphp
                                    @if(isset($cart) && count($cart)>0)
                                    @foreach($cart as $value)
                                        @php
                                            $total=$total+($value['price']*$value['qty']);
                                        @endphp
                                        <li>{{$i++}}.{{$value['pname']}} <span>Rs.{{$value['price']*$value['qty']}}</span></li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="checkout__order__total">
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
                                    <li>Discount <span>Rs.{{$d}}</span></li>
                                    <li>Total <span>Rs.{{$total-$d}}</span></li>
                                </ul>
                                <input type="hidden" value="{{$total-$d}}" name="payment" id="payment">
                            </div>
                            <button type="button" class="site-btn" id="order">Place order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('script')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var name;
        var address;
        var email;
        var phone;
        var city;
        var pincode;
        var token=$('#token').val();
        var amount=$('#payment').val();
        var price=amount*100;
        var options = {
            "key": "rzp_test_eWTQ1slSoRjPEG", // Enter the Key ID generated from the Dashboard
            "amount": price, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
            "currency": "INR",
            "name": "Vistaprint",
            "description": "Make Payment",
            "image": "{{asset('public/Assets')}}/img/demo5.png",
            "order_id": "", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
            "handler": function (response){
                $.ajax({
                   url:"{{url('payment')}}",
                   method:"POST",
                   data:{_token:token,payment_id:response.razorpay_payment_id,amount:amount,name:name,phone:phone,email:email,address:address,city:city,pincode:pincode},
                   success:function (result) {
                       console.log(result);
                      window.location.replace('shoppingcart');
                   }
                });
            },
            "prefill": {
                "name": "Sakshi Antala",
                "email": "sakshiantala10@gmail.com",
                "contact": "8374383934"
            },
            "notes": {
                "address": "Surat"
            },
            "theme": {
                "color": "#CA1515"
            }
        };
        var pay=new Razorpay(options);
        pay.on('payment.failed', function (response){
           alert('Payment Failed');
        });
        $('#order').click(function () {
            name=$('#name').val();
            address=$('#address').val();
            city=$('#city').val();
            pincode=$('#pincode').val();
            phone=$('#phone').val();
            email=$('#email').val();
            if(name!='' && address!='' && city!='' && pincode!='' && phone!='' && email!=''){
                pay.open();
            }else {
                alert('Fill All The Checkout Information Properly');
            }

        });
    </script>
@endsection
