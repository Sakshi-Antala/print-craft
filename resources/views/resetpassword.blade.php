@extends('app')
@section('body')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>Reset Password</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="contact__content">
                        <div class="contact__form">
                            <h5>Reset Password</h5>
                            <form action="{{url('passchange')}}" method="post" class="checkout__form">
                                @csrf
                                <span style="color: red;">{{session()->get('msg')}}</span>
                                <input type="hidden" value="{{$otp}}" name="otp">
                                <span style="color: red;">{{session()->get('message')}}</span>
                                <input type="password" placeholder="Password" name="password">
                                <input type="password" placeholder="Confrim Password" name="cpassword">
                                <button type="submit" class="site-btn">Reset Password</button>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection