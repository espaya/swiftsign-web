function fetchAttendanceData(page = 1) {
    $.ajax({
        url: "/dashboard/attendance/all",
        type: "GET",
        data: {
            page: page,
            per_page: 10 // Adjust as needed
        },
                success: function(response) {
                    const tbody = $("table tbody");
                    tbody.empty();

                    response.attendance.forEach((record, index) => {
                        tbody.append(`
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
                                <span class="bg-opacity-${record.status === 'SIGNED' ? 'success' : 'danger'} 
                                             color-${record.status === 'SIGNED' ? 'success' : 'danger'} 
                                             rounded-pill userDatatable-content-status">${record.status}</span>
                            </div>
                        </td>
                        <td>
                            <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                <li><a href="${record.id}" class="remove"><span data-feather="trash-2"></span></a></li>
                            </ul>
                        </td>
                    </tr>
                `);
                    });

                    renderPagination(response.pagination);
                    feather.replace();
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching attendance data:", error);
                }
            });
}

        function renderPagination(pagination) {
            const container = $("#pagination-container");
            container.empty();

            let {
                current_page,
                last_page
            } = pagination;

            // Previous
            container.append(`
        <li class="atbd-pagination__item">
            <a href="#" class="atbd-pagination__link pagination-control" data-page="${current_page - 1}" ${current_page === 1 ? 'disabled' : ''}>
                <span class="la la-angle-left"></span>
            </a>
        </li>
    `);

            // Pages
            for (let i = 1; i <= last_page; i++) {
                if (i === current_page || i === 1 || i === last_page || Math.abs(current_page - i) <= 1) {
                    container.append(`
                <li class="atbd-pagination__item">
                    <a href="#" class="atbd-pagination__link ${i === current_page ? 'active' : ''}" data-page="${i}">
                        <span class="page-number">${i}</span>
                    </a>
                </li>
            `);
                } else if (i === current_page - 2 || i === current_page + 2) {
                    container.append(`
                <li class="atbd-pagination__item"><span class="atbd-pagination__link">...</span></li>
            `);
                }
            }

            // Next
            container.append(`
        <li class="atbd-pagination__item">
            <a href="#" class="atbd-pagination__link pagination-control" data-page="${current_page + 1}" ${current_page === last_page ? 'disabled' : ''}>
                <span class="la la-angle-right"></span>
            </a>
        </li>
    `);
        }

        // Pagination click handler
        $(document).on("click", "#pagination-container .atbd-pagination__link", function(e) {
            e.preventDefault();
            const page = $(this).data("page");
            if (page) fetchAttendanceData(page);
        });

        // Initial load
        fetchAttendanceData();