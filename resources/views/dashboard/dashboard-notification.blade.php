<!doctype html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Notifications - SwiftSign</title>
      <!-- inject:css-->
      <link rel="stylesheet" href="{{asset('css/plugin.min.css')}}">
      <link rel="stylesheet" href="{{asset('style.css')}}">
      <!-- endinject -->
      <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png">
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
                              <h4 class="text-capitalize fw-500 breadcrumb-title">Notifications</h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               @foreach(['success', 'error'] as $type)
                    @if(session($type))
                        <div class="alert alert-{{ $type === 'success' ? 'success' : 'danger' }} alert-dismissible fade show" role="alert">
                            <div class="alert-content">
                                <p>{{ session($type) }}</p>
                                <button type="button" class="close text-capitalize" data-dismiss="alert" aria-label="Close">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x" aria-hidden="true">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endif
                @endforeach

               <div class="row">
                  <div class="col-lg-12">
                     <div class="userDatatable global-shadow border p-30 bg-white radius-xl w-100 mb-30">
                        <div class="table-responsive">
                        <table class="table mb-0 table-borderless">
                            <thead>
                                <tr class="userDatatable-header">
                                    <th width="60%">
                                        <div class="d-flex align-items-center">
                                            <div class="custom-checkbox check-all">
                                                <input class="checkbox" type="checkbox" id="check-all">
                                                <label for="check-all">
                                                    <span class="checkbox-text userDatatable-title">Message</span>
                                                </label>
                                            </div>
                                        </div>
                                    </th>
                                    <th width="25%">
                                        <span class="userDatatable-title">Time</span>
                                    </th>
                                    <th width="15%" class="text-right">
                                        <span class="userDatatable-title">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($notifications as $notification)
                                    @php
                                        $data = is_array($notification->data) ? $notification->data : json_decode($notification->data, true);
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="userDatatable__imgWrapper d-flex align-items-center mr-3">
                                                    <div class="checkbox-group-wrapper">
                                                        <div class="checkbox-group d-flex">
                                                            <div class="checkbox-theme-default custom-checkbox checkbox-group__single d-flex">
                                                                <input class="checkbox" type="checkbox" id="check-grp-{{ $notification->id }}">
                                                                <label for="check-grp-{{ $notification->id }}"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="userDatatable-inline-title">
                                                    <h6 class="text-dark fw-500 mb-0">{{ $data['message'] ?? 'No message content' }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="userDatatable-content">
                                                {{ $notification->created_at->format('M j, Y \a\t g:i a') }}
                                                <span class="d-block text-muted small">{{ $notification->created_at->diffForHumans() }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-end">
                                                <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                                    <li>
                                                        <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link text-danger p-0" 
                                                                    onclick="return confirm('Are you sure you want to delete this notification?')">
                                                                <span data-feather="trash-2" width="18"></span>
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            <div class="alert alert-info mb-0">No notifications found</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        </div>
                        <div class="d-flex justify-content-end pt-30">
                           <nav class="atbd-page">
                              <ul class="atbd-pagination d-flex">
                                 {{-- Previous Page Link --}}
                                 @if ($notifications->onFirstPage())
                                 <li class="atbd-pagination__item disabled">
                                    <span class="atbd-pagination__link pagination-control"><span class="la la-angle-left"></span></span>
                                 </li>
                                 @else
                                 <li class="atbd-pagination__item">
                                    <a href="{{ $notifications->previousPageUrl() }}" class="atbd-pagination__link pagination-control"><span class="la la-angle-left"></span></a>
                                 </li>
                                 @endif
                                 {{-- Pagination Elements --}}
                                 @foreach ($notifications->getUrlRange(1, $notifications->lastPage()) as $page => $url)
                                 @if ($page == $notifications->currentPage())
                                 <li class="atbd-pagination__item">
                                    <a href="{{ $url }}" class="atbd-pagination__link active"><span class="page-number">{{ $page }}</span></a>
                                 </li>
                                 @else
                                 <li class="atbd-pagination__item">
                                    <a href="{{ $url }}" class="atbd-pagination__link"><span class="page-number">{{ $page }}</span></a>
                                 </li>
                                 @endif
                                 @endforeach
                                 {{-- Next Page Link --}}
                                 @if ($notifications->hasMorePages())
                                 <li class="atbd-pagination__item">
                                    <a href="{{ $notifications->nextPageUrl() }}" class="atbd-pagination__link pagination-control"><span class="la la-angle-right"></span></a>
                                 </li>
                                 @else
                                 <li class="atbd-pagination__item disabled">
                                    <span class="atbd-pagination__link pagination-control"><span class="la la-angle-right"></span></span>
                                 </li>
                                 @endif
                                 {{-- Items Per Page Selector --}}
                                 <li class="atbd-pagination__item">
                                    <div class="paging-option">
                                       <select name="page-number" class="page-selection" onchange="window.location.href = '?per_page=' + this.value">
                                       <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10/page</option>
                                       <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20/page</option>
                                       <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50/page</option>
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
      <!-- inject:js-->
      <script src="{{asset('js/plugins.min.js')}}"></script>
      <script src="{{asset('js/script.min.js')}}"></script>
      <script src="{{ asset('js/notification.js') }}" ></script>

      <!-- endinject-->
   </body>
</html>