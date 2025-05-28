<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Swift Sign - Settings</title>

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
                            </div>

                            <div id="error-message"></div>

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
                                                <img class="ap-img__main rounded-circle wh-120" src="{{ Auth::check() && optional(Auth::user()->employee)->pic ? asset('uploads/profile_pictures/' . Auth::user()->employee->pic) : asset('img/Sample_User_Icon.png') }}" alt="profile">
                                                <span class="cross" id="remove_pro_pic">
                                                    <span data-feather="camera"></span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="ap-nameAddress pb-3">
                                            <h5 class="ap-nameAddress__title"> {{ Auth::check() ? ucfirst(Auth::user()->name) : '' }} </h5>
                                            <p class="ap-nameAddress__subTitle fs-14 m-0"> {{ Auth::check() ? ucfirst(Auth::user()->role) : '' }} </p>
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
                            <div class="mb-50">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade  show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                        <!-- Edit Profile -->
                                        <div class="edit-profile mt-25">
                                            <div class="card">
                                                <div class="card-header px-sm-25 px-3">
                                                    <div class="edit-profile__title">
                                                        <h6>Edit Profile</h6>
                                                        <span class="fs-13 color-light fw-400">Set up your company's
                                                            information</span>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row justify-content-center">
                                                        <div class="col-xxl-6 col-lg-8 col-sm-10">
                                                            <div class="edit-profile__body mx-lg-20">
                                                                <form id="company-profile-form" action="#" method="POST">
                                                                    @csrf
                                                                    @method('POST')
                                                                    <div class="form-group mb-20">
                                                                        <label for="names">name</label>
                                                                        <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $profile && $profile->company_name ? $profile->company_name : '' }}" autocomplete="off">
                                                                        <small id="error-company_name" style="color: red;"></small>
                                                                    </div>
                                                                    <div class="form-group mb-20">
                                                                        <label for="phoneNumber1">phone number</label>
                                                                        <input type="text" class="form-control" id="company_phone" autocomplete="off" value="{{ $profile && $profile->company_phone ? $profile->company_phone : '' }}" name="company_phone">
                                                                        <small id="error-company_phone" style="color: red;"></small>
                                                                    </div>
                                                                    <div class="form-group mb-20">
                                                                        <label for="company1">address</label>
                                                                        <input type="text" class="form-control" id="company_address" name="company_address" value="{{ $profile && $profile->company_address ? $profile->company_address : '' }}" autocomplete="off">
                                                                        <small id="error-company_address" style="color: red;"></small>
                                                                    </div>

                                                                    <div class="form-group mb-20">
                                                                        <label for="company1">email</label>
                                                                        <input type="text" class="form-control" id="company_email" value="{{ $profile && $profile->company_email ? $profile->company_email : '' }}" name="company_email" autocomplete="off">
                                                                        <small id="error-company_email" style="color: red;"></small>
                                                                    </div>

                                                                    <div class="button-group d-flex flex-wrap pt-30 mb-15">
                                                                        <button class="btn btn-primary btn-default btn-squared mr-15 text-capitalize">update profile
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
                                                                <form id="username-email-form" method="POST">
                                                                    <div class="form-group mb-20">
                                                                        <label for="name1">username</label>
                                                                        <input name="name" type="text" class="form-control" id="name" value="{{ Auth::user()->name }}" autocomplete="off">
                                                                        <small id="error-name" style="color: red !important;" class="text-light fs-13"></small>
                                                                    </div>
                                                                    <div class="form-group mb-1">
                                                                        <label for="email45">email</label>
                                                                        <input name="email" type="text" class="form-control" id="email" autocomplete="off" value="{{ Auth::user()->email }}">
                                                                        <small id="error-email" style="color: red !important;" class="text-light fs-13"></small>
                                                                    </div>

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="row justify-content-center align-items-center">
                                                        <div class="col-xxl-6 col-lg-8 col-sm-10">
                                                            <div class="button-group d-flex flex-wrap pt-35 mb-35">
                                                                <button id="update-username-email-button" class="btn btn-primary btn-default btn-squared mr-15 text-capitalize">Save Changes
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
                                                                <form id="password-form" action="#" method="POST">
                                                                    <div class="form-group mb-20">
                                                                        <label for="name">old passowrd</label>
                                                                        <input name="old_password" type="password" class="form-control" id="old-password" autocomplete="off">
                                                                        <small id="error-old_password" class="text-light fs-13" style="color: red !important;"></small>
                                                                    </div>
                                                                    <div class="form-group mb-1">
                                                                        <label for="password-field">new password</label>
                                                                        <div class="position-relative">
                                                                            <input id="new-password" type="password" class="form-control pr-50" name="new_password" autocomplete="off">
                                                                            <span class="fa fa-fw fa-eye-slash text-light fs-16 field-icon toggle-password2"></span>
                                                                        </div>
                                                                        <small id="error-new_password" class="text-light fs-13" style="color: red !important;"></small>
                                                                    </div>
                                                                    <div class="form-group mb-1">
                                                                        <label for="password-field">Retype password</label>
                                                                        <div class="position-relative">
                                                                            <input id="confirm-password" type="password" class="form-control pr-50" name="confirm_password" autocomplete="off">
                                                                            <span class="fa fa-fw fa-eye-slash text-light fs-16 field-icon toggle-password2"></span>
                                                                        </div>
                                                                        <small id="error-confirm_password" class="text-light fs-13" style="color: red !important;"></small>
                                                                    </div>
                                                                    <div class="button-group d-flex flex-wrap pt-45 mb-35">

                                                                        <button class="btn btn-primary btn-default btn-squared mr-15 text-capitalize">Save Changes
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


    <!-- inject:js-->
    <script src="{{asset('js/plugins.min.js')}}"></script>
    <script src="{{asset('js/script.min.js')}}"></script>
    <script src="{{ asset('js/notification.js') }}"></script>
    <script src="{{ asset('js/company-profile.js') }}"></script>
    <script src="{{ asset('js/logout.js') }}"></script>
    <script src="{{ asset('js/update-username-email.js') }}"></script>
    <script src="{{ asset('js/update-password.js') }}"></script>
    <!-- endinject-->


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

</body>

</html>