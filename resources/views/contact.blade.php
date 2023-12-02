@extends('app')
@section('body')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>Contact</span>
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
                <div class="col-lg-6 col-md-6">
                    <div class="contact__content">
                        <div class="contact__address">
                            <h5>Contact info</h5>
                            <ul>
                                {{--<li>--}}
                                    {{--<h6><i class="fa fa-map-marker"></i> Address</h6>--}}
                                    {{--<p>160 Pennsylvania Ave NW, Washington, Castle, PA 16101-5161</p>--}}
                                {{--</li>--}}
                                <li>
                                    <h6><i class="fa fa-phone"></i> Phone</h6>
                                    <p><span>125-711-811</span><span>125-668-886</span></p>
                                </li>
                                <li>
                                    <h6><i class="fa fa-headphones"></i> Support</h6>
                                    <p>vistaprint@gmail.com</p>
                                </li>
                            </ul>
                        </div>
                        <div class="contact__form">
                            <h5>SEND MESSAGE</h5>
                            <form action="{{url('contactus')}}" method="post">
                                @csrf
                                <input type="text" placeholder="Name" name="name" value="{{old('name')}}">
                                @error('name')<span style="color: red;">{{$message}}</span>@enderror
                                <input type="text" placeholder="Email" name="email" value="{{old('email')}}">
                                @error('email')<span style="color: red;">{{$message}}</span>@enderror
                                <textarea placeholder="Message" name="message">{{old('message')}}</textarea>
                                @error('message')<span style="color: red;">{{$message}}</span>@enderror<br>
                                <button type="submit" class="site-btn">Send Message</button>
                                <span style="color: red;">{{session()->get('message')}}</span>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="contact__map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3815485.374320829!2d70.59151267393572!3d20.950108070697052!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e9adc08a64e99%3A0xe0b5c3874e245b67!2sVistaprint!5e0!3m2!1sen!2sin!4v1619611152563!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        {{--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4348.727048653194!2d72.86210912668875!3d21.23349078783652!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04f0c073ca7a3%3A0x6d3af6a8bbcdc924!2sTrueline%20Solution%20-%20TLS%20India!5e0!3m2!1sen!2sin!4v1619588956173!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection
