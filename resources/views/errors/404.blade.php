
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SwiftSign - 404 Not Found</title>
    <link href="../../../../css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- inject:css-->
    <link rel="stylesheet" href="{{asset('css/plugin.min.css')}}">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <!-- endinject -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('SwiftSign Web.png')}}">
</head>

<body class="layout-light side-menu overlayScroll">
    <div class="mobile-search">
        <form class="search-form">
            <span data-feather="search"></span>
            <input class="form-control mr-sm-2 box-shadow-none" type="text" placeholder="Search...">
        </form>
    </div>

    <div class="mobile-author-actions"></div>
    @include('templates/header')
    <main class="main-content">

        @include('templates/sidebar')

        <div class="contents">

            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <!-- Start: error page -->
                        <div class="min-vh-100 content-center">
                            <div class="error-page text-center">
                                <img src="{{asset('img/svg/404.svg')}}" alt="404" class="svg">
                                <div class="error-page__title">404</div>
                                <h5 class="fw-500">Sorry! the page you are looking for doesn't exist.</h5>
                                <div class="content-center mt-30">
                                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-default btn-squared px-30">Return Home</a>
                                </div>
                            </div>
                        </div>
                        <!-- End: error page -->
                    </div>
                </div>
            </div>

        </div>

        @include('templates/footer')
    </main>
    <div id="overlayer">
        <span class="loader-overlay">
            <div class="atbd-spin-dots spin-lg">
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
            </div>
        </span>
    </div>
    <div class="overlay-dark-sidebar"></div>
    <div class="customizer-overlay"></div>


    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDduF2tLXicDEPDMAtC6-NLOekX0A5vlnY"></script>
    <!-- inject:js-->
    <script src="{{asset('js/plugins.min.js')}}"></script>
    <script src="{{asset('js/script.min.js')}}"></script>
    <!-- endinject-->
</body>

</html>