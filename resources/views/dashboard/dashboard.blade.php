<!doctype html>
<html lang="en" dir="ltr">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>SwiftSign - Dashboard</title>
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
                        <h4 class="text-capitalize breadcrumb-title">Welcome, <span>{{ Auth::check() ? ucfirst(Auth::user()->name) : 'Admin' }}</span></h4>
                     </div>
                  </div>
                  <div class="col-xxl-4 col-sm-6  col-ssm-12 mb-30">
                     <!-- Card 2 End  -->
                     <div class="ap-po-details ap-po-details--2 p-25 radius-xl bg-white d-flex justify-content-between">
                        <div>
                           <div class="overview-content">
                              <h1 id="totalEmployee"></h1>
                              <p>Total Employee(s)</p>
                              <div class="ap-po-details-time">
                                 <span id="employeeChangeIcon">
                                    <!-- icon will be injected here -->
                                 </span>
                                 <strong id="employeeChangePercent"></strong>
                                 <small>Since last week</small>
                              </div>
                           </div>
                        </div>
                     </div>

                     <!-- Card 2 End  -->
                  </div>
                  <div class="col-xxl-4 col-sm-6  col-ssm-12 mb-30">
                     <!-- Card 1 -->
                     <div class="ap-po-details ap-po-details--2 p-25 radius-xl bg-white d-flex justify-content-between">
                        <div>
                           <div class="overview-content">
                              <h1 id="totalAttendance"></h1>
                              <p>Total Attendance(s)</p>
                              <div class="ap-po-details-time">
                                 <strong id="attendanceChangePercent"></strong>
                                 <span id="attendanceChangeIcon"></span>
                                 <small>Since last week</small>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- Card 1 End -->
                  </div>
                  <div class="col-xxl-4 col-sm-6  col-ssm-12 mb-30">
                     <!-- Card 3 -->
                     <div class="ap-po-details ap-po-details--2 p-25 radius-xl bg-white d-flex justify-content-between">
                        <div>
                           <div class="overview-content">
                              <h1 id="totalQrCode"></h1>
                              <p>Total QR Codes</p>
                              <div class="ap-po-details-time">
                                 <span id="qrCodeChangeIcon">
                                    <!-- icon will be injected here -->
                                 </span>
                                 <strong id="qrCodeChangePercent"></strong>
                                 <small>Since last week</small>
                              </div>
                           </div>
                        </div>
                     </div>

                     <!-- Card 3 End -->
                  </div>
                  <!-- <div class="col-xxl-3 col-sm-6  col-ssm-12 mb-30"> -->
                  <!-- Card 1 -->
                  <!-- <div class="ap-po-details ap-po-details--2 p-25 radius-xl bg-white d-flex justify-content-between">
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
                        </div> -->
                  <!-- Card 1 End -->
                  <!-- </div> -->
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
   <audio style="display: none;" id="notification-sound" src="{{ asset('sounds/notification.mp3') }}" preload="auto"></audio>
   <!-- inject:js-->
   <script src="{{asset('js/plugins.min.js')}}"></script>
   <script src="{{asset('js/script.min.js')}}"></script>
   <script src="{{ asset('js/notification.js') }}"></script>
   <script src="{{ asset('js/logout.js') }}"></script>

   <script>
      $(document).ready(function() {
         $.getJSON('/dashboard/data', function(data) {
            $('#totalAttendance').text(data.totals.attendance);
            $('#totalQrCode').text(data.totals.qrCode);
            $('#totalEmployee').text(data.totals.employee);
         });
      });
   </script>
   
   <script>
      $(document).ready(function() {
         $.getJSON('/dashboard/data', function(data) {
            // Totals
            $('#totalAttendance').text(data.totals.attendance);
            $('#totalQrCode').text(data.totals.qrCode);
            $('#totalEmployee').text(data.totals.employee);

            // Attendance Change
            updateChangeUI('attendance', data.changes.attendance);

            // QR Code Change
            updateChangeUI('qrCode', data.changes.qrCode);

            // Employee Change
            updateChangeUI('employee', data.changes.employee);
         });

         function updateChangeUI(type, change) {
            let icon = change >= 0 ? 'la-arrow-up' : 'la-arrow-down';
            let color = change >= 0 ? 'color-success' : 'color-danger';

            $(`#${type}ChangePercent`).text(`${change}%`);
            $(`#${type}ChangeIcon`).html(`<i class="las ${icon} ${color}"></i>`);
         }
      });
   </script>





   <!-- endinject-->
</body>

</html>