@extends('app')
@section('body')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>My Profile</span>
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
                            <h5>MY PROFILE</h5>
                            <span style="color: red;">{{session()->get('msg')}}</span>
                            <form action="{{url('updateprofile')}}" method="post" class="checkout__form">
                                @csrf
                                <input type="text" placeholder="Name" name="name" value="{{$user->name}}">
                                @error('name') <span style="color:red;">{{$message}}</span>@enderror
                                <input type="text" placeholder="Mobile" name="mobile" value="{{$user->mobile}}">
                                @error('mobile') <span style="color:red;">{{$message}}</span>@enderror
                                <input type="text" placeholder="Email" name="email" value="{{$user->email}}">
                                <input type="text" placeholder="DOB" name="dob" value="{{$user->dob}}">
                                @error('email') <span style="color:red;">{{$message}}</span>@enderror
                                @error('dob') <span style="color:red;">{{$message}}</span>@enderror
                                <textarea placeholder="Address" name="address">{{$user->address}}</textarea>
                                @error('address') <span style="color:red;">{{$message}}</span>@enderror
                                <input type="text" placeholder="Pincode" name="pincode" value="{{$user->pincode}}">
                                @error('pincode') <span style="color:red;">{{$message}}</span>@enderror<br>
                                <button type="submit" class="site-btn" id="register">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection


