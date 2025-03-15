
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

    <style>
        /* Ensure the section covers the full viewport height */
        .appie-hero-area {
            height: 100vh; /* Full viewport height */
            width: 100%; /* Full width */
            display: flex;
            align-items: center; /* Vertically center content */
            justify-content: center; /* Horizontally center content */
            background-size: cover; /* Ensure background images cover the area */
            background-position: center; /* Center background images */
        }

        /* Ensure the container takes full width and height */
        .appie-hero-area .container {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center; /* Vertically center content */
        }

        /* Adjust the title for better responsiveness */
        .appie-title {
            font-size: 3rem; /* Adjust font size for larger screens */
            line-height: 1.2;
            margin-bottom: 20px;
        }

        /* Ensure images are responsive */
        .appie-hero-thumb-6 img {
            max-width: 100%; /* Make images responsive */
            height: auto; /* Maintain aspect ratio */
        }

        /* Media queries for smaller screens */
        @media (max-width: 768px) {
            .appie-title {
                font-size: 2rem; /* Smaller font size for mobile */
            }

            .appie-hero-area .row {
                flex-direction: column; /* Stack columns vertically on small screens */
                text-align: center; /* Center-align text */
            }

            .appie-hero-thumb-6 {
                margin-top: 20px; /* Add spacing between text and image */
            }
        }
    </style>

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
    
    <section class="appie-hero-area appie-hero-6-area appie-hero-7-area" style="height: 100vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="appie-hero-content appie-hero-content-6 appie-hero-content-7">
                    <h1 class="appie-title">Attendance Made Easier With <i>SwiftSign</i></h1>
                    <div class="info"></div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="appie-hero-thumb-6">
                    <div class="thumb wow animated fadeInUp text-center" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <img width="50%" src="{{asset('img/android.png')}}" alt="">
                        <div class="back-image">
                            <img src="{{asset('welcome/images/hero-shape-2.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
