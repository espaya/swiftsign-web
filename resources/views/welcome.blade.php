
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>   
    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--====== Title ======-->
    <title>SwiftSign - Welcome</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{asset('SwiftSign Web.png')}}" type="image/png">
    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="{{asset('welcome/css/bootstrap.min.css')}}">
    <!--====== Fontawesome css ======-->
    <link rel="stylesheet" href="{{asset('welcome/css/font-awesome.min.css')}}">
    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="{{asset('welcome/css/animate.min.css')}}">
    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="{{asset('welcome/css/magnific-popup.css')}}">
    <!--====== Slick css ======-->
    <link rel="stylesheet" href="{{asset('welcome/css/slick.css')}}">
    <!--====== Default css ======-->
    <link rel="stylesheet" href="{{asset('welcome/css/custom-animation.css')}}">
    <link rel="stylesheet" href="{{asset('welcome/css/default.css')}}">
    <!--====== Style css ======-->
    <link rel="stylesheet" href="{{asset('welcome/css/style.css')}}">
</head>

<body>    

    <header class="appie-header-area appie-header-7-area appie-sticky">
        <div class="container">
            <div class="header-nav-box header-nav-box-7">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-4 col-sm-5 col-6 order-1 order-sm-1">
                        <div class="appie-logo-box">
                            <a href="{{ url('/') }}">
                                <img src="{{asset('SwiftSign Web.png')}}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-1 col-sm-1 order-3 order-sm-2">
                        <div class="appie-header-main-menu"></div>
                    </div>
                    @if(Route::has('login'))
                    <div class="col-lg-4  col-md-7 col-sm-6 col-6 order-2 order-sm-3">
                        <div class="appie-btn-box text-right">
                        @auth
                            <a class="main-btn ml-30" href="{{ route('dashboard') }}"><i class="fal fa-user"></i> Dashboard</a>
                        @else
                            <a class="login-btn" href="{{ route('login') }}"><i class="fal fa-user"></i> Login</a>
                        @endauth
                            <div class="toggle-btn ml-30 canvas_open d-lg-none d-block">
                                <i class="fa fa-bars"></i>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </header>
    <!--====== APPIE HERO PART START ======-->
    
    <section class="appie-hero-area appie-hero-6-area appie-hero-7-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="appie-hero-content appie-hero-content-6 appie-hero-content-7">
                        <h1 class="appie-title">Creative way to Showcase your app </h1>
                        <p>Lost the plot so I said nancy boy I don't want no agro bleeder bum bag easy peasy cheesed off cheers ruddy.</p>
                        <div class="info"></div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="appie-hero-thumb-6">
                        <div class="thumb wow animated fadeInUp text-center" data-wow-duration="1000ms" data-wow-delay="600ms">
                            <img src="{{asset('welcome/images/hero-thumb-8.png')}}" alt="">
                            <div class="back-image">
                                <img src="{{asset('welcome/images/hero-shape-2.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>    
    <!--====== APPIE HERO PART ENDS ======-->

    <!--====== jquery js ======-->
    <script src="{{asset('welcome/js/vendor/modernizr-3.6.0.min.js')}}"></script>
    <script src="{{asset('welcome/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <!--====== Bootstrap js ======-->
    <script src="{{asset('welcome/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('welcome/js/popper.min.js')}}"></script>
    <!--====== wow js ======-->
    <script src="{{asset('welcome/js/wow.js')}}"></script>
    <!--====== Slick js ======-->
    <script src="{{asset('welcome/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('welcome/js/waypoints.min.js')}}"></script>
    <!--====== TweenMax js ======-->
    <script src="{{asset('welcome/js/TweenMax.min.js')}}"></script>
    <!--====== Slick js ======-->
    <script src="{{asset('welcome/js/slick.min.js')}}"></script>
    <!--====== Magnific Popup js ======-->
    <script src="{{asset('welcome/js/jquery.magnific-popup.min.js')}}"></script>
    <!--====== Main js ======-->
    <script src="{{asset('welcome/js/main.js')}}"></script>

</body>

</html>
