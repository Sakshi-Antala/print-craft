@extends('app')
@section('body')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                        <span>Login</span>
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
                            <h5>LOGIN</h5>
                            <form action="{{url('logincheck')}}" method="post" class="checkout__form">
                                @csrf
                                <span style="color: red;">{{session()->get('message')}}</span>
                                <input type="text" placeholder="Email" name="email">
                                <input type="password" placeholder="Password" name="password">
                                <a href="{{url('forgetpass')}}" style="color: blue;">Lost Your Password?</a><br><br>
                                <button type="submit" class="site-btn">Login</button>
                                <a href="{{url('registration')}}" style="color: black;">Create An Account?</a><br><br>OR<br>
                            </form>
                            <a onclick="fbLogin()"><img src="{{asset('public/Assets')}}/img/fb.png" height="80"></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection
@section('script')
    <script>

        window.fbAsyncInit = function() {
            // FB JavaScript SDK configuration and setup
            FB.init({
                appId      : '782112546058045', // FB App ID
                cookie     : true,  // enable cookies to allow the server to access the session
                xfbml      : true,  // parse social plugins on this page
                version    : 'v10.0' // use graph api version 2.8
            });

            // Check whether the user already logged in
            FB.getLoginStatus(function(response) {
                if (response.status === 'connected') {
                    //display user data
                    getFbUserData();
                }
            });
        };

        // Load the JavaScript SDK asynchronously
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        // Facebook login with JavaScript SDK
        function fbLogin() {
            FB.login(function (response) {
                if (response.authResponse) {
                    // Get and display the user profile data
                    getFbUserData();
                } else {

                }
            }, {scope: 'email'});
        }

        // Fetch the user profile data from facebook
        function getFbUserData(){
            FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture'},
                    function (response) {
                        var name=response.first_name;
                        var lastname=response.last_name;
                        var email=response.email;
                        var fbid=response.id;
                        $.ajax({
                            url:"{{url('facebookwithlogin')}}",
                            method:"POST",
                            data:{_token:"{{csrf_token()}}",email:email,name:name},
                            success:function(result)
                            {
//                                console.log(result);
                                window.location.replace('/');
//                                if(result==0)
//                                {
//                                    window.location.replace('login');
//                                }
//                                else if(result==1)
//                                {
//                                    window.location.replace('/');
//                                }
                            }
                        });
                    });
        }
    </script>
@endsection