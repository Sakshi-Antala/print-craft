@extends('app')
@section('body')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>Agency Registration Form</span>
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
                            <h5>AGENCY REGISTRATION</h5>
                            <form action="{{url('insertagency')}}/{{session()->get('user.uid')}}" method="post" class="checkout__form">
                                @csrf
                                <input type="text" placeholder="Agency Name" name="a_name" value="{{old('a_name')}}">
                                @error('a_name') <span style="color:red;">{{$message}}</span>@enderror
                                <input type="text" placeholder="GST" name="gst" value="{{old('gst')}}">
                                @error('gst') <span style="color:red;">{{$message}}</span>@enderror<br>
                                <span style="color:red">{{session()->get('msg')}}</span><br>
                                <button type="submit" class="site-btn" id="register">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection


