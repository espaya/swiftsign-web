$(document).on("click", ".remove", function(e) {
            e.preventDefault(); // Prevent default anchor behavior

            let recordId = $(this).attr("href"); // Get the record ID
            $("#record-info").text("Record ID: " + recordId); // Show record info

            // Store ID in modal button for later use
            $("#confirm-delete").data("record-id", recordId);

            // Show the modal
            $("#modal-info-delete").modal("show");
        });

        // When "Yes" is clicked in the modal
        $(document).on("click", "#confirm-delete", function() {
            let recordId = $(this).data("record-id"); // Retrieve stored record ID
            let deleteUrl = `/your-delete-route/${recordId}`; // Define your delete route

            $.ajax({
                url: deleteUrl,
                type: "DELETE",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"), // CSRF token
                },
                success: function(response) {
                    let messageHtml = `<div class="alert alert-success">${response.message}</div>`;
                    $("#message-box").html(messageHtml); // Show success message

                    // Remove the item from the UI
                    $(`a[href="${recordId}"]`).closest("li").remove();

                    // Hide the modal after deletion
                    $("#modal-info-delete").modal("hide");
                },
                error: function(xhr) {
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

                    // Clear error after 5 seconds
                        setTimeout(() => {
                            $('#message-box').fadeOut('slow', function() {
                                $(this).html('').show();
                            });
                        }, 3000);

                    // Hide the modal after showing the error
                    $("#modal-info-delete").modal("hide");
                },
            });
        });