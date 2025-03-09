
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SwiftSign - {{ Crypt::decryptString($employee->fullname) }}</title>

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

            <div class="profile-setting ">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">My profile</h4>
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
                        <div class="col-xxl-3 col-lg-4 col-sm-5">
                            <!-- Profile Acoount -->
                            <div class="card mb-25">
                                <div class="card-body text-center p-0">

                                    <div class="account-profile border-bottom pt-25 px-25 pb-0 flex-column d-flex align-items-center ">
                                        <div class="ap-img mb-20 pro_img_wrapper">
                                            <input id="file-upload" type="file" name="fileUpload" class="d-none">
                                            <label for="file-upload">
                                                <!-- Profile picture image-->
                                                <img class="ap-img__main rounded-circle wh-120" src="{{asset('img/author/profile.png')}}" alt="profile">
                                                <span class="cross" id="remove_pro_pic">
                                                    <span data-feather="camera"></span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="ap-nameAddress pb-3">
                                            <h5 class="ap-nameAddress__title">{{ $employee->fullname ? Crypt::decryptString($employee->fullname) : 'N/A' }}</h5>
                                            <p class="ap-nameAddress__subTitle fs-14 m-0">{{ $employee->position ? Crypt::decryptString($employee->position) : 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="ps-tab p-20 pb-25">
                                        <div class="nav flex-column text-left" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                                <span data-feather="user"></span>Edit profile</a>
                                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                                <span data-feather="settings"></span>Account
                                                setting</a>
                                            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                                <span data-feather="key"></span>change password</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- Profile Acoount End -->
                        </div>
                        <div class="col-xxl-9 col-lg-8 col-sm-7">
                            <div class="as-cover">
                                <div class="as-cover__imgWrapper">
                                    <input id="file-upload1" type="file" name="fileUpload" class="d-none">
                                    <label for="file-upload1">
                                        <img src="{{asset('img/ap-header.png')}}" alt="image" class="w-100">
                                        <span class="ap-cover__changeImgBtn">
                                            <span class="btn btn-outline-primary cover-btn">
                                                <span data-feather="camera"></span>Change
                                                Cover</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="mb-50">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade  show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                        <!-- Edit Profile -->
                                        <div class="edit-profile mt-25">
                                            <div class="card">
                                                <div class="card-header px-sm-25 px-3">
                                                    <div class="edit-profile__title">
                                                        <h6 id="profile-titlr">Edit Profile</h6>
                                                        <span class="fs-13 color-light fw-400">Set up your personal
                                                            information</span>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row justify-content-center">
                                                        <div class="col-xxl-6 col-lg-8 col-sm-10">
                                                            <div class="edit-profile__body mx-lg-20">
                                                                
                                                            <div id="status-message" class="alert d-none"></div> <!-- Success/Error Message Container -->
                                                            <form id="profile-form" method="post" enctype="multipart/form-data" data-id="{{ $employee->userID }}">
                                                                @csrf
                                                                <div class="form-group mb-20">
                                                                    <label for="names">Name</label>
                                                                    <input name="fullname" value="" type="text" class="form-control" id="names" autocomplete="off">
                                                                    <div class="text-danger error-fullname"></div>
                                                                </div>

                                                                <div class="form-group mb-20">
                                                                    <label for="phoneNumber1">Phone Number</label>
                                                                    <input name="phone" value="" type="text" class="form-control" id="phoneNumber1" autocomplete="off">
                                                                    <div class="text-danger error-phone"></div>
                                                                </div>

                                                                <div class="form-group mb-20">
                                                                    <label for="position">Position</label>
                                                                    <input name="position" value="" type="text" class="form-control" id="position" autocomplete="off">
                                                                    <div class="text-danger error-position"></div>
                                                                </div>

                                                                <div class="button-group d-flex flex-wrap pt-30 mb-15">
                                                                    <button type="submit" id="update-button" class="btn btn-primary btn-default btn-squared mr-15 text-capitalize">
                                                                        Update Profile
                                                                    </button>
                                                                    <a href="#" onclick="window.history.back();" class="btn btn-light btn-default btn-squared fw-400 text-capitalize">Cancel</a>
                                                                </div>
                                                            </form>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Edit Profile End -->
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                        <!-- Edit Profile -->
                                        <div class="edit-profile mt-25">
                                            <div class="card">
                                                <div class="card-header  px-sm-25 px-3">
                                                    <div class="edit-profile__title">
                                                        <h6>Account setting</h6>
                                                        <span class="fs-13 color-light fw-400">Update your username and manage your
                                                            account</span>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row justify-content-center">
                                                        <div class="col-xxl-6 col-lg-8 col-sm-10">
                                                            <div class="edit-profile__body mx-lg-20">
                                                                <form id="update-loginID-form" method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="form-group mb-20">
                                                                        <label for="name">username</label>
                                                                        <input value="" type="text" class="form-control" id="name" autocomplete="off">
                                                                    </div>
                                                                    <div class="form-group mb-1">
                                                                        <label for="email45">email</label>
                                                                        <input name="email" type="text" value="" autocomplete="off" class="form-control" id="email45">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="row justify-content-center align-items-center">
                                                        <div class="col-xxl-6 col-lg-8 col-sm-10">
                                                            <div class="d-flex justify-content-between mt-1 align-items-center flex-wrap">
                                                                <div class="text-capitalize py-10">
                                                                    <h6>close account</h6>
                                                                    <span class="fs-13 color-light fw-400">Delete your account and
                                                                        account
                                                                        data</span>
                                                                </div>
                                                                <div class="my-sm-0 my-10 py-10">

                                                                    <button class="btn btn-danger btn-default btn-squared fw-400 text-capitalize">close account
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="button-group d-flex flex-wrap pt-35 mb-35">



                                                                <button id="update-loginID-form" class="btn btn-primary btn-default btn-squared mr-15 text-capitalize">Save Changes
                                                                </button>








                                                                <button class="btn btn-light btn-default btn-squared fw-400 text-capitalize">cancel
                                                                </button>





                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Edit Profile End -->
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                        <!-- Edit Profile -->
                                        <div class="edit-profile mt-25">
                                            <div class="card">
                                                <div class="card-header  px-sm-25 px-3">
                                                    <div class="edit-profile__title">
                                                        <h6>change password</h6>
                                                        <span class="fs-13 color-light fw-400">Change or reset your account
                                                            password</span>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row justify-content-center">
                                                        <div class="col-xxl-6 col-lg-8 col-sm-10">
                                                            <div class="edit-profile__body mx-lg-20">
                                                                <form>
                                                                    <div class="form-group mb-20">
                                                                        <label for="name">old passowrd</label>
                                                                        <input type="text" class="form-control" id="name">
                                                                    </div>
                                                                    <div class="form-group mb-1">
                                                                        <label for="password-field">new password</label>
                                                                        <div class="position-relative">
                                                                            <input id="password-field" type="password" class="form-control pr-50" name="password" value="secret">
                                                                            <span class="fa fa-fw fa-eye-slash text-light fs-16 field-icon toggle-password2"></span>
                                                                        </div>
                                                                        <small id="passwordHelpInline" class="text-light fs-13">Minimum
                                                                            6
                                                                            characters
                                                                        </small>
                                                                    </div>
                                                                    <div class="button-group d-flex flex-wrap pt-45 mb-35">



                                                                        <button class="btn btn-primary btn-default btn-squared mr-15 text-capitalize">Save Changes
                                                                        </button>








                                                                        <button class="btn btn-light btn-default btn-squared fw-400 text-capitalize">cancel
                                                                        </button>





                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Edit Profile End -->
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).on("submit", "#profile-form", function (e) {
    e.preventDefault(); // Prevent full-page reload

    $(".text-danger").text(""); // Clear previous error messages
    $("#status-message").removeClass("alert-success alert-danger").addClass("d-none").text("");

    let form = $(this);
    let formData = new FormData(form[0]); 
    let id = form.data("id"); // Get user ID

    formData.append("_method", "PUT"); // Trick Laravel to accept PUT

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "/dashboard/employees/update/" + id, 
        type: "POST", // Use POST, but override it with `_method=PUT`
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            "Accept": "application/json"
        },
        beforeSend: function () {
            $("#update-button").attr("disabled", true).text("Updating...");
        },
        success: function (response) {
            $("#update-button").attr("disabled", false).text("Update Profile");
            $("#status-message")
                .removeClass("d-none alert-danger")
                .addClass("alert alert-success")
                .text(response.message)
                .fadeIn();
        },
        error: function (xhr) {
            $("#update-button").attr("disabled", false).text("Update Profile");
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                $.each(errors, function (key, value) {
                    $(".error-" + key).text(value[0]); 
                });
                $("#status-message")
                    .removeClass("d-none alert-success")
                    .addClass("alert alert-danger")
                    .text("Please fix the errors below.");
            } else {
                $("#status-message")
                    .removeClass("d-none alert-success")
                    .addClass("alert alert-danger")
                    .text("An unexpected error occurred. Please try again.");
            }
        }
    });
});
</script>

<script>
    $(document).ready(function () {
    let userID = $("#profile-form").data("id"); // Get user ID from form

    // Function to load employee data
    function loadEmployeeData() {
        $.ajax({
            url: "/dashboard/employees/get-employee/" + userID, // Fetch data from server
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.employees.length > 0) {
                    let employee = response.employees[0];

                    // Populate form fields
                    $("#names").val(employee.fullname);
                    $("#phoneNumber1").val(employee.phone);
                    $("#position").val(employee.position);
                }
            },
            error: function () {
                console.log("Failed to fetch employee data.");
            }
        });
    }

    // Load employee data on page load
    loadEmployeeData();

    setTimeout(loadEmployeeData, 1000);
    });
</script>


</body>

</html>