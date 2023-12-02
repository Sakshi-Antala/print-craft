@extends('app')
@section('body')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>Change Password</span>
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
                            <h5>Change Password</h5>
                            <form action="{{url('updatepassword')}}" method="post" class="checkout__form">
                                @csrf
                                <span style="color: red;">{{session()->get('msg')}}</span>
                                <input type="password" placeholder="Old Password" name="opassword">
                                <input type="password" placeholder="New Password" name="password">
                                <input type="password" placeholder="Confrim Password" name="cpassword">
                                <button type="submit" class="site-btn">Change Password</button>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection