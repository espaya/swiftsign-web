$(document).ready(function() {
            $('#update-username-email-button').on('click', function(e) {
                e.preventDefault(); // Prevent form submission

                // Clear previous error messages
                $('small[id^="error-"]').text('');
                $('#error-message').html('');

                // Gather form data
                const formData = {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    _token: $('meta[name="csrf-token"]').attr('content') // CSRF Token
                };

                // Get current user values (you should have these pre-populated in hidden fields or data attributes)
                const currentName = $('#current-name').val(); // Assuming this is a hidden input with current name value
                const currentEmail = $('#current-email').val(); // Assuming this is a hidden input with current email value

                // Check if there are any changes
                if (formData.name === currentName && formData.email === currentEmail) {
                    $('#error-message').html(`
                    <div class="alert alert-warning">
                        No changes detected. Please update your name or email.
                    </div>
                `);
                    return; // Stop the request if no changes
                }

                // Send the form data to the server
                $.ajax({
                    url: '/dashboard/settings/update-username-email', // Your route URL
                    method: 'POST',
                    data: formData,
                    success: function(response, textStatus, jqXHR) {

                        if (response && response.message) {
                            // Handle success
                            $('#error-message').html(`
                            <div class="alert alert-success">
                                ${response.message}
                            </div>
                        `);
                        } else {
                            console.error('Unexpected response format', response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("Error response:", xhr.responseText); // Log the error response

                        if (status === 'timeout') {
                            $('#error-message').html(`
                            <div class="alert alert-warning">
                                The request timed out. Please try again later.
                            </div>
                        `);
                        }
                        // Handle validation errors (422)
                        else if (xhr.status === 422) {
                            const errors = xhr.responseJSON ? xhr.responseJSON.errors : {};
                            for (const key in errors) {
                                $(`#error-${key}`).text(errors[key][0]);
                            }
                        }
                        // Handle Not Modified error (304) - custom message from server
                        else if (xhr.status === 304) {
                            $('#error-message').html(`
                            <div class="alert alert-warning">
                                ${xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'No changes were made.'}
                            </div>
                        `);
                        }
                        // Handle Internal Server Error (500) - custom message from server
                        else if (xhr.status === 500) {
                            $('#error-message').html(`
                            <div class="alert alert-danger">
                                ${xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Something went wrong on the server. Please try again later.'}
                            </div>
                        `);
                        }
                        // Handle other errors
                        else {
                            $('#error-message').html(`
                            <div class="alert alert-danger">
                                Something went wrong. Please try again.
                            </div>
                        `);
                        }
                    }
                });
            });
        });