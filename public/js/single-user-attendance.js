$(document).ready(function () {
   // Get the user ID from the current URL
    const urlSegments = window.location.pathname.split('/');
    const userId = urlSegments[urlSegments.length - 1];

    function fetchAttendanceData(page = 1) {
        $.ajax({
            url: `/dashboard/employees/get-employee-attendance-history/${userId}?page=${page}`,
            method: 'GET',
            success: function (response) {
                if (response.success) {
                    const attendanceData = response.data;
                    renderAttendanceTable(attendanceData);
                    renderPagination(response.pagination);
                } else {
                    const error = $('#attendance-response').html('No Data Found').addClass('alert alert-info');

                    error.show();

                    setTimeout(() => error.hide(), 3000);
                }
            },
            error: function () {
                
                const error = $('#attendance-response').html('An error occurred while fetching the data').addClass('alert alert-danger');
                
                error.show();

                setTimeout(() => error.hide(), 3000);
            }
        });
    }

    // Initial fetch
    fetchAttendanceData();

    // Fetch data when a pagination link is clicked
    $(document).on('click', '.pagination-link', function () {
        const page = $(this).data('page');
        fetchAttendanceData(page);
    });

function renderAttendanceTable(data) {
    let tbody = '';
    data.forEach(item => {
        tbody += `
            <tr>
                <td>
                    <div class="d-flex">
                        <div class="userDatatable__imgWrapper d-flex align-items-center">
                            <div class="checkbox-group-wrapper">
                                <div class="checkbox-group d-flex">
                                    <div class="checkbox-theme-default custom-checkbox checkbox-group__single d-flex">
                                        <input class="checkbox" type="checkbox" id="check-grp-${item.id}">
                                        <label for="check-grp-${item.id}"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="userDatatable-inline-title">
                            <a href="#" class="text-dark fw-500">
                                <h6>${item.qr_code_name}</h6>
                            </a>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="userDatatable-content">${item.logged_at}</div>
                </td>
                <td>
                    <div class="userDatatable-content">${item.signed_out_at}</div>
                </td>
                <td>
                    <div class="userDatatable-content">${item.expired}</div>
                </td>
                <td>
                    <div class="userDatatable-content d-inline-block">
                        <span class="${item.status === 'LATE' ? 'bg-opacity-danger color-danger' : 'bg-opacity-success color-success'} rounded-pill userDatatable-content-status active">${item.status}</span>
                    </div>
                </td>
            </tr>
        `;
    });

    $('tbody').html(tbody);
    
    // Initialize feather icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
}



function renderPagination(pagination) {
    const { totalPages, currentPage } = pagination;
    let paginationLinks = '';

    const maxVisiblePages = 5; // You can adjust this number
    const sidePages = Math.floor(maxVisiblePages / 2);

    let startPage = Math.max(1, currentPage - sidePages);
    let endPage = Math.min(totalPages, currentPage + sidePages);

    if (startPage > 1) {
        paginationLinks += `
            <li class="atbd-pagination__item">
                <a href="javascript:void(0)" class="atbd-pagination__link pagination-link" data-page="1">
                    <span class="page-number">1</span>
                </a>
            </li>
        `;
        if (startPage > 2) {
            paginationLinks += `<li class="atbd-pagination__item disabled"><span class="page-number">...</span></li>`;
        }
    }

    for (let i = startPage; i <= endPage; i++) {
        paginationLinks += `
            <li class="atbd-pagination__item ${i === currentPage ? 'active' : ''}">
                <a href="javascript:void(0)" class="atbd-pagination__link pagination-link" data-page="${i}">
                    <span class="page-number">${i}</span>
                </a>
            </li>
        `;
    }

    if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
            paginationLinks += `<li class="atbd-pagination__item disabled"><span class="page-number">...</span></li>`;
        }
        paginationLinks += `
            <li class="atbd-pagination__item">
                <a href="javascript:void(0)" class="atbd-pagination__link pagination-link" data-page="${totalPages}">
                    <span class="page-number">${totalPages}</span>
                </a>
            </li>
        `;
    }

    $('.atbd-pagination').html(paginationLinks);
}

});
