
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Swift Sign - Attendance</title>

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
                            <div class="action-btn">
                                <a href="#" class="btn px-15 btn-primary" data-toggle="modal" data-target="#new-member">
                                    <i class="las la-plus fs-16"></i>Add New Member</a>

                                <!-- Modal -->
                                <div class="modal fade new-member" id="new-member" role="dialog" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content  radius-xl">
                                            <div class="modal-header">
                                                <h6 class="modal-title fw-500" id="staticBackdropLabel">Create project</h6>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span data-feather="x"></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="new-member-modal">
                                                    <form>
                                                        <div class="form-group mb-20">
                                                            <input type="text" class="form-control" placeholder="Duran Clayton">
                                                        </div>
                                                        <div class="form-group mb-20">
                                                            <div class="category-member">
                                                                <select class="js-example-basic-single js-states form-control" id="category-member">
                                                                    <option value="JAN">1</option>
                                                                    <option value="FBR">2</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-20">
                                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Project description"></textarea>
                                                        </div>
                                                        <div class="form-group textarea-group">
                                                            <label class="mb-15">status</label>
                                                            <div class="d-flex">
                                                                <div class="project-task-list__left d-flex align-items-center">
                                                                    <div class="checkbox-group d-flex mr-50 pr-10">
                                                                        <div class="checkbox-theme-default custom-checkbox checkbox-group__single d-flex">
                                                                            <input class="checkbox" type="checkbox" id="check-grp-1" checked="">
                                                                            <label for="check-grp-1" class="fs-14 color-light strikethrough">
                                                                                status
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="checkbox-group d-flex mr-50 pr-10">
                                                                        <div class="checkbox-theme-default custom-checkbox checkbox-group__single d-flex">
                                                                            <input class="checkbox" type="checkbox" id="check-grp-2">
                                                                            <label for="check-grp-2" class="fs-14 color-light strikethrough">
                                                                                Deactivated
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="checkbox-group d-flex">
                                                                        <div class="checkbox-theme-default custom-checkbox checkbox-group__single d-flex">
                                                                            <input class="checkbox" type="checkbox" id="check-grp-3">
                                                                            <label for="check-grp-3" class="fs-14 color-light strikethrough">
                                                                                bloked
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-25">
                                                            <div class="form-group mb-10">
                                                                <label for="name47">project member</label>
                                                                <input type="text" class="form-control" id="name47" placeholder="Search members">
                                                            </div>
                                                            <ul class="d-flex flex-wrap mb-20 user-group-people__parent">
                                                                <li>
                                                                    <a href="#"><img class="rounded-circle wh-34" src="img/tm1.png" alt="author"></a>
                                                                </li>
                                                                <li>
                                                                    <a href="#"><img class="rounded-circle wh-34" src="img/tm2.png" alt="author"></a>
                                                                </li>
                                                                <li>
                                                                    <a href="#"><img class="rounded-circle wh-34" src="img/tm3.png" alt="author"></a>
                                                                </li>
                                                                <li>
                                                                    <a href="#"><img class="rounded-circle wh-34" src="img/tm4.png" alt="author"></a>
                                                                </li>
                                                                <li>
                                                                    <a href="#"><img class="rounded-circle wh-34" src="img/tm5.png" alt="author"></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="d-flex new-member-calendar">
                                                            <div class="form-group w-100 mr-sm-15 form-group-calender">
                                                                <label for="datepicker">start Date</label>
                                                                <div class="position-relative">
                                                                    <input type="text" class="form-control" id="datepicker" placeholder="mm/dd/yyyy">
                                                                    <a href="#">
                                                                        <span data-feather="calendar"></span></a>
                                                                </div>
                                                            </div>
                                                            <div class="form-group w-100 form-group-calender">
                                                                <label for="datepicker2">End Date</label>
                                                                <div class="position-relative">
                                                                    <input type="text" class="form-control" id="datepicker2" placeholder="mm/dd/yyyy">
                                                                    <a href="#">
                                                                        <span data-feather="calendar"></span></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="button-group d-flex pt-25">



                                                            <button class="btn btn-primary btn-default btn-squared text-capitalize">add new project
                                                            </button>








                                                            <button class="btn btn-light btn-default btn-squared fw-400 text-capitalize b-light color-light">cancel
                                                            </button>





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

    <script>
    function fetchAttendanceData() {
    $.ajax({
        url: "{{ route('dashboard.attendance.all') }}", // Laravel API Route
        type: "GET",
        dataType: "json",
        success: function (response) {
            let tbody = $("table tbody");
            tbody.empty(); // Clear the table before appending new data

            response.attendance.forEach((record, index) => {
                let row = `
                    <tr>
                        <td>
                            <div class="d-flex">
                                <div class="userDatatable__imgWrapper d-flex align-items-center">
                                    <div class="checkbox-group-wrapper">
                                        <div class="checkbox-group d-flex">
                                            <div class="checkbox-theme-default custom-checkbox checkbox-group__single d-flex">
                                                <input class="checkbox" type="checkbox" id="check-${index}">
                                                <label for="check-${index}"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" class="profile-image rounded-circle d-block m-0 wh-38" 
                                       style="background-image:url('{{asset("img/user.png")}}'); background-size: cover;"></a>
                                </div>
                                <div class="userDatatable-inline-title">
                                    <a href="#" class="text-dark fw-500">
                                        <h6>${record.fullname}</h6>
                                    </a>
                                    <p class="d-block mb-0">Session: ${record.session_id}</p>
                                </div>
                            </div>
                        </td>
                        <td><div class="userDatatable-content">${record.logged_at}</div></td>
                        <td><div class="userDatatable-content">${record.signed_out_at ?? 'N/A'}</div></td>
                        <td>
                            <div class="userDatatable-content d-inline-block
                                        ${record.expired ? 'alert-danger text-danger' : 'alert-success text-success'} 
                                        rounded-pill p-1 text-center">
                                ${record.expired ? 'Yes' : 'No'}
                            </div>
                        </td>
                        <td>
                            <div class="userDatatable-content d-inline-block">
                                <span class="bg-opacity-${record.status === 'active' ? 'success' : 'danger'} color-${record.status === 'active' ? 'success' : 'danger'} rounded-pill userDatatable-content-status">${record.status}</span>
                            </div>
                        </td>
                        <td>
                            <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                <li><a href="#" class="view"><span data-feather="eye"></span></a></li>
                                <li><a href="#" class="edit"><span data-feather="edit"></span></a></li>
                                <li><a href="#" class="remove"><span data-feather="trash-2"></span></a></li>
                            </ul>
                        </td>
                    </tr>
                `;

                tbody.append(row);
            });

            // ✅ Update the attendance count outside the table
            $(".count-attendance").text(response.count + ' Attendance');

            feather.replace(); // Refresh Feather icons
        },
        error: function (xhr, status, error) {
            console.error("Error fetching attendance data:", error);
        }
    });
}

// Fetch data initially
fetchAttendanceData();

// Refresh data every 5 seconds
setInterval(fetchAttendanceData, 5000);

</script>


</body>

</html>