<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attendance - SwiftSign</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- inject:css-->
    <link rel="stylesheet" href="{{asset('css/plugin.min.css')}}">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('css/bell-animation.css')}}">
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
                        <div class="breadcrumb-main user-member justify-content-sm-between ">
                            <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                                <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                                    <h4 class="text-capitalize fw-500 breadcrumb-title">Attendance</h4>
                                    <span class="sub-title ml-sm-25 pl-sm-25 count-attendance"></span>
                                </div>
                                <form action="/" class="d-flex align-items-center user-member__form my-sm-0 my-2">
                                    <span data-feather="search"></span>
                                    <input class="form-control mr-sm-2 border-0 box-shadow-none" type="search" placeholder="Search by Name" aria-label="Search">
                                </form>
                            </div>
                        </div>
                        <!-- Message Box for Feedback -->
                        <div id="message-box"></div><br>
                    </div>
                </div>
                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="modal-info-delete" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-info" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="modal-info-body d-flex">
                                    <div class="modal-info-icon warning">
                                        <span data-feather="info"></span>
                                    </div>
                                    <div class="modal-info-text">
                                        <h6>Do you want to delete this record?</h6>
                                        <p id="record-info">Loading...</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-outlined btn-sm" data-dismiss="modal">No</button>
                                <button type="button" class="btn btn-success btn-outlined btn-sm" id="confirm-delete">Yes</button>
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="userDatatable global-shadow border p-30 bg-white radius-xl w-100 mb-30">
                            <div class="table-responsive">
                                <table class="table mb-0 table-borderless">
                                    <thead>
                                        <tr class="userDatatable-header">
                                            <th>
                                                <div class="d-flex align-items-center">
                                                    <div class="custom-checkbox  check-all">
                                                        <input class="checkbox" type="checkbox" id="check-3">
                                                        <label for="check-3">
                                                            <span class="checkbox-text userDatatable-title">user</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Logged At</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">SIgned Out At</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Expired</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Status</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title float-right">action</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end pt-30">
                                <nav class="atbd-page ">
                                    <ul class="atbd-pagination d-flex" id="pagination-container"></ul>
                                </nav>
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
    <audio autoplay style="display: none;" id="notification-sound" src="{{ asset('sounds/notification.mp3') }}" preload="auto"></audio>

    <!-- inject:js-->
    <script src="{{asset('js/plugins.min.js')}}"></script>
    <script src="{{asset('js/script.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script src="{{ asset('js/notification.js') }}"></script>
    <script src="{{ asset('js/logout.js') }}"></script>
    <!-- endinject-->
   <script src="{{ asset('js/get-all-atendance.js') }}"></script>
   <script src="{{ asset('js/delete-atendance.js') }}"></script>

</body>

</html>