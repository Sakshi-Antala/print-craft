@extends('app')
@section('body')
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
                                <div class="checkout__order__product">
                                    <ul>
                                        <li>Name: {{$user->name}}</li>
                                        <li>Email: {{$user->email}}</li>
                                        <li>Mobile: {{$user->mobile}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="checkout__order">
                            <h5>Your Selected Plan</h5>
                            <div class="checkout__order__product">
                                <ul>
                                    <li>
                                        <span class="top__text">Type</span>
                                        <span class="top__text__right">Total</span>
                                    </li>
                                    <li>01.{{$membership->m_title}} <span>{{$membership->price}}</span></li>
                                    <input type="hidden" name="price" value="{{$membership->price}}" id="price">
                                    <input type="hidden" name="mid" id="mid" value="{{$membership->mid}}">
                                    <input type="hidden" name="duration" id="duration" value="{{$membership->duration}}">
                                </ul>
                            </div>
                            <hr>
                            <button type="button" class="site-btn" id="payment">Pay Now</button>
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

        var token=$('#token').val();
        var amount=$('#price').val();
        var duration=$('#duration').val();
        var mid=$('#mid').val();
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
                    url:"{{url('purchase')}}",
                    method:"POST",
                    data:{_token:token,payment_id:response.razorpay_payment_id,amount:amount,mid:mid,duration:duration},
                    success:function (result) {
                        console.log(result);
                        window.location.replace('/agencyform');
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
        $('#payment').click(function () {
            pay.open();
        });
    </script>
@endsection
