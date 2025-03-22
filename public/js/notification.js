$(document).ready(function() {
    let lastFetchedNotificationId = null;

    // Function to play the notification sound
    function playNotificationSound() {
        const notificationSound = document.getElementById('notification-sound');

        if (!notificationSound) {
            console.error('Audio element not found.');
            return;
        }

        notificationSound.play()
            .then(() => console.log('Notification sound played successfully.'))
            .catch(error => console.error('Error playing notification sound:', error));
    }

    // Function to fetch unread notifications
    function fetchUnreadNotifications() {
        $.ajax({
            url: '/dashboard/attendance/notifications/unread',
            method: 'GET',
            success: function(response) {
                const notifications = response.unreadNotifications;
                const notificationList = $('#notification-list');
                const unreadCount = $('#unread-notification-count');

                if (notifications.length > 0) {
                    const latestNotificationId = notifications[0].id;

                    // Play sound only if a new notification has arrived
                    if (lastFetchedNotificationId === null || latestNotificationId > lastFetchedNotificationId) {
                        playNotificationSound();
                        lastFetchedNotificationId = latestNotificationId;
                    }
                }

                // Clear existing notifications
                notificationList.empty();
                unreadCount.text(notifications.length);

                // Append each notification to the list
                notifications.forEach(function(notification) {
                    const notificationItem = `
                        <li class="nav-notification__single nav-notification__single--unread d-flex flex-wrap" data-id="${notification.id}">
                            <div class="nav-notification__type nav-notification__type--primary">
                                <span data-feather="inbox"></span>
                            </div>
                            <div class="nav-notification__details">
                                <p>
                                    <a href="#" class="subject stretched-link text-truncate" style="max-width: 180px;">${notification.data.message}</a>
                                </p>
                                <p>
                                    <span class="time-posted">${new Date(notification.data.timestamp).toLocaleString()}</span>
                                </p>
                            </div>
                        </li>
                    `;
                    notificationList.append(notificationItem);
                });

                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching notifications:', error);
            }
        });
    }

    // Fetch notifications on page load
    fetchUnreadNotifications();

    // Poll every 5 seconds to check for new notifications
    setInterval(fetchUnreadNotifications, 5000);


    // Mark notification as read when clicked
    $(document).on('click', '.nav-notification__single', function() {
        const notificationId = $(this).data('id');

        $.ajax({
            url: `/dashboard/attendance/notifications/mark-as-read/${notificationId}`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token
            },
            success: function(response) {
                // Remove the "unread" class and update the UI
                $(`[data-id="${notificationId}"]`).removeClass('nav-notification__single--unread');
                fetchUnreadNotifications(); // Refresh the notification list
            },
            error: function(xhr, status, error) {
                console.error('Error marking notification as read:', error);
            }
        });
    });

});
