$(document).ready(function() {
            $("#employeeForm").on("submit", function(e) {
                e.preventDefault();

                $(".text-danger").text(""); // Clear previous errors
                let formData = new FormData(this); // Get form data

                $.ajax({
                    url: "{{ route('dashboard.employees.new') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    beforeSend: function() {
                        $("#save-button").attr("disabled", true).text("Submitting...");
                        $("#staticBackdropLabel").text("Submitting...");
                        $("#status-message").removeClass("alert-success alert-danger").addClass("d-none").text("");
                    },
                    success: function(response) {
                        $("#save-button").attr("disabled", false).text("Save");
                        $("#staticBackdropLabel").text("Employee Information");

                        // Show success message
                        $("#status-message")
                            .removeClass("d-none alert-danger")
                            .addClass("alert alert-success")
                            .text(response.message);

                        $("#employeeForm")[0].reset(); // Reset form on success
                    },
                    error: function(xhr) {
                        $("button").attr("disabled", false).text("Save");
                        $("#staticBackdropLabel").text("Employee Information");

                        if (xhr.status === 422) { // Validation error
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $(".error-" + key).text(value[0]); // Show field-specific errors
                            });

                            // Show error message
                            $("#status-message")
                                .removeClass("d-none alert-success")
                                .addClass("alert alert-danger")
                                .text("Please fix the errors below.");
                        } else {
                            $("#status-message")
                                .removeClass("d-none alert-success")
                                .addClass("alert alert-danger")
                                .text("An unexpected error occurred. Please try again.");
                        }
                    }
                });
            });
        });