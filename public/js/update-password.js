$(document).ready(function() {
    $('#password-form').on('submit', function(e) {
        e.preventDefault();

        // Clear previous error messages
        $('small[id^="error-"]').text('');
        $('#error-message').html('');

        $.ajax({
            url: '/dashboard/settings/update-password',
            method: 'POST',
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(response) {
                $('#error-message').html(`
                    <div class="alert alert-success">
                        Password updated successfully!
                    </div>
                `);

                // Clear message after 5 seconds
                setTimeout(() => {
                    $('#error-message').fadeOut('slow', function() {
                        $(this).html('').show();
                    });
                }, 5000);

                $('#password-form')[0].reset();
            },

            error: function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    for (const key in errors) {
                        $(`#error-${key}`).text(errors[key][0]);
                    }
                } else {
                    $('#error-message').html(`
                    <div class="alert alert-danger">
                        Something went wrong. Please try again.
                    </div>
                `);

                    // Clear error after 5 seconds
                    setTimeout(() => {
                        $('#error-message').fadeOut('slow', function() {
                            $(this).html('').show();
                        });
                    }, 5000);
                }
            }
        });
    });
});