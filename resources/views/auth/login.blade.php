
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SwiftSign - Login</title>
    <link href="../../../../css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- inject:css-->
    <link rel="stylesheet" href="{{asset('css/plugin.min.css')}}">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <!-- endinject -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('SwiftSign Web.png')}}">
</head>

<body>
    <main class="main-content">

        <div class="signUP-admin">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-5 col-md-5 p-0">
                        <div class="signUP-admin-left signIn-admin-left position-relative">
                            <div class="signUP-overlay">
                                <img class="svg signupTop" src="{{asset('img/svg/signuptop.svg')}}" alt="">
                                <img class="svg signupBottom" src="{{asset('img/svg/signupbottom.svg')}}" alt="">
                            </div><!-- End: .signUP-overlay  -->
                            <div class="signUP-admin-left__content text-center text-md-start">
                                <div class="text-capitalize mb-md-30 mb-15 d-flex align-items-center justify-content-md-start justify-content-center">
                                    <a class="" href="{{ url('/') }}">
                                        <img class="img-fluid" src="{{ asset('SwiftSign Web.png') }}" alt="SwiftSign Logo">
                                    </a>
                                </div>
                                <!-- <h1 class="fs-3 fs-md-2 fs-lg-1">Attendance Made Easier With <i>SwiftSign</i></h1> -->
                            </div>
                            <!-- End: .signUP-admin-left__content  -->
                            <div class="signUP-admin-left__img">
                                <img class="img-fluid svg" src="{{asset('img/svg/signupIllustration.svg')}}" alt="">
                            </div><!-- End: .signUP-admin-left__img  -->
                        </div><!-- End: .signUP-admin-left  -->
                    </div><!-- End: .col-xl-4  -->
                    <div class="col-xl-8 col-lg-7 col-md-7 col-sm-8">
                        <div class="signUp-admin-right signIn-admin-right  p-md-40 p-10">
                            <div class="row justify-content-center">
                                <div class="col-xl-7 col-lg-8 col-md-12">
                                    <div class="edit-profile mt-md-25 mt-0">
                                        <div class="card border-0">
                                            <div class="card-header border-0  pb-md-15 pb-10 pt-md-20 pt-10 ">
                                                <div class="edit-profile__title">
                                                    <h6>Sign in to <span class="color-primary">Dashboard</span></h6>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="alert-container"></div>
                                                <form id="login-form" action="{{ route('login') }}" method="post">
                                                    @csrf
                                                    <div class="edit-profile__body">
                                                        <div class="form-group mb-20">
                                                            <label for="email">Email Address</label>
                                                            <input name="email" type="text" class="form-control" id="email" autocomplete="off">
                                                        </div>
                                                        <div class="form-group mb-15">
                                                            <label for="password-field">Password</label>
                                                            <div class="position-relative">
                                                                <input id="password-field" type="password" class="form-control" name="password" autocomplete="off">
                                                                <div class="fa fa-fw fa-eye-slash text-light fs-16 field-icon toggle-password2"></div>
                                                            </div>
                                                        </div>
                                                        <div class="signUp-condition signIn-condition">
                                                            <div class="checkbox-theme-default custom-checkbox">
                                                                <input name="remember" class="checkbox" type="checkbox" id="check-1" {{ old('remember') ? 'checked' : '' }}>
                                                                <label for="check-1">
                                                                    <span class="checkbox-text">Keep me logged in</span>
                                                                </label>
                                                            </div>
                                                            <a href="forget-password.html">Forget password?</a>
                                                        </div>
                                                        <div class="button-group d-flex pt-1 justify-content-md-start justify-content-center">
                                                            <button class="btn btn-primary btn-default btn-squared mr-15 text-capitalize lh-normal px-50 py-15 signIn-createBtn">
                                                                Sign in
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div><!-- End: .card-body -->
                                        </div><!-- End: .card -->
                                    </div><!-- End: .edit-profile -->
                                </div><!-- End: .col-xl-5 -->
                            </div>
                        </div><!-- End: .signUp-admin-right  -->
                    </div><!-- End: .col-xl-8  -->
                </div>
            </div>
        </div><!-- End: .signUP-admin  -->
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

    <!-- inject:js-->
    <script src="{{asset('js/plugins.min.js')}}"></script>
    <script src="{{asset('js/script.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $("#login-form").submit(function (e) {
                e.preventDefault();

                let form = $(this);
                let formData = form.serialize();

                // Clear previous errors
                $(".error-message").remove();
                $(".form-control").removeClass("is-invalid");

                $.ajax({
                    url: form.attr("action"),
                    type: "POST",
                    data: formData,
                    success: function (response) {
                        if (response.success) {
                            window.location.href = response.redirect || "/dashboard";
                        } else {
                            showAlert("danger", response.message);
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 403) {
                            // Redirect employees to home
                            window.location.href = xhr.responseJSON.redirect;
                        } else if (xhr.status === 422) {
                            // Display validation errors
                            let errors = xhr.responseJSON.errors;
                            $(".error-message").remove(); // Remove old error messages
                            $(".is-invalid").removeClass("is-invalid"); // Reset validation states

                            $.each(errors, function (field, messages) {
                                let input = $('[name="' + field + '"]');
                                input.addClass("is-invalid");
                                input.after('<div class="error-message text-danger small">' + messages[0] + "</div>");
                            });
                        } else if (xhr.status === 401) {
                            // Unauthorized (Invalid email or password)
                            showAlert("danger", xhr.responseJSON.message || "Invalid email or password.");
                        } else if (xhr.status === 500) {
                            // Internal Server Error - Get actual message from the response
                            let errorMessage = xhr.responseJSON?.message || "An unexpected server error occurred. Please try again later.";
                            showAlert("danger", errorMessage);
                        } else {
                            showAlert("danger", "An unexpected error occurred. Please try again.");
                        }
                    }
                });
            });

            // Function to show alert message
            function showAlert(type, message) {
                $(".alert-container").html(`
                    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                `);
            }

            // Store last visited page before login
            let currentPath = window.location.pathname;
            if (currentPath !== "/login") {
                localStorage.setItem("lastPage", currentPath);
            }
        });
    </script>

<script>
    $(document).ready(function () {
        $(".toggle-password2").click(function () {
            let passwordField = $("#password-field");
            let fieldType = passwordField.attr("type") === "password" ? "text" : "password";
            passwordField.attr("type", fieldType);

            // Toggle eye icon
            $(this).toggleClass("fa-eye fa-eye-slash");
        });
    });
</script>

    <!-- endinject-->
</body>
</html>