<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System - Resident Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <ul>
            <li>
                <a href="#">
                    <img src="Hostel.avif" alt="Hostel Logo" class="logo">
                    Dashboard
                </a>
            </li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Book Facilities</a></li>
            <li><a href="#">My Payments</a></li>
            <li><a href="#">Maintenance Requests</a></li>
            <li><a href="#">Notifications</a></li>
            <li><a href="#">Chats</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
    </nav>
    <div class="content">
        <p>Welcome Resident!</p>
        
        <div class="info-box-container">
            <div class="info-box">
                <h2>Booking Status</h2>
                <p>You have no current bookings.</p>
                <img src="Icon.png" alt="Booking Status">
            </div>

            <div class="info-box">
                <h2>Payment Due</h2>
                <p>No payments due at the moment.</p>
                <img src="Payment.png" alt="Payment Due">
            </div>

            <div class="info-box">
                <h2>Notification</h2>
                <p>No new notifications.</p>
                <img src="Notification.jpg" alt="Notifications">
            </div>
        </div>

        <div class="task-box-container">
            <div class="task-box">
                <h2>Tasks</h2>
                <p>You have no tasks assigned.</p>
                <img src="Task.png" alt="Tasks">
            </div>
        </div>

        <div class="separator-bar"></div> <!-- Separating bar -->

        <div class="reservation-details">
            <h2>Ongoing Reservation</h2>
            <p>Room Number: 305</p>
            <p>Reservation Period: April 25, 2024 - April 28, 2024</p>
            <p>Room Type: Single Room</p>
            <p>Room Cleaning: Not Yet Cleaned</p>
            <button>Cancel Reservation</button>
        </div>

        <!-- Your content goes here -->
    </div>
    <div class="resident-profile">
        <img src="Residents.jpg" alt="Resident Profile">
        <p>RESIDENT</p>
    </div>
</body>
</html>
