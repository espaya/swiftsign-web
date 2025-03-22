
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SwiftSign - Team</title>
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
                <div class="row">
                    <div class="col-lg-12">

                        <div class="breadcrumb-main">
                            <h4 class="text-capitalize breadcrumb-title">Our Team</h4>
                        </div>

                    </div>
                </div>
                
                <div class="bg-white pt-50 pb-40 mb-30 px-xxl-0 px-30 shadow-lg rounded-xl">
                    <div role="tabpanel">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 text-center">
                                    <p class="yearly space-nowrap">This software was designed & developed by this amazing team</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="monthly">
                                <div class="row justify-content-center">
                                    <div class="col-xxl-3 col-lg-4 col-sm-6 mb-30">
                                        <div class="card h-100">
                                            <div class="card-body p-30">
                                                <div class="pricing d-flex align-items-center">
                                                    <span class=" pricing__tag color-dark order-bg-opacity-dark rounded-pill ">Developer</span>
                                                </div>
                                                <div class="pricing__price rounded">
                                                    <img height="200" src="{{ asset('img/Sample_User_Icon.png') }}" alt="">
                                                </div>
                                                <div class="pricing__price rounded">
                                                    <p style="font-size: 23px !important;" class="pricing_value display-3 color-dark d-flex align-items-center text-capitalize fw-600 mb-1">
                                                        Stephen Owusu <br>Boakye Yiadom
                                                    </p>
                                                    <p class="pricing_subtitle mb-0">ID: 13025520</p>
                                                </div>
                                            </div>
                                        </div><!-- End: .card -->
                                    </div><!-- End: .col -->
                                    <div class="col-xxl-3 col-lg-4 col-sm-6 mb-30">
                                        <div class="card h-100">
                                            <div class="card-body p-30">
                                                <div class="pricing d-flex align-items-center">
                                                    <span class=" pricing__tag color-primary order-bg-opacity-primary rounded-pill ">UI/UX</span>
                                                </div>

                                                <div class="pricing__price rounded">
                                                    <img height="200" src="{{ asset('img/Sample_User_Icon.png') }}" alt="">
                                                </div>
                                                <div class="pricing__price rounded">
                                                    <p style="font-size: 23px !important;" class="pricing_value display-3 color-dark d-flex align-items-center text-capitalize fw-600 mb-1">
                                                        Sampson Adjei <br>Amponsah
                                                    </p>
                                                    <p class="pricing_subtitle mb-0">ID: --------</p>
                                                </div>
                                            </div>
                                        </div><!-- End: .card -->
                                    </div><!-- End: .col -->
                                    <div class="col-xxl-3 col-lg-4 col-sm-6 mb-30">
                                        <div class="card h-100">
                                            <div class="card-body p-30">
                                                <div class="pricing d-flex align-items-center">

                                                    <span class=" pricing__tag color-secondary order-bg-opacity-secondary rounded-pill ">Documentation</span>

                                                </div>
                                                
                                                <div class="pricing__price rounded">
                                                    <img height="200" src="{{ asset('img/Sample_User_Icon.png') }}" alt="">
                                                </div>
                                                <div class="pricing__price rounded">
                                                    <p style="font-size: 23px !important;" class="pricing_value display-3 color-dark d-flex align-items-center text-capitalize fw-600 mb-1">
                                                        Sampson Adjei <br>Amponsah
                                                    </p>
                                                    <p class="pricing_subtitle mb-0">ID: --------</p>
                                                </div>
                                                
                                            </div>
                                        </div><!-- End: .card -->
                                    </div><!-- End: .col -->
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="yearly">
                                <div class="row justify-content-center">
                                    <div class="col-xxl-3 col-lg-4 col-sm-6 mb-30">
                                        <div class="card h-100">
                                            <div class="card-body p-30">
                                                <div class="pricing d-flex align-items-center">

                                                    <span class=" pricing__tag color-dark order-bg-opacity-dark rounded-pill ">Free Forever</span>


                                                </div>
                                                <div class="pricing__price rounded">
                                                    <p class="pricing_value display-3 color-dark d-flex align-items-center text-capitalize fw-600 mb-1">
                                                        free
                                                    </p>
                                                    <p class="pricing_subtitle mb-0">For Individuals</p>
                                                </div>
                                                <div class="pricing__features">
                                                    <ul>
                                                        <li>
                                                            <span class="fa fa-check"></span>100MB file space
                                                        </li>

                                                        <li>
                                                            <span class="fa fa-check"></span>2 active projects
                                                        </li>
                                                        <li>
                                                            <span class="fa fa-check"></span>Limited boards
                                                        </li>
                                                        <li>
                                                            <span class="fa fa-check"></span>Basic project management
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="price_action d-flex pb-30 pl-30">




                                                <button class="btn btn-default btn-squared btn-outline-light text-capitalize px-30  color-gray fw-500">Current Plan
                                                </button>




                                            </div>
                                        </div><!-- End: .card -->
                                    </div><!-- End: .col -->
                                    <div class="col-xxl-3 col-lg-4 col-sm-6 mb-30">
                                        <div class="card h-100">
                                            <div class="card-body p-30">
                                                <div class="pricing d-flex align-items-center">

                                                    <span class=" pricing__tag color-primary order-bg-opacity-primary rounded-pill ">Professional</span>

                                                    <span class="pricing__badge bg-danger">-40%</span>


                                                </div>
                                                <div class="pricing__price rounded">

                                                    <p class="pricing_value display-3 color-dark d-flex align-items-center text-capitalize fw-600 mb-1">

                                                        <span class="pricing_offer strikethrough">$35</span>

                                                        <sup>$</sup>21
                                                        <small class="pricing_user">Per month</small>
                                                    </p>
                                                    <p class="pricing_subtitle mb-0">For 2 Users</p>

                                                </div>
                                                <div class="pricing__features">
                                                    <ul>
                                                        <li>
                                                            <span class="fa fa-check"></span>500GB+ file space
                                                        </li>
                                                        <li>
                                                            <span class="fa fa-check"></span>Limited boards
                                                        </li>
                                                        <li>
                                                            <span class="fa fa-check"></span>Basic project management
                                                        </li>
                                                        <li>
                                                            <span class="fa fa-check"></span>Custom Post Types
                                                        </li>
                                                        <li>
                                                            <span class="fa fa-check"></span>Custom Post Types
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="price_action d-flex pb-30 pl-30">



                                                <button class="btn btn-primary btn-default btn-squared text-capitalize px-30">Get Started
                                                </button>





                                            </div>
                                        </div><!-- End: .card -->
                                    </div><!-- End: .col -->
                                    <div class="modal-info-warning modal fade" id="modal-info-warning" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm modal-info" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="modal-info-body d-flex">
                                        <div class="modal-info-icon warning">
                                            <span data-feather="info"></span>
                                        </div>
                                        <div class="modal-info-text">
                                            <p id="modal-message">Some contents...</p> <!-- Dynamic message will go here -->
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ends: .modal-info-warning -->
                                    <div class="col-xxl-3 col-lg-4 col-sm-6 mb-30">
                                        <div class="card h-100">
                                            <div class="card-body p-30">
                                                <div class="pricing d-flex align-items-center">

                                                    <span class=" pricing__tag color-secondary order-bg-opacity-secondary rounded-pill ">Business</span>

                                                    <span class="pricing__badge bg-danger">-40%</span>


                                                </div>
                                                <div class="pricing__price rounded">

                                                    <p class="pricing_value display-3 color-dark d-flex align-items-center text-capitalize fw-600 mb-1">

                                                        <span class="pricing_offer strikethrough">$35</span>

                                                        <sup>$</sup>59
                                                        <small class="pricing_user">Per month</small>
                                                    </p>
                                                    <p class="pricing_subtitle mb-0">For 10 Users</p>

                                                </div>
                                                <div class="pricing__features">
                                                    <ul>
                                                        <li>
                                                            <span class="fa fa-check"></span>500GB+ file space
                                                        </li>
                                                        <li>
                                                            <span class="fa fa-check"></span>Unlimited projects
                                                        </li>
                                                        <li>
                                                            <span class="fa fa-check"></span>Unlimited boards
                                                        </li>
                                                        <li>
                                                            <span class="fa fa-check"></span>Basic project management
                                                        </li>
                                                        <li>
                                                            <span class="fa fa-check"></span>Custom Post Types
                                                        </li>
                                                        <li>
                                                            <span class="fa fa-check"></span>Subtasks
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="price_action d-flex pb-30 pl-30">



                                                <button class="btn btn-secondary btn-default btn-squared text-capitalize px-30">Get Started
                                                </button>





                                            </div>
                                        </div><!-- End: .card -->
                                    </div><!-- End: .col -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End: .bg-white -->
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
    <!-- Hidden audio element for notification sound -->
    <audio style="display: none;" id="notification-sound" src="{{ asset('sounds/notification.mp3') }}" preload="auto"></audio>


    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDduF2tLXicDEPDMAtC6-NLOekX0A5vlnY"></script>
    <!-- inject:js-->
    
    <script src="{{asset('js/plugins.min.js')}}"></script>
    <script src="{{asset('js/script.min.js')}}"></script>
    <script src="{{ asset('js/notification.js') }}" ></script>
    <script>
    $(document).ready(function () {
        $('#logout-link').click(function (e) {
            e.preventDefault(); // Prevent default link behavior

            $.ajax({
                url: '/logout',  // Your logout route
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')  // CSRF token for Laravel
                },
                success: function (response) {
                    if (response.success) {
                        window.location.href = response.redirect || '/login';  // Redirect to login page
                    } else {
                        // Update modal content and show it
                        $('#modal-message').text(response.message || "Logout failed.");
                        $('#modal-info-warning').modal('show');
                    }
                },
                error: function (xhr) {
                    // Update modal content and show it for errors
                    $('#modal-message').text("An error occurred. Please try again.");
                    $('#modal-info-warning').modal('show');
                }
            });
        });
    });
</script>
    <!-- endinject-->
</body>

</html>