<!doctype html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>SwiftSign - Attendance</title>
      <link href="../../../../css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
      <audio autoplay style="display: none;" id="notification-sound" src="{{ asset('sounds/notification.mp3') }}" preload="auto"></audio>

      <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDduF2tLXicDEPDMAtC6-NLOekX0A5vlnY"></script>
      <!-- inject:js-->
      <script src="{{asset('js/plugins.min.js')}}"></script>
      <script src="{{asset('js/script.min.js')}}"></script>
      <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

      <script src="{{ asset('js/notification.js') }}" ></script>
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
                             <td><div class="userDatatable-content">${record.signed_out_at}</div></td>
                             <td>
                                 <div class="userDatatable-content d-inline-block
                                             ${record.expired === 'YES' ? 'alert-danger text-danger' : 'alert-success text-success'} 
                                             rounded-pill p-1 text-center">
                                     ${record.expired}
                                 </div>
                             </td>
                             <td>
                                 <div class="userDatatable-content d-inline-block">
                                     <span class="bg-opacity-${record.status === 'SIGNED' ? 'success' : 'danger'} color-${record.status === 'SIGNED' ? 'success' : 'danger'} rounded-pill userDatatable-content-status">${record.status}</span>
                                 </div>
                             </td>
                             <td>
                                 <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                     <li><a href="#" class="view"><span data-feather="eye"></span></a></li>
                                     <li><a href="#" class="edit"><span data-feather="edit"></span></a></li>
                                     <li><a href="${record.id}" class="remove"><span data-feather="trash-2"></span></a></li>
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

        <script>
            $(document).on("click", ".remove", function (e) {
                e.preventDefault(); // Prevent default anchor behavior

                let recordId = $(this).attr("href"); // Get the record ID
                $("#record-info").text("Record ID: " + recordId); // Show record info

                // Store ID in modal button for later use
                $("#confirm-delete").data("record-id", recordId);

                // Show the modal
                $("#modal-info-delete").modal("show");
            });

            // When "Yes" is clicked in the modal
            $(document).on("click", "#confirm-delete", function () {
                let recordId = $(this).data("record-id"); // Retrieve stored record ID
                let deleteUrl = `/your-delete-route/${recordId}`; // Define your delete route

                $.ajax({
                    url: deleteUrl,
                    type: "DELETE",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content"), // CSRF token
                    },
                    success: function (response) {
                        let messageHtml = `<div class="alert alert-success">${response.message}</div>`;
                        $("#message-box").html(messageHtml); // Show success message

                        // Remove the item from the UI
                        $(`a[href="${recordId}"]`).closest("li").remove();

                        // Hide the modal after deletion
                        $("#modal-info-delete").modal("hide");
                    },
                    error: function (xhr) {
                        let errorMessage = "An error occurred. Please try again.";

                        if (xhr.status === 404) {
                            errorMessage = "Record not found.";
                        } else if (xhr.status === 500) {
                            errorMessage = "Internal server error. Please contact support.";
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        let messageHtml = `<div class="alert alert-danger">${errorMessage}</div>`;
                        $("#message-box").html(messageHtml); // Show error message

                        // Hide the modal after showing the error
                        $("#modal-info-delete").modal("hide");
                    },
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