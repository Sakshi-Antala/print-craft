<hr>
<footer class="footer noprint">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-7">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="{{url('/')}}"><img src="{{asset('public/Assets')}}/img/demo5.png" alt=""></a>
                    </div>
                    <p>Vistaprint Is Best Priting Website.We Provide Diffrent Design And Also Allow Our
                    Customers To Upload Their Custom Designs.</p>
                    {{--<div class="footer__payment">--}}
                        {{--<a href="#"><img src="{{asset('public/Assets')}}/img/payment/payment-1.png" alt=""></a>--}}
                        {{--<a href="#"><img src="{{asset('public/Assets')}}/img/payment/payment-2.png" alt=""></a>--}}
                        {{--<a href="#"><img src="{{asset('public/Assets')}}/img/payment/payment-3.png" alt=""></a>--}}
                        {{--<a href="#"><img src="{{asset('public/Assets')}}/img/payment/payment-4.png" alt=""></a>--}}
                        {{--<a href="#"><img src="{{asset('public/Assets')}}/img/payment/payment-5.png" alt=""></a>--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-5">
                <div class="footer__widget">
                    <h6>Quick links</h6>
                    <ul>
                        <li><a href="{{url('')}}">Home</a></li>
                        <li><a href="{{url('shop')}}">Shop</a></li>
                        <li><a href="{{url('contact')}}">Contact Us</a></li>
                        {{--<li><a href="#">FAQ</a></li>--}}
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="footer__widget">
                    <h6>Account</h6>
                    <ul>
                        <li><a href="{{url('profile')}}">My Account</a></li>
                        <li><a href="{{url('myorder')}}">My Orders</a></li>
                        <li><a href="{{url('checkout')}}">Checkout</a></li>
                        <li><a href="{{url('displaywishlist')}}">Wishlist</a></li>
                    </ul>

                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-8">
                <div class="footer__newslatter">
                    <h6>NEWSLETTER</h6>
                    <form action="{{url('subcribe')}}" method="post">
                        @csrf
                        <input type="text" placeholder="Email" name="email">
                        <button type="submit" class="site-btn">Subscribe</button>
                    </form>
                    <span style="color: red;">{{session()->get('msg')}}</span>
                    {{--<div class="footer__social">--}}
                        {{--<a href="#"><i class="fa fa-facebook"></i></a>--}}
                        {{--<a href="#"><i class="fa fa-twitter"></i></a>--}}
                        {{--<a href="#"><i class="fa fa-youtube-play"></i></a>--}}
                        {{--<a href="#"><i class="fa fa-instagram"></i></a>--}}
                        {{--<a href="#"><i class="fa fa-pinterest"></i></a>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                <div class="footer__copyright__text">
                    <p>Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | <a href="{{url('')}}" target="_blank">Vistaprint</a></p>
                </div>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Search Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form" method="post" action="{{url('search')}}">
            @csrf
            <input type="text" id="search-input" placeholder="Search Product....." name="pname">
            <button type="submit" class="site-btn">Search</button>
        </form>
    </div>
</div>
<!-- Search End -->

<!-- Js Plugins -->
<script src="{{asset('public/Assets')}}/js/jquery-3.3.1.min.js"></script>
<script src="{{asset('public/Assets')}}/js/bootstrap.min.js"></script>
<script src="{{asset('public/Assets')}}/js/jquery.magnific-popup.min.js"></script>
<script src="{{asset('public/Assets')}}/js/jquery-ui.min.js"></script>
<script src="{{asset('public/Assets')}}/js/mixitup.min.js"></script>
<script src="{{asset('public/Assets')}}/js/jquery.countdown.min.js"></script>
<script src="{{asset('public/Assets')}}/js/jquery.slicknav.js"></script>
<script src="{{asset('public/Assets')}}/js/owl.carousel.min.js"></script>
<script src="{{asset('public/Assets')}}/js/jquery.nicescroll.min.js"></script>
<script src="{{asset('public/Assets')}}/js/main.js"></script>
</body>

</html>