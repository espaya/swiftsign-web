$(document).ready(function() {
    let lastFetchedNotificationId = null;
    let isInitialLoad = true; // Flag to track initial page load

    // Function to play the notification sound
    function playNotificationSound() {
        const notificationSound = document.getElementById('notification-sound');
        if (!notificationSound) return;

        notificationSound.play()
            .catch(error => console.error('Error playing sound:', error));
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
                    const latestNotification = notifications[0];
                    
                    // Only play sound if:
                    // 1. It's not the initial page load
                    // 2. We have a new notification that wasn't in the previous fetch
                    if (!isInitialLoad && 
                        (lastFetchedNotificationId === null || 
                         latestNotification.id > lastFetchedNotificationId)) {
                        playNotificationSound();
                    }
                    
                    lastFetchedNotificationId = latestNotification.id;
                }

                // Update UI
                notificationList.empty();
                unreadCount.text(notifications.length);

                notifications.forEach(function(notification) {
                    const notificationItem = `
                        <li class="nav-notification__single ${notification.read_at ? '' : 'nav-notification__single--unread'} d-flex flex-wrap" data-id="${notification.id}">
                            <div class="nav-notification__type nav-notification__type--primary">
                                <span data-feather="inbox"></span>
                            </div>
                            <div class="nav-notification__details">
                                <p>
                                    <a href="#" class="subject stretched-link text-truncate" style="max-width: 180px;">${notification.data.message}</a>
                                </p>
                                <p>
                                    <span class="time-posted">${new Date(notification.created_at).toLocaleString()}</span>
                                </p>
                            </div>
                        </li>
                    `;
                    notificationList.append(notificationItem);
                });

                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
                
                // After first load, set flag to false
                isInitialLoad = false;
            },
            error: function(xhr, status, error) {
                console.error('Error fetching notifications:', error);
            }
        });
    }

    // Initial fetch
    fetchUnreadNotifications();

    // Poll every 5 seconds
    const pollInterval = setInterval(fetchUnreadNotifications, 5000);

    // Mark as read handler
    $(document).on('click', '.nav-notification__single', function() {
        const notificationId = $(this).data('id');
        $.ajax({
            url: `/dashboard/attendance/notifications/mark-as-read/${notificationId}`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function() {
                $(`[data-id="${notificationId}"]`).removeClass('nav-notification__single--unread');
                fetchUnreadNotifications();
            }
        });
    });

    // Clean up interval when leaving page
    $(window).on('beforeunload', function() {
        clearInterval(pollInterval);
    });
});