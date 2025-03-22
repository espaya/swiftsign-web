<!doctype html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Swift Sign - QR Code</title>
      <link href="../../../../css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
      <!-- inject:css-->
      <link rel="stylesheet" href="{{asset('css/plugin.min.css')}}">
      <link rel="stylesheet" href="{{asset('style.css')}}">
      <!-- Include DataTables CSS -->
      <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

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
                     <div class="project-progree-breadcrumb">
                        <div class="breadcrumb-main user-member justify-content-sm-between ">
                           <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                              <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                                 <h4 class="text-capitalize fw-500 breadcrumb-title">QR Code</h4>
                                 <span class="sub-title ml-sm-25 pl-sm-25">Generate a new QR Code for each new attendace</span>
                              </div>
                           </div>
                           <div class="action-btn">
                              <a href="#" class="btn px-15 btn-primary" data-toggle="modal" data-target="#new-member">
                              <i class="las la-plus fs-16"></i>create Qr Code</a>
                              <!-- Modal -->
                              <div class="modal fade new-member" id="new-member" role="dialog" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                 <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content  radius-xl">
                                       <div class="modal-header">
                                          <h6 class="modal-title fw-500" id="staticBackdropLabel">Create QR Code</h6>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span data-feather="x"></span>
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                          <div class="new-member-modal">
                                             <!-- Success & General Error Messages -->
                                             <div id="alert-container"></div>
                                             <form id="qr-form" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                   <div class="col-md-6">
                                                      <div class="form-group mb-20">
                                                         <label class="mb-15">Qr Code Name</label>
                                                         <input type="text" class="form-control" placeholder="Qr Code Name" autocomplete="off" name="qr_code_name" value="{{ old('qr_code_name') }}">
                                                         <span class="text-danger error-message" id="error-qr_code_name"></span>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-6">
                                                      <div class="form-group mb-20">
                                                         <label class="mb-15">Status</label>
                                                         <div class="project-task-list__left d-flex align-items-center">
                                                            <select name="status" class="form-control form-control-lg">
                                                               <option value="">Select</option>
                                                               <option value="active">Active</option>
                                                               <option value="deactivated">Deactivated</option>
                                                               <option value="expired">Expired</option>
                                                            </select>
                                                         </div>
                                                         <span class="text-danger error-message" id="error-status"></span>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-md-6">
                                                      <div class="form-group mb-20">
                                                         <label class="mb-15">Check-in (Start time)</label>
                                                         <input type="datetime-local" class="form-control" autocomplete="off" name="check_in_at" value="{{ old('check_in_at') }}">
                                                         <span class="text-danger error-message" id="error-check_in_at"></span>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-6">
                                                      <div class="form-group mb-20">
                                                         <label class="mb-15">Checkout At</label>
                                                         <input type="datetime-local" class="form-control" autocomplete="off" name="checkout_at" value="{{ old('checkout_at') }}">
                                                         <span class="text-danger error-message" id="error-checkout_at"></span>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="button-group d-flex pt-25">
                                                   <button type="submit" class="btn btn-primary btn-default btn-squared text-capitalize" id="submit-btn">
                                                   Generate
                                                   </button>
                                                   <button type="button" class="btn btn-light btn-default btn-squared fw-400 text-capitalize b-light color-light" id="cancel-btn">
                                                   Cancel
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
               </div>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="project-top-wrapper project-top-progress d-flex justify-content-between flex-wrap">
                        <div class="project-top-left d-flex flex-wrap justify-content-lg-between justify-content-center mt-n10">
                           <div class="project-search project-search--height global-shadow ml-md-20 my-10 order-md-2 order-1">
                              <form id="search-qr" method="post" class="d-flex align-items-center user-member__form">
                                 @csrf
                                 <span data-feather="search"></span>
                                 <input name="query" autocomplete="off" class="form-control mr-sm-2 border-0 box-shadow-none" type="search" placeholder="Search by Name" aria-label="Search">
                              </form>
                              <!-- Add a div for displaying messages -->
                              <div style="padding-top: 20px;" id="message-container"></div>
                           </div>
                        </div>
                        <div class="project-top-right d-flex flex-wrap">
                           <div class="project-category">
                              <div class="d-flex align-items-center">
                                 <p class="mb-0 mr-10 fs-14 color-light">sort by:</p>
                                 <div class="project-category__select">
                                    <select class="js-example-basic-single js-states form-control" id="event-category">
                                       <option value="all" selected="">project category</option>
                                       <option value="JAN">event</option>
                                       <option value="FBR">Venues</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Tab Menu End -->
               <div class="projects-tab-content projects-tab-content--progress">
                  <div class="tab-content mt-25" id="ap-tabContent">
                     <div class="tab-pane fade show active" id="ap-overview" role="tabpanel" aria-labelledby="ap-overview-tab">
                        <div class="row">
                           <div class="col-12">
                              <div class="contact-list-wrap mb-25">
                                 <div class="contact-list bg-white radius-xl w-100">
                                    <div class="table-responsive">
                                       <table class="table mb-0 table-borderless table-rounded">
                                          <thead>
                                             <tr>
                                                <th>
                                                   <div class="d-flex align-items-center">
                                                      <div class="custom-checkbox  check-all">
                                                         <input class="checkbox" type="checkbox" id="check-3">
                                                         <label for="check-3">
                                                         <span class="checkbox-text userDatatable-title">Name</span>
                                                         </label>
                                                      </div>
                                                   </div>
                                                </th>
                                                <th class="c-email">
                                                   <span>Status</span>
                                                </th>
                                                <th class="c-company">
                                                   <span>Session ID</span>
                                                </th>
                                                <th class="c-position">
                                                   <span class="">Expires at</span>
                                                </th>
                                                <th class="c-phone">
                                                   <span class="">Action</span>
                                                </th>
                                                <th class="c-action">
                                                   <span class="float-right"></span>
                                                </th>
                                             </tr>
                                          </thead>
                                          <tbody> </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="d-flex justify-content-sm-end justify-content-star mt-1 mb-30">
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
                           <p id="modal-message">Some contents...</p>
                           <!-- Dynamic message will go here -->
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
         <!-- DELETE CONFIRMATION MODAL -->
         <div class="modal-info-delete modal fade" id="modal-info-delete" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-info" role="document">
               <div class="modal-content">
                  <div class="modal-body">
                     <div class="modal-info-body d-flex flex-column align-items-center">
                        <div class="modal-info-icon warning">
                           <span data-feather="info"></span>
                        </div>
                        <div class="modal-info-text text-center">
                           <h6>Do you want to delete this QR code?</h6>
                           <p>This action cannot be undone.</p>
                        </div>
                        <!-- QR Code Image -->
                        <img id="qr-code-preview" src="" alt="QR Code" class="img-fluid mt-2" style="max-width: 150px; display: none;">
                        <!-- QR Code name here -->
                        <p id="qr-name"></p>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger btn-outlined btn-sm" data-dismiss="modal">No</button>
                     <button type="button" class="btn btn-success btn-outlined btn-sm" id="confirm-delete">Yes</button>
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
      <audio style="display: none;" id="notification-sound" src="{{ asset('sounds/notification.mp3') }}" preload="auto"></audio>
      
      <div class="overlay-dark-sidebar"></div>
      <div class="customizer-overlay"></div>
      <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDduF2tLXicDEPDMAtC6-NLOekX0A5vlnY"></script>
      <!-- inject:js-->
      <script src="{{asset('js/plugins.min.js')}}"></script>
      <script src="{{asset('js/script.min.js')}}"></script>
      <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

      <script src="{{ asset('js/notification.js') }}" ></script>

      <!-- endinject-->
      <script>
         // Generate QR Code
         $(document).ready(function () {
             $('#qr-form').on('submit', function (e) {
                 e.preventDefault(); // Prevent default form submission
         
                 let formData = new FormData(this);
                 let submitButton = $('#submit-btn');
                 
                 submitButton.prop('disabled', true).text('Generating...'); // Disable button and show loading text
                 
                 $.ajax({
                     url: "{{ route('dashboard.qr.code.generate') }}", // Laravel route
                     type: "POST",
                     data: formData,
                     processData: false,
                     contentType: false,
                     dataType: "json",
                     success: function (response) {
                         $('.error-message').text(''); // Clear previous errors
                         $('#alert-container').html(`
                             <div class="alert alert-success">${response.message}</div>
                         `);
                         $('#qr-form')[0].reset(); // Reset the form
                     },
                     error: function (xhr) {
                         $('.error-message').text(''); // Clear previous errors
                         $('#alert-container').html(''); // Clear previous alerts
         
                         if (xhr.status === 422) { // Laravel validation error
                             let errors = xhr.responseJSON.errors;
                             $.each(errors, function (key, value) {
                                 $(`#error-${key}`).text(value[0]); // Show validation errors
                             });
         
                             $('#alert-container').html(`
                                 <div class="alert alert-danger">Please fix the errors below and try again.</div>
                             `);
                         } else {
                             $('#alert-container').html(`
                                 <div class="alert alert-danger">An unexpected error occurred. Please try again.</div>
                             `);
                         }
                     },
                     complete: function () {
                         submitButton.prop('disabled', false).text('Generate'); // Re-enable button
                     }
                 });
             });
         
             // Cancel button - clears form and removes alerts
             $('#cancel-btn').on('click', function () {
                 $('#qr-form')[0].reset();
                 $('.error-message').text('');
                 $('#alert-container').html('');
             });
         });
      </script>

      <script>
         $(document).ready(function () {
         let allDataUrl = "{{ route('dashboard.qr.code.all') }}";
         let searchUrl = "{{ route('search.qr') }}";
         
         function fetchAllQRCodeData() {
         $.ajax({
             url: allDataUrl,
             type: "GET",
             dataType: "json",
             success: function (response) {
                 if (Array.isArray(response) && response.length > 0) {
                     populateTable(response);
                 } else {
                     console.log("No data received, showing default.");
                     $("table tbody").html('<tr><td colspan="5" class="text-center">No QR Codes Found</td></tr>');
                 }
             },
             error: function (xhr, status, error) {
                 console.error("Error fetching QR codes:", error);
                 showError("Error loading data");
             }
         });
         }
         
         
         
         function fetchSearchQRCodeData(query) {
           $.ajax({
              url: searchUrl,
              type: "GET",
              data: { query: query },
              dataType: "json",
              success: function (response) {
         
                    if (!Array.isArray(response) || response.length === 0) {
                       console.log("No search results, loading default data.");
                       fetchAllQRCodeData(); // ✅ Load default data if search is empty
                    } else {
                       populateTable(response);
                    }
              },
              error: function (xhr, status, error) {
                    console.error("Error fetching search results:", error);
                    showError("Error fetching search results");
              }
           });
         }
         
         
         function populateTable(data) {
         let tableBody = $("table tbody");
         tableBody.empty(); // Clear existing data
         
         $.each(data, function (index, qr) {
             let imageUrl = `/qrcodes/${qr.qrcode}`;
             let row = `
                 <tr>
                     <td>
                         <div class="contact-item d-flex align-items-center">
                             <div class="contact-personal-wrap">
                                 <div class="checkbox-group-wrapper">
                                     <div class="checkbox-group d-flex">
                                         <div class="checkbox-theme-default custom-checkbox checkbox-group__single d-flex">
                                             <input class="checkbox" type="checkbox" id="check-${qr.id}">
                                             <label for="check-${qr.id}"></label>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="contact-personal-info d-flex">
                                 <a href="${imageUrl}" target="_blank" class="profile-image rounded-circle d-block m-0 wh-38"
                                 style="background-image:url('${imageUrl}'); background-size: cover;"></a>
                                 <div class="contact_title">
                                     <h6><a href="#">${qr.qr_code_name || 'N/A'}</a></h6>
                                 </div>
                             </div>
                         </div>
                     </td>
                     <td><span class="alert ${ qr.status == 'EXPIRED' ? 'alert-danger' : 'alert-success' }">${qr.status.toUpperCase() || 'N/A'}</span></td>
                     <td><span class="com-name">${qr.session_id || 'N/A'}</span></td>
                     <td><span class="position">${qr.expires_at || 'N/A'}</span></td>
                     <td>
                         <div class="d-flex gap-2">
                             <a class="btn btn-sm btn-primary" href="${imageUrl}" target="_blank">
                                 <i class="fa fa-eye"></i> View
                             </a>
                             <a class="btn btn-sm btn-danger delete-btn" data-name="${qr.qr_code_name}" data-qr="${imageUrl}" data-id="${qr.id}" href="javascript:void(0);">
                                 <i class="fa fa-trash"></i> Delete
                             </a>
                         </div>
                     </td>
                 </tr>
             `;
             tableBody.append(row);
         });
         }
         
         
         function showError(message) {
             let tableBody = $("table tbody");
             tableBody.html(`<tr><td colspan="5" class="text-center">${message}</td></tr>`);
         }
         
         // Prevent form submission (Search should work via AJAX)
         $("#search-qr").on("submit", function (e) {
             e.preventDefault();
         });
         
         // Live search
         $("#search-qr input[name='query']").on("keyup", function () {
             let query = $(this).val().trim();
         
             if (query.length > 0) {
                 fetchSearchQRCodeData(query);
             } else {
                 fetchAllQRCodeData();
             }
         });
         
         // Load all data initially
         fetchAllQRCodeData();
         
         // Refresh every 5 seconds
         setInterval(() => {
             let query = $("#search-qr input[name='query']").val().trim();
             if (query.length > 0) {
                 fetchSearchQRCodeData(query);
             } else {
                 fetchAllQRCodeData();
             }
         }, 5000);
         });
         
         
      </script>

      <script>
         // Delete QR Code
         let qrIdToDelete = null; // Store QR code ID
         
         $(document).on("click", ".delete-btn", function () {
            qrIdToDelete = $(this).data("id"); // Store QR code ID
            let qrImage = $(this).data("qr"); // Get QR Code Image URL
            let qrName = $(this).data("name"); // Get QR name
         
            if (qrImage) {
               $("#qr-code-preview").attr("src", qrImage).show(); // Set and show QR Code
               $("#qr-name").text(qrName).show();
            } else {
               $("#qr-code-preview").hide(); // Hide if no QR code found
            }
         
            $("#modal-info-delete").modal("show"); // Show modal
         });
         
         // When "Yes" button is clicked, delete the QR code
         $("#confirm-delete").on("click", function () {
            if (qrIdToDelete) {
               $.ajax({
                  url: "{{ route('delete.qr') }}", // Laravel route
                  type: "POST",
                  data: {
                     id: qrIdToDelete,
                     _method: "DELETE",
                     _token: "{{ csrf_token() }}"
                  },
                  success: function (response) {
                     showMessage("success", response.message);
                     $("button[data-id='" + qrIdToDelete + "']").closest("tr").remove(); // Remove row
                     $("#modal-info-delete").modal("hide"); // Close modal
                  },
                  error: function (xhr) {
                     let errorMessage = xhr.responseJSON?.message || "Error deleting QR code";
                     showMessage("danger", errorMessage);
                     $("#modal-info-delete").modal("hide");
                  },
               });
            }
         });
         
         // Function to show messages in a div
         function showMessage(type, message) {
            $("#message-container").html(
               `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
                  ${message}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>`
            );
         }
      </script>

      <script>
         // Logout Code
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

   <script>
      $(document).ready(function() {
         $('#sessionTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                  "url": "/get-all-qr-code", // Your API endpoint
                  "type": "GET",
                  "dataSrc": function(json) {
                     return json.data || [];
                  }
            },
            "columns": [
                  { "data": "name" },
                  { "data": "status" },
                  { "data": "session_id" },
                  { "data": "expires_at" },
                  { "data": "action" }
            ],
            "paging": true,
            "searching": true,
            "ordering": true
         });
      });
   </script>
      
   </body>
</html>