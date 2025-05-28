<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SwiftSign - {{ $employee && $employee->fullname ? Crypt::decryptString($employee->fullname) : 'Employees' }}</title>
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
                                <h4 class="text-capitalize breadcrumb-title">Employee profile</h4>

                                <div class="action-btn">
                                    <a onclick="window.history.back();" href="#" class="btn px-15 btn-primary">
                                        <i class="las la-arrow-left"></i>Go Back
                                    </a>
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
                                                <img class="ap-img__main rounded-circle wh-120" src="{{asset('img/Sample_User_Icon.png')}}" alt="profile">
                                                <span class="cross" id="remove_pro_pic">
                                                    <span data-feather="camera"></span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="ap-nameAddress pb-3">
                                            <h5 class="ap-nameAddress__title">{{ $employee && $employee->fullname ? Crypt::decryptString($employee->fullname) : 'N/A' }}</h5>
                                            <p class="ap-nameAddress__subTitle fs-14 m-0">{{ $employee && $employee->position ? Crypt::decryptString($employee->position) : 'N/A' }}</p>
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
                                            <a class="nav-link" id="v-pills-attendance-tab" data-toggle="pill" href="#v-pills-attendance" role="tab" aria-controls="v-pills-attendance" aria-selected="false">
                                                <span data-feather="calendar"></span>Attendance Log</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Profile Acoount End -->
                        </div>
                        <div class="col-xxl-9 col-lg-8 col-sm-7">
                            <div class="mb-50">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade  show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                        <!-- Edit Profile -->
                                        <div class="edit-profile ">
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
                                                                <div id="status-message" class="alert d-none"></div>
                                                                <!-- Success/Error Message Container -->
                                                                <form id="profile-form" method="post" enctype="multipart/form-data" data-id="{{ $employee ? $employee->userID : '' }}">
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
                                        <div class="edit-profile ">
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
                                                                <div id="response-message" class="alert d-none"></div>
                                                                <!-- status message -->
                                                                <form id="update-loginID-form" method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="form-group mb-20">
                                                                        <label for="name">username</label>
                                                                        <input name="name" value="" type="text" class="form-control" id="name" autocomplete="off">
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
                                                                    <h6>block account</h6>
                                                                    <span class="fs-13 color-light fw-400">Block this employee from accessing the system</span>
                                                                </div>
                                                                <div class="my-sm-0 my-10 py-10">
                                                                    <form id="block-form" method="post">
                                                                        @csrf
                                                                        <button class="btn btn-warning btn-default btn-squared fw-400 text-capitalize" id="block-btn" data-user-id="3">
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="button-group d-flex flex-wrap pt-35 mb-35">
                                                                <button id="submit-loginID" class="btn btn-primary btn-default btn-squared mr-15 text-capitalize">Save Changes
                                                                </button>
                                                                <button onclick="window.history.back();" class="btn btn-light btn-default btn-squared fw-400 text-capitalize">cancel
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Edit Profile End -->
                                    </div>


                                    <div class="tab-pane fade" id="v-pills-attendance" role="tabpanel" aria-labelledby="v-pills-attendance-tab">
                                        <!-- Edit Profile -->
                                        <div class="edit-profile ">
                                            <div class="card">
                                                <div class="card-header  px-sm-25 px-3">
                                                    <div class="edit-profile__title">
                                                        <h6>Attendance Log</h6>
                                                        <span class="fs-13 color-light fw-400">Attendance history for this user</span>
                                                        <div id="attendance-response"></div>
                                                    </div>
                                                </div>

                                                <div class="card-body">
                                                    <div class="row justify-content-center">
                                                        <div class="col-xxl-12 col-lg-8 col-sm-10">
                                                            <div class="edit-profile__body mx-lg-20">
                                                                <div class="col-lg-12">
                                                                    <div class="userDatatable  p-30 bg-white radius-xl w-100 mb-30">
                                                                        <div class="table-responsive">
                                                                            <table class="table mb-0 table-borderless">
                                                                                <thead>
                                                                                    <tr class="userDatatable-header">
                                                                                        <th>
                                                                                            <div class="d-flex align-items-center">
                                                                                                <div class="custom-checkbox  check-all">
                                                                                                    <input class="checkbox" type="checkbox" id="check-3">
                                                                                                    <label for="check-3">
                                                                                                        <span class="checkbox-text userDatatable-title">Session</span>
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </th>
                                                                                        <th>
                                                                                            <span class="userDatatable-title">Logged At</span>
                                                                                        </th>
                                                                                        <th>
                                                                                            <span class="userDatatable-title">Signed Out At</span>
                                                                                        </th>
                                                                                        <th>
                                                                                            <span class="userDatatable-title">Expired</span>
                                                                                        </th>

                                                                                        <th>
                                                                                            <span class="userDatatable-title">status</span>
                                                                                        </th>

                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="attendance-body">
                                                                                    <!-- Dynamic content goes here -->
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div class="d-flex justify-content-end pt-30">
                                                                            <nav class="atbd-page ">
                                                                                <ul id="pagination" class="atbd-pagination d-flex"></ul>
                                                                            </nav>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Edit Profile End -->
                                    </div>



                                    <div class="modal-info-delete modal fade" id="modal-info-delete" tabindex="-1" role="dialog" aria-hidden="true">
                                        ` <div class="modal-dialog modal-sm modal-info" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="modal-info-body d-flex">
                                                        <div class="modal-info-icon warning">
                                                            <span data-feather="info"></span>
                                                        </div>
                                                        <div class="modal-info-text">
                                                            <h6 id="modal-title">Are you sure?</h6>
                                                            <p id="modal-message">Some contents...</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-outlined btn-sm" data-dismiss="modal">No</button>
                                                    <button type="button" class="btn btn-success btn-outlined btn-sm" id="confirm-action">Yes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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

                                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                        <!-- Edit Profile -->
                                        <div class="edit-profile ">
                                            <div class="card">
                                                <div class="card-header  px-sm-25 px-3">
                                                    <div class="edit-profile__title">
                                                        <h6>change password</h6>
                                                        <span class="fs-13 color-light fw-400">Change or reset user's account
                                                            password</span>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row justify-content-center">
                                                        <div class="col-xxl-6 col-lg-8 col-sm-10">
                                                            <div class="edit-profile__body mx-lg-20">
                                                                <div id="password-response-message" class="alert d-none"></div>
                                                                <form id="update-password" method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="form-group mb-1">
                                                                        <label for="password-field">new password</label>
                                                                        <div class="position-relative">
                                                                            <input id="new-password" type="password" class="form-control pr-50" name="new_password" autocomplete="off">
                                                                            <span class="fa fa-fw fa-eye-slash text-light fs-16 field-icon toggle-password2"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="button-group d-flex flex-wrap pt-45 mb-35">
                                                                        <button class="btn btn-primary btn-default btn-squared mr-15 text-capitalize">Save Changes
                                                                        </button>
                                                                        <button onclick="window.history.back();" class="btn btn-light btn-default btn-squared fw-400 text-capitalize">cancel
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
    <audio style="display: none;" id="notification-sound" src="{{ asset('sounds/notification.mp3') }}" preload="auto"></audio>
    `
    <!-- inject:js-->
    <script src="{{asset('js/plugins.min.js')}}"></script>
    <script src="{{asset('js/script.min.js')}}"></script>
    <!-- endinject-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS (Ensure this is included AFTER jQuery) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/notification.js') }}"></script>
    <script src="{{ asset('js/logout.js') }}"></script>

    <script>
        $(document).on("submit", "#profile-form", function(e) {
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
                beforeSend: function() {
                    $("#update-button").attr("disabled", true).text("Updating...");
                },
                success: function(response) {
                    $("#update-button").attr("disabled", false).text("Update Profile");
                    $("#status-message")
                        .removeClass("d-none alert-danger")
                        .addClass("alert alert-success")
                        .text(response.message)
                        .fadeIn();

                    setTimeout(() => {
                        $("#status-message").hide();
                    }, 3000);

                },
                error: function(xhr) {
                    $("#update-button").attr("disabled", false).text("Update Profile");
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
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
        $(document).ready(function() {
            let userID = $("#profile-form").data("id"); // Get user ID from form

            // Function to load employee data
            function loadEmployeeData() {
                $.ajax({
                    url: "/dashboard/employees/get-employee/" + userID, // Fetch data from server
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        if (response.employees.length > 0) {
                            let employee = response.employees[0];

                            // Populate form fields
                            $("#names").val(employee.fullname);
                            $("#phoneNumber1").val(employee.phone);
                            $("#position").val(employee.position);
                        }
                    },
                    error: function() {
                        console.log("Failed to fetch employee data.");
                    }
                });
            }

            // Load employee data on page load
            loadEmployeeData();

            setTimeout(loadEmployeeData, 1000);
        });
    </script>

    <script>
        $(document).ready(function() {
            function getUserIdFromURL() {
                var pathArray = window.location.pathname.split('/');
                return pathArray[pathArray.length - 1]; // Get the last segment of the URL
            }

            function fetchUserData() {
                var userId = getUserIdFromURL(); // Dynamically get the user ID

                $.ajax({
                    url: "/dashboard/employee/get-email-username/" + userId,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        if (response.length > 0) {
                            $('#name').val(response[0].name);
                            $('#email45').val(response[0].email);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("Error fetching data:", error);
                    }
                });
            }

            // Fetch data initially
            fetchUserData();

            // Fetch data every 5 seconds
            //  setInterval(fetchUserData, 5000);
        });
    </script>

    <script>
        $(document).ready(function() {
            function getUserIdFromURL() {
                var pathArray = window.location.pathname.split('/');
                return pathArray[pathArray.length - 1]; // Get the last segment of the URL (user ID)
            }

            $("#submit-loginID").on("click", function(e) {
                e.preventDefault(); // Prevent default button action

                var userId = getUserIdFromURL(); // Get user ID dynamically
                var formData = new FormData($("#update-loginID-form")[0]); // Get form data

                $.ajax({
                    url: "/dashboard/employee/update-email-username/" + userId,
                    type: "POST", // Laravel expects PUT, so we send it in headers
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        "X-HTTP-Method-Override": "PUT", // Laravel will treat it as a PUT request
                    },
                    success: function(response, status, xhr) {
                        // Check if the message is "No Changes Were Made"
                        if (response.message === "No Changes Were Made") {
                            displayResponse(response.message, "alert-info"); // Still success
                        } else {
                            displayResponse(response.message, "alert-success");
                        }

                        setTimeout(() => {
                            $("#response-message").hide();
                        }, 3000);

                    },
                    error: function(xhr) {
                        var response = xhr.responseJSON;
                        if (xhr.status === 422) {
                            displayResponse(response.message || "Validation error! Please check input fields.", "alert-warning");
                        } else if (xhr.status === 404) {
                            displayResponse(response.message || "Error 404: Resource not found!", "alert-danger");
                        } else if (xhr.status === 500) {
                            displayResponse(response.message || "Server error! Try again later.", "alert-danger");
                        } else {
                            displayResponse(xhr.status, response.message || "Unexpected error occurred.", "alert-danger");
                        }
                    },
                });
            });

            function displayResponse(message, alertClass) {
                $("#response-message")
                    .removeClass("d-none alert-success alert-danger alert-warning")
                    .addClass(alertClass)
                    .html(`${message}`);
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            function getUserIdFromURL() {
                var pathArray = window.location.pathname.split('/');
                return pathArray[pathArray.length - 1]; // Get the last segment of the URL (user ID)
            }
            $("#update-password").on("submit", function(e) {
                e.preventDefault(); // Prevent default form submission

                var formData = new FormData(this); // Get form data

                var userID = getUserIdFromURL();

                $.ajax({
                    url: "/dashboard/employee/update-password/" + userID, // Update this to your actual Laravel route
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function(response) {
                        if (response.message === 'No Changes Were Made') {
                            displayResponse(response.message, "alert-info");
                        } else {
                            displayResponse(response.message, "alert-success");
                        }

                        setTimeout(() => {
                            window.location.reload();
                        }, 3000);

                    },
                    error: function(xhr) {
                        var response = xhr.responseJSON;
                        var message = "";

                        if (xhr.status === 422 && response.errors) {
                            // Loop through all errors and append them
                            $.each(response.errors, function(key, value) {
                                message += `<small>${value}</small><br>`; // Append each error in a list
                            });

                            displayResponse(`<ul>${message}</ul>`, "alert-warning");

                            setTimeout(() => {
                                $("#password-response-message").hide();
                            }, 5000);

                        } else if (xhr.status === 404) {
                            displayResponse(response?.message || "Error 404: Resource not found!", "alert-danger");
                        } else if (xhr.status === 500) {
                            displayResponse(response?.message || "Server error! Try again later.", "alert-danger");
                        } else {
                            displayResponse(response?.message || "Unexpected error occurred.", "alert-danger");
                        }
                    },

                });
            });

            // Function to display response messages
            function displayResponse(message, alertClass) {
                $("#password-response-message")
                    .removeClass("d-none alert-success alert-danger alert-warning alert-info")
                    .addClass(`alert ${alertClass} show`) // Add 'alert' and 'show' classes
                    .html(`<p>${message}</p>`);
            }

        });
    </script>

    <script>
        $(document).ready(function() {

            function getUserIdFromURL() {
                var pathArray = window.location.pathname.split('/');
                return pathArray[pathArray.length - 1]; // Get the last segment of the URL (user ID)
            }

            $("#file-upload").on("change", function(e) {
                let file = this.files[0]; // Get the selected file
                if (!file) return;

                let formData = new FormData();
                formData.append("fileUpload", file);

                var userID = getUserIdFromURL();

                // AJAX request to upload image
                $.ajax({
                    url: "/dashboard/employee/update-profile-picture/" + userID, // Laravel route
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    beforeSend: function() {
                        console.log("Uploading...");
                    },
                    success: function(response) {
                        if (response.success) {
                            $(".ap-img__main").attr("src", response.imageUrl); // Update profile picture
                        } else {
                            alert(response.message || "Upload failed!");
                        }
                    },
                    error: function(xhr) {
                        alert("Error uploading image!");
                    },
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            function getUserIdFromURL() {
                var pathArray = window.location.pathname.split('/');
                return pathArray[pathArray.length - 1]; // Get the last segment of the URL (user ID)
            }

            var userID = getUserIdFromURL(); // Replace with the actual user ID dynamically

            function fetchProfilePicture() {
                $.ajax({
                    url: "/dashboard/employee/get-profile-picture/" + userID,
                    type: "GET",
                    success: function(response) {
                        if (response.success) {
                            $(".ap-img__main").attr("src", response.imageUrl); // Update image src
                        }
                    },
                    error: function() {
                        console.log("Failed to fetch profile picture.");
                    }
                });
            }

            fetchProfilePicture(); // Call the function on page load
        });
    </script>

    <script>
        $(document).ready(function() {
            function getUserIdFromURL() {
                var pathArray = window.location.pathname.split('/');
                return pathArray[pathArray.length - 1]; // Get the last segment of the URL (user ID)
            }

            let employeeId = getUserIdFromURL(); // Change this dynamically based on the employee ID

            function checkEmployeeStatus() {
                $.ajax({
                    url: `/dashboard/employee/check-employee-status/${employeeId}`,
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            if (response.isBlocked) {
                                // User is blocked
                                $('#block-form button').text('Unblock Account').removeClass('btn-warning').addClass('btn-success');
                            } else {
                                // User is active
                                $('#block-form button').text('Block Account').removeClass('btn-success').addClass('btn-warning');
                            }
                        }
                    }
                });
            }


            // Call function on page load
            checkEmployeeStatus();

            // Handle click event to block/unblock
            $('#block-form').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: `/dashboard/employee/block-employee/${employeeId}`,
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            checkEmployeeStatus(); // Refresh status after action
                        } else {
                            alert('Something went wrong!');
                        }
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Get the current URL
            let currentUrl = window.location.href;

            // Extract user ID from URL (assuming the format: /dashboard/employee/{userId})
            let userId = currentUrl.split("/").pop(); // Gets the last segment of the URL

            // Assign the user ID to the button's data attribute
            $("#block-btn").attr("data-user-id", userId);
        });
    </script>

    <script>
        $(document).ready(function() {
            // Handle Block/Unblock button click
            $("#block-btn").click(function(e) {
                e.preventDefault();

                let button = $(this);
                let userId = button.data("user-id");
                let action = button.text().trim(); // Get button text (Block Account or Unblock Account)

                // Update modal text
                $("#modal-title").text(action === "Block Account" ? "Confirm Blocking" : "Confirm Unblocking");
                $("#modal-message").text(`Are you sure you want to ${action.toLowerCase()} this user?`);

                // Show modal
                $("#modal-info-delete").modal("show");

                // When "Yes" is clicked, perform the action
                $("#confirm-action").off("click").on("click", function() {
                    $.ajax({
                        url: `/dashboard/employee/block-employee/${userId}`,
                        type: "POST",
                        data: {
                            _token: $("input[name=_token]").val(),
                            action: action
                        },
                        success: function(response) {
                            $("#modal-message").text(response.message);

                            // Update button text & style
                            if (response.success) {
                                button.text(response.new_status);
                                button.toggleClass("btn-warning btn-danger");
                            }

                            // Hide modal after 2 seconds
                            setTimeout(function() {
                                $("#modal-info-delete").modal("hide");
                            }, 2000);
                        },
                        error: function() {
                            $("#modal-message").text("An error occurred. Please try again.");
                        }
                    });
                });
            });

            // Close modal when "No" is clicked
            $(".btn-danger[data-dismiss='modal']").click(function() {
                $("#modal-info-delete").modal("hide");
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".toggle-password2").on("click", function() {
                const $input = $(this).siblings("input");
                const type = $input.attr("type") === "password" ? "text" : "password";

                $input.attr("type", type);
                $(this).toggleClass("fa-eye fa-eye-slash");
            });
        });
    </script>

    <script src="{{ asset('js/single-user-attendance.js') }}"></script>

</body>

</html>