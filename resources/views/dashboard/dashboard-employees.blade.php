
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SwiftSign - Employees</title>
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
                    <div class="col-12">
                        <div class="contact-breadcrumb">

                            <div class="breadcrumb-main add-contact justify-content-sm-between ">
                                <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                                    <div class="d-flex align-items-center add-contact__title justify-content-center mr-sm-25">
                                        <h4 class="text-capitalize fw-500 breadcrumb-title">Employees</h4>
                                        <span class="sub-title ml-sm-25 pl-sm-25"></span>
                                    </div>

                                    <form id="search-employee-form" method="get" enctype="multipart/form-data" action="#" class="d-flex align-items-center add-contact__form my-sm-0 my-2">
                                        <span data-feather="search"></span>
                                        <input autocomplete="off" name="search" class="form-control mr-sm-2 border-0 box-shadow-none" type="search" placeholder="Search by Name" aria-label="Search">
                                    </form>

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

                                <div class="action-btn">
                                    <a href="#" class="btn px-15 btn-primary" data-toggle="modal" data-target="#add-contact">
                                        <i class="las la-plus fs-16"></i>Add New
                                    </a>

                                    <!-- Modal -->
                                    <div class="modal fade add-contact" id="add-contact" role="dialog" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content radius-xl">
                                                <div class="modal-header">
                                                    <h6 class="modal-title fw-500" id="staticBackdropLabel">Employee Information</h6>
                                                    <a href="#" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span data-feather="x"></span>
                                                    </a>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="add-new-contact">
                                                        <!-- Status message container -->
                                                    <div id="status-message" class="alert d-none"></div>
                                                    <form id="employeeForm" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group mb-20">
                                                                    <label>Username:</label>
                                                                    <input name="name" value="{{ old('name') }}" autocomplete="off" type="text" class="form-control form-control-lg" placeholder="Username">
                                                                    <p class="text-danger error-name"></p> <!-- Error Placeholder -->
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group mb-20">
                                                                    <label>Email Address:</label>
                                                                    <input name="email" value="{{ old('email') }}" autocomplete="off" type="text" class="form-control form-control-lg" placeholder="Email Address">
                                                                    <p class="text-danger error-email"></p> <!-- Error Placeholder -->
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group mb-20">
                                                                    <label>Password:</label>
                                                                    <input name="password" autocomplete="off" type="password" class="form-control form-control-lg" placeholder="Password">
                                                                    <p class="text-danger error-password"></p> <!-- Error Placeholder -->
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group mb-20">
                                                                    <label>Repeat Password:</label>
                                                                    <input name="confirm_password" autocomplete="off" type="password" class="form-control form-control-lg" placeholder="Repeat Password">
                                                                    <p class="text-danger error-confirm_password"></p> <!-- Error Placeholder -->
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group mb-20">
                                                                    <label>Full Name:</label>
                                                                    <input name="fullname" value="{{ old('fullname') }}" autocomplete="off" type="text" class="form-control form-control-lg" placeholder="Your Name">
                                                                    <p class="text-danger error-fullname"></p> <!-- Error Placeholder -->
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group mb-20">
                                                                    <label>Phone Number:</label>
                                                                    <input name="phone" value="{{ old('phone') }}" autocomplete="off" type="text" class="form-control form-control-lg" placeholder="Phone Number">
                                                                    <p class="text-danger error-phone"></p> <!-- Error Placeholder -->
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group mb-20">
                                                                    <label>Position:</label>
                                                                    <input name="position" value="{{ old('position') }}" autocomplete="off" type="text" class="form-control form-control-lg" placeholder="Position">
                                                                    <p class="text-danger error-position"></p> <!-- Error Placeholder -->
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group mb-20">
                                                                    <label>Employee ID:</label>
                                                                    <input name="employee_id" value="{{ old('employee_id') }}" autocomplete="off" type="text" class="form-control form-control-lg" placeholder="Employee ID">
                                                                    <p class="text-danger error-employee_id"></p> <!-- Error Placeholder -->
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="button-group d-flex pt-20">
                                                            <button id="save-button" type="submit" class="btn btn-primary btn-default btn-squared">Save</button>
                                                        </div>
                                                    </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->


                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="contact-list-wrap mb-25">
                            <div class="contact-list bg-white radius-xl w-100">
                                <div class="table-responsive">

                                <table class="table mb-0 table-borderless table-rounded" id="employeeTable">
                                    <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Position</th>
                                            <th>Employee ID</th>
                                            <th>Phone</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="employeeBody">
                                        <!-- Employees will be added here -->
                                    </tbody>
                                </table>
                                </div>
                                <div class="d-flex justify-content-end pt-30">
                                    <nav class="atbd-page ">
                                        <ul class="atbd-pagination d-flex">
                                            <li class="atbd-pagination__item">
                                                <a href="#" class="atbd-pagination__link pagination-control"><span class="la la-angle-left"></span></a>
                                                <a href="#" class="atbd-pagination__link"><span class="page-number">1</span></a>
                                                <a href="#" class="atbd-pagination__link active"><span class="page-number">2</span></a>
                                                <a href="#" class="atbd-pagination__link"><span class="page-number">3</span></a>
                                                <a href="#" class="atbd-pagination__link pagination-control"><span class="page-number">...</span></a>
                                                <a href="#" class="atbd-pagination__link"><span class="page-number">12</span></a>
                                                <a href="#" class="atbd-pagination__link pagination-control"><span class="la la-angle-right"></span></a>
                                                <a href="#" class="atbd-pagination__option">
                                                </a>
                                            </li>
                                            <li class="atbd-pagination__item">
                                                <div class="paging-option">
                                                <select name="page-number" class="page-selection">
                                                    <option value="20">20/page</option>
                                                    <option value="40">40/page</option>
                                                    <option value="60">60/page</option>
                                                </select>
                                                </div>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ends: col-12 -->
                </div>
            </div>

        </div>

        @include('templates/footer')
    </main>

    <audio style="display: none;" id="notification-sound" src="{{ asset('sounds/notification.mp3') }}" preload="auto"></audio>
    


    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDduF2tLXicDEPDMAtC6-NLOekX0A5vlnY"></script>
    <!-- inject:js-->
    <script src="{{asset('js/plugins.min.js')}}"></script>
    <script src="{{asset('js/script.min.js')}}"></script>
    <script src="{{ asset('js/notification.js') }}" ></script>
    <!-- endinject-->
    <script>
        $(document).ready(function () {
        $("#employeeForm").on("submit", function (e) {
            e.preventDefault();

            $(".text-danger").text(""); // Clear previous errors
            let formData = new FormData(this); // Get form data

            $.ajax({
                url: "{{ route('dashboard.employees.new') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                beforeSend: function () {
                    $("#save-button").attr("disabled", true).text("Submitting...");
                    $("#staticBackdropLabel").text("Submitting...");
                    $("#status-message").removeClass("alert-success alert-danger").addClass("d-none").text("");
                },
                success: function (response) {
                    $("#save-button").attr("disabled", false).text("Save");
                    $("#staticBackdropLabel").text("Employee Information");

                    // Show success message
                    $("#status-message")
                        .removeClass("d-none alert-danger")
                        .addClass("alert alert-success")
                        .text(response.message);

                    $("#employeeForm")[0].reset(); // Reset form on success
                },
                error: function (xhr) {
                    $("button").attr("disabled", false).text("Save");
                    $("#staticBackdropLabel").text("Employee Information");

                    if (xhr.status === 422) { // Validation error
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            $(".error-" + key).text(value[0]); // Show field-specific errors
                        });

                        // Show error message
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
    });

</script>

<script>
$(document).ready(function() {
    // Function to fetch employees (default data)
    function fetchEmployees() {
        $.ajax({
            url: "{{ route('dashboard.employees.all') }}",
            type: "GET",
            success: function(response) {
                updateTable(response.employees);
            }
        });
    }

    // Function to search employees
    function searchEmployees(query) {
        $.ajax({
            url: "{{ route('dashboard.employees.search') }}",
            type: "POST",
            data: {
                search: query,
                _token: $('meta[name="csrf-token"]').attr("content"), // CSRF token
            },
            success: function(response) {
                updateTable(response.employees);
            }
        });
    }

    // Function to update the table dynamically
    function updateTable(employees) {
        $("#employeeBody").html(""); // Clear table before appending
        $.each(employees, function(index, employee) {
            $("#employeeBody").append(`
                <tr>
                    <td>${employee.fullname}</td>
                    <td>${employee.position}</td>
                    <td>${employee.employee_id}</td>
                    <td>${employee.phone}</td>
                    <td>
                        <div class="d-flex">
                            <a href="/dashboard/employees/${employee.userID}" title="View" class="border-0 bg-transparent view-btn me-3" data-id="${employee.userID}">
                                <i class="fas fa-eye text-primary fs-5"></i>
                            </a>
                            <button title="Delete" class="border-0 bg-transparent delete-btn" data-id="${employee.id}">
                                <i class="fas fa-trash text-danger fs-5"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `);
        });
    }

    // Fetch employees on page load
    fetchEmployees();

    // Automatically refresh employees every 1 second when not searching
    let autoRefresh = setInterval(fetchEmployees, 1000);

    // Live search event
    $("#search-employee-form input[name='search']").on("keyup", function() {
        let query = $(this).val().trim();

        if (query.length > 0) {
            clearInterval(autoRefresh); // Stop auto-refresh when searching
            searchEmployees(query);
        } else {
            autoRefresh = setInterval(fetchEmployees, 1000); // Restart auto-refresh
            fetchEmployees(); // Load default data
        }
    });
});

</script>

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


</body>

</html>