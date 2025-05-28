$(document).ready(function() {
    $('#logout-link').click(function(e) {
        e.preventDefault(); // Prevent default link behavior

        $.ajax({
            url: '/logout', // Your logout route
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
            },
            success: function(response) {
                if (response.success) {
                     window.location.href = response.redirect || '/login'; // Redirect to login page
                } else {
                    // Update modal content and show it
                    $('#modal-message').text(response.message || "Logout failed.");
                    $('#modal-info-warning').modal('show');
                }
            },
            error: function(xhr) {
                // Update modal content and show it for errors
                $('#modal-message').text("An error occurred. Please try again.");
                $('#modal-info-warning').modal('show');
            }
        });
    });
});