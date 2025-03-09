
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Swift Sign - Dashboard</title>

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

            <div class="crm">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-lg-12">

                            <div class="breadcrumb-main">
                                <!-- <h4 class="text-capitalize breadcrumb-title">CRM</h4> -->
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    
                                    <div class="dropdown action-btn">
                                        <button class="btn btn-sm btn-default btn-white dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="la la-download"></i> Export
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                            <span class="dropdown-item">Export With</span>
                                            <div class="dropdown-divider"></div>
                                            <a href="" class="dropdown-item">
                                                <i class="la la-print"></i> Printer</a>
                                            <a href="" class="dropdown-item">
                                                <i class="la la-file-pdf"></i> PDF</a>
                                            <a href="" class="dropdown-item">
                                                <i class="la la-file-text"></i> Google Sheets</a>
                                            <a href="" class="dropdown-item">
                                                <i class="la la-file-excel"></i> Excel (XLSX)</a>
                                            <a href="" class="dropdown-item">
                                                <i class="la la-file-csv"></i> CSV</a>
                                        </div>
                                    </div>
                                    <div class="dropdown action-btn">
                                        <button class="btn btn-sm btn-default btn-white dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="la la-share"></i> Share
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu3">
                                            <span class="dropdown-item">Share Link</span>
                                            <div class="dropdown-divider"></div>
                                            <a href="" class="dropdown-item">
                                                <i class="la la-facebook"></i> Facebook</a>
                                            <a href="" class="dropdown-item">
                                                <i class="la la-twitter"></i> Twitter</a>
                                            <a href="" class="dropdown-item">
                                                <i class="la la-google"></i> Google</a>
                                            <a href="" class="dropdown-item">
                                                <i class="la la-feed"></i> Feed</a>
                                            <a href="" class="dropdown-item">
                                                <i class="la la-instagram"></i> Instagram</a>
                                        </div>
                                    </div>
                                    <div class="action-btn">
                                        <a href="" class="btn btn-sm btn-primary btn-add">
                                            <i class="la la-plus"></i> Add New</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-xxl-3 col-sm-6  col-ssm-12 mb-30">
                            <!-- Card 2 End  -->
                            <div class="ap-po-details ap-po-details--2 p-25 radius-xl bg-white d-flex justify-content-between">
                                <div>





                                    <div class="overview-content">
                                        <h1>7,461</h1>
                                        <p>New Contact</p>
                                        <div class="ap-po-details-time">
                                            <span class="color-success"><i class="las la-arrow-up"></i>
                                                <strong>25%</strong></span>
                                            <small>Since last week</small>
                                        </div>
                                    </div>

                                </div>
                                <div class="ap-po-timeChart">
                                    <div class="overview-single__chart d-md-flex align-items-end">
                                        <div class="parentContainer">


                                            <div>
                                                <canvas id="mychart12"></canvas>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Card 2 End  -->
                        </div>
                        <div class="col-xxl-3 col-sm-6  col-ssm-12 mb-30">
                            <!-- Card 1 -->
                            <div class="ap-po-details ap-po-details--2 p-25 radius-xl bg-white d-flex justify-content-between">
                                <div>





                                    <div class="overview-content">
                                        <h1>3,254</h1>
                                        <p>New Deals</p>
                                        <div class="ap-po-details-time">
                                            <span class="color-success"><i class="las la-arrow-up"></i>
                                                <strong>25%</strong></span>
                                            <small>Since last week</small>
                                        </div>
                                    </div>

                                </div>
                                <div class="ap-po-timeChart">
                                    <div class="overview-single__chart d-md-flex align-items-end">
                                        <div class="parentContainer">


                                            <div>
                                                <canvas id="mychart13"></canvas>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Card 1 End -->
                        </div>
                        <div class="col-xxl-3 col-sm-6  col-ssm-12 mb-30">
                            <!-- Card 3 -->
                            <div class="ap-po-details ap-po-details--2 p-25 radius-xl bg-white d-flex justify-content-between">
                                <div>





                                    <div class="overview-content">
                                        <h1>541</h1>
                                        <p>New Leads</p>
                                        <div class="ap-po-details-time">
                                            <span class="color-danger"><i class="las la-arrow-down"></i>
                                                <strong>8.2%</strong></span>
                                            <small>Since last week</small>
                                        </div>
                                    </div>

                                </div>
                                <div class="ap-po-timeChart">
                                    <div class="overview-single__chart d-md-flex align-items-end">
                                        <div class="parentContainer">


                                            <div>
                                                <canvas id="mychart14"></canvas>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Card 3 End -->
                        </div>
                        <div class="col-xxl-3 col-sm-6  col-ssm-12 mb-30">
                            <!-- Card 1 -->
                            <div class="ap-po-details ap-po-details--2 p-25 radius-xl bg-white d-flex justify-content-between">
                                <div>
                                    <div class="overview-content">
                                        <h1>$45.2k</h1>
                                        <p>Revenue</p>
                                        <div class="ap-po-details-time">
                                            <span class="color-success"><i class="las la-arrow-up"></i>
                                                <strong>12.3%</strong></span>
                                            <small>Since last week</small>
                                        </div>
                                    </div>

                                </div>
                                <div class="ap-po-timeChart">
                                    <div class="overview-single__chart d-md-flex align-items-end">
                                        <div class="parentContainer">
                                            <div>
                                                <canvas id="mychart15"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Card 1 End -->
                        </div>

                    </div>
                    <!-- ends: .row -->
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