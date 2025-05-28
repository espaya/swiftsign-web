$(document).ready(function() {
            function fetchEmployees(page = 1) {
                $.ajax({
                    url: "/dashboard/employees/all?page=" + page,
                    type: "GET",
                    success: function(response) {
                        updateTable(response.employees);
                        renderPagination(response.pagination);
                    }
                });
            }

            function updateTable(employees) {
                $("#employeeBody").html("");
                $.each(employees, function(index, employee) {
                    $("#employeeBody").append(`
                <tr>
                    <td>${employee.fullname}</td>
                    <td>${employee.position}</td>
                    <td>${employee.employee_id}</td>
                    <td>${employee.phone}</td>
                    <td>
                        <div class="d-flex">
                            <a href="/dashboard/employees/${employee.userID}" title="View" class="border-0 bg-transparent view-btn me-3">
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

            function renderPagination(pagination) {
                const {
                    current_page,
                    last_page
                } = pagination;
                let pagesHTML = '';

                // Prev
                pagesHTML += `<li><a href="#" class="atbd-pagination__link pagination-btn" data-page="${current_page - 1}" ${current_page === 1 ? 'disabled' : ''}><span class="la la-angle-left"></span></a></li>`;

                // Page numbers (scalable)
                const maxVisiblePages = 5;
                let start = Math.max(current_page - Math.floor(maxVisiblePages / 2), 1);
                let end = Math.min(start + maxVisiblePages - 1, last_page);

                if (end - start < maxVisiblePages - 1) {
                    start = Math.max(end - maxVisiblePages + 1, 1);
                }

                for (let i = start; i <= end; i++) {
                    pagesHTML += `<li><a href="#" class="atbd-pagination__link pagination-btn ${i === current_page ? 'active' : ''}" data-page="${i}"><span class="page-number">${i}</span></a></li>`;
                }

                // Next
                pagesHTML += `<li><a href="#" class="atbd-pagination__link pagination-btn" data-page="${current_page + 1}" ${current_page === last_page ? 'disabled' : ''}><span class="la la-angle-right"></span></a></li>`;

                $(".atbd-pagination").html(`<ul class="atbd-pagination d-flex">${pagesHTML}</ul>`);
            }

            // Handle pagination clicks
            $(document).on("click", ".pagination-btn", function(e) {
                e.preventDefault();
                const page = parseInt($(this).data("page"));
                if (!isNaN(page)) {
                    fetchEmployees(page);
                }
            });

            // Initial load
            fetchEmployees();
        });