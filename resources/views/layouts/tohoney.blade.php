
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        @yield('title')
    </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('tohoney_assets') }}/images/favicon.png">
    <!-- Place favicon.ico in the root directory -->
    <!-- all css here -->
    <!-- bootstrap v4.0.0-beta.2 css -->
    <link rel="stylesheet" href="{{ asset('tohoney_assets/css/bootstrap.min.css') }}">
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <link rel="stylesheet" href="{{ asset('tohoney_assets/css/owl.carousel.min.css') }}">
    <!-- font-awesome v4.6.3 css -->
    <link rel="stylesheet" href="{{ asset('tohoney_assets/css/font-awesome.min.css') }}">
    <!-- flaticon.css -->
    <link rel="stylesheet" href="{{ asset('tohoney_assets/css/flaticon.css') }}">
    <!-- jquery-ui.css -->
    <link rel="stylesheet" href="{{ asset('tohoney_assets/css/jquery-ui.css') }}">
    <!-- metisMenu.min.css -->
    <link rel="stylesheet" href="{{ asset('tohoney_assets/css/metisMenu.min.css') }}">
    <!-- swiper.min.css -->
    <link rel="stylesheet" href="{{ asset('tohoney_assets/css/swiper.min.css') }}">
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('tohoney_assets/css/styles.css') }}">
    <!-- responsive css -->
    <link rel="stylesheet" href="{{ asset('tohoney_assets/css/responsive.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- modernizr css -->
    <script src="{{ asset('tohoney_assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>

<body>
    <!--Start Preloader-->
    {{-- <div class="preloader-wrap">
        <div class="spinner"></div>
    </div> --}}
    <!-- search-form here -->
    <div class="search-area flex-style">
        <span class="closebar">Close</span>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 col-12">
                    <div class="search-form">
                        <form action="{{ url('search') }}">
                            <input type="text" name="s" placeholder="Search Here...">
                            <button><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- search-form here -->
    <!-- header-area start -->
    <header class="header-area">
        <div class="header-top bg-2">
            <div class="fluid-container">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <ul class="d-flex header-contact">
                            @if (App\Models\Setting::where('setting_name','Phone')->first()->setting_value )
                            <li><i class="fa fa-phone"></i> 
                                {{ App\Models\Setting::where('setting_name','Phone')->first()->setting_value }}
                             </li>
                            @endif
                            <li><i class="fa fa-envelope"></i> 
                                {{ App\Models\Setting::where('setting_name','Email ')->first()->setting_value }}
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-12">
                        <ul class="d-flex account_login-area">

                            @auth
                            <li>
                                <a href="javascript:void(0);"><i class="fa fa-user"></i> {{ Auth::user()->name }}<i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown_style">
                                    <li><a href="{{ route('home') }}">Dashbord</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"><i class="icon ion-power"></i> Log Out</a>
                                         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @else
                            <li><a href="{{ route('customer_login') }}"> Login/Register </a></li>
                            @endauth
                        
                        </ul>
                    </div> 
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="fluid-container">
                <div class="row">
                    <div class="col-lg-3 col-md-7 col-sm-6 col-6">
                        <div class="logo">
                            <a href="{{ route('tohoney_home') }}">                  
                                <img src="{{ asset('tohoney_assets') }}/images/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 d-none d-lg-block">
                        <nav class="mainmenu">
                            <ul class="d-flex">
                                <li class="active"><a href="{{ route('tohoney_home') }}">Home</a></li>
                                <li><a href="{{ route('tohoney_about') }}">About</a></li>
                                <li><a href="{{ route('shop') }}">Shop</a></li>
                                <li><a href="{{ route('tohoney_contact') }}">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-4 col-lg-2 col-sm-5 col-4">
                        <ul class="search-cart-wrapper d-flex">
                            <li class="search-tigger"><a href="javascript:void(0);"><i class="flaticon-search"></i></a></li>
                            {{-- <li>
                                <a href="javascript:void(0);"><i class="flaticon-like"></i> <span>{{ App\Models\Cart::where('ip_address',request()->ip())->count() }}</span></a>
                                <ul class="cart-wrap dropdown_style">
                                    @php
                                       $carts = App\Models\Cart::where('ip_address',request()->ip())->get();
                                       $subtotal = 0;
                                   @endphp
                                    @foreach ($carts as $cart)
                                    <li class="cart-items">
                                        <div class="cart-img">
                                            <img src="{{ asset('photo') }}/product/{{  App\Models\Product::find($cart->product_id)->product_photo }}" alt="" width="50">
                                        </div>
                                        <div class="cart-content">
                                            <a href="{{ url('product/details')}}/{{ $cart->product_id }} "> {{  App\Models\Product::find($cart->product_id)->product_name }}</a>
                                            <span>QTY : {{ $cart->quantity }}</span>
                                            <p>${{  App\Models\Product::find($cart->product_id)->product_price * $cart->quantity }}</p>
                                            <i class="fa fa-times"></i>
                                            @php
                                                $subtotal += App\Models\Product::find($cart->product_id)->product_price * $cart->quantity
                                            @endphp
                                        </div>
                                    </li>
                                    @endforeach
                                    <li>Subtotol: <span class="pull-right">${{ $subtotal }}</span></li>
                                    <li>
                                        <a href="{{ route('checkout') }}" class="btn btn-info">Check Out</a>
                                    </li>
                                </ul>
                            </li> --}}


                            <li>
                                <a href="javascript:void(0);"><i class="flaticon-shop"></i> <span>{{ App\Models\Cart::where('ip_address',request()->ip())->count() }}</span></a>
                                <ul class="cart-wrap dropdown_style">
                                    @php
                                       $carts = App\Models\Cart::where('ip_address',request()->ip())->get();
                                       $subtotal = 0;
                                   @endphp
                                    @foreach ($carts as $cart)
                                    <li class="cart-items">
                                        <div class="cart-img">
                                            
                                            <img src="{{ asset('photo') }}/product/{{  App\Models\Product::find($cart->product_id)->product_photo }}" alt="" width="50">
                                        </div>
                                        <div class="cart-content">
                                            <a href="{{ url('product/details')}}/{{ $cart->product_id }}">
                                                {{  App\Models\Product::find($cart->product_id)->product_name }}
                                            </a>
                                            <span>QTY : {{ $cart->quantity }}</span>
                                            <p>${{  App\Models\Product::find($cart->product_id)->product_price * $cart->quantity}}</p>
                                            @php
                                                $subtotal += App\Models\Product::find($cart->product_id)->product_price * $cart->quantity
                                            @endphp
                                            <a href="{{ url('cart/delete') }}/{{ $cart->id }}">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </li>
                                    @endforeach
                                    
                                    
                                    <li>Subtotol: <span class="pull-right">{{ $subtotal }}</span></li>
                                    <li>
                                        <a href="{{ route('cart') }} " class="btn btn-danger">Cart</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-1 col-sm-1 col-2 d-block d-lg-none">
                        <div class="responsive-menu-tigger">
                            <a href="javascript:void(0);">
                        <span class="first"></span>
                        <span class="second"></span>
                        <span class="third"></span>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- responsive-menu area start -->
            <div class="responsive-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-block d-lg-none">
                            <ul class="metismenu">
                                <li class="active"><a href="{{ route('tohoney_home') }}">Home</a></li>
                                <li><a href="{{ route('tohoney_about') }}">About</a></li>
                                <li><a href="{{ route('shop') }}">Shop</a></li>
                                <li><a href="{{ route('tohoney_contact') }}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- responsive-menu area start -->
        </div>
    </header>
    <!-- header-area end -->

    @yield('body')

      <!-- start social-newsletter-section -->
      {{-- <section class="social-newsletter-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="newsletter text-center">
                        <h3>Subscribe  Newsletter</h3>
                        <div class="newsletter-form">
                            <form>
                                <input type="text" class="form-control" placeholder="Enter Your Email Address...">
                                <button type="submit"><i class="fa fa-send"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end container -->
    </section> --}}
    <!-- end social-newsletter-section -->
    <!-- .footer-area start -->
    <div class="footer-area">
        <div class="footer-top">
            <div class="container">
                <div class="footer-top-item">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="footer-top-text text-center">
                                <ul>
                                    <li><a href="{{  route('tohoney_home') }}">home</a></li>
                                    <li><a href="{{ route('tohoney_about') }}">About</a></li>
                                    <li><a href="{{ route('shop') }}">Shop</a></li>
                                    <li><a href="{{ route('tohoney_contact') }}">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-12">
                        <div class="footer-icon">
                            <ul class="d-flex">
                                <li><a href="https://www.facebook.com/nazrul.islam.safa/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://github.com/nazrul-safa" target="_blank"><i class="fa fa-github"></i></a></li>
                                <li><a href="https://www.linkedin.com/in/nazrul-islam-safa-7450a2102/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8 col-sm-12">
                        <div class="footer-content">
                            <p> {{ App\Models\Setting::where('setting_name','footer_des')->first()->setting_value }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-8 col-sm-12">
                        <div class="footer-adress">
                            <ul>
                                <li><a href="#"><span>Email:</span> {{ App\Models\Setting::where('setting_name','email')->first()->setting_value }}</a></li>
                                <li><a href="#"><span>Tel:</span> {{ App\Models\Setting::where('setting_name','telephone')->first()->setting_value }}</a></li>
                                <li><a href="#"><span>Adress:</span>  {{ App\Models\Setting::where('setting_name','Address')->first()->setting_value }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <div class="footer-reserved">
                            <ul>
                                <li>Copyright © {{ date('Y') }} All rights reserved.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .footer-area end -->
      
    <!-- jquery latest version -->
   
    <script src="{{ asset('tohoney_assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('tohoney_assets/js/bootstrap.min.js') }}"></script>
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <script src="{{ asset('tohoney_assets/js/owl.carousel.min.js') }}"></script>
    <!-- scrollup.js -->
    <script src="{{ asset('tohoney_assets/js/scrollup.js') }}"></script>
    <!-- isotope.pkgd.min.js -->
    <script src="{{ asset('tohoney_assets/js/isotope.pkgd.min.js') }}"></script>
    <!-- imagesloaded.pkgd.min.js -->
    <script src="{{ asset('tohoney_assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <!-- jquery.zoom.min.js -->
    <script src="{{ asset('tohoney_assets/js/jquery.zoom.min.js') }}"></script>
    <!-- countdown.js -->
    <script src="{{ asset('tohoney_assets/js/countdown.js') }}"></script>
    <!-- swiper.min.js -->
    <script src="{{ asset('tohoney_assets/js/swiper.min.js') }}"></script>
    <!-- metisMenu.min.js -->
    <script src="{{ asset('tohoney_assets/js/metisMenu.min.js') }}"></script>
    <!-- mailchimp.js -->
    <script src="{{ asset('tohoney_assets/js/mailchimp.js') }}"></script>
    <!-- jquery-ui.min.js -->
    <script src="{{ asset('tohoney_assets/js/jquery-ui.min.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('tohoney_assets/js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @yield('footer_scripts')
</body>


<!-- Mirrored from themepresss.com/tf/html/tohoney/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 13 Mar 2020 03:33:34 GMT -->
</html>
