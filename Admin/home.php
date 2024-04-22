<?php include_once "../configuration.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System - Admin Page</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <nav>
        <ul>
            <li>
                <a href="#">
                    <img src="image/Hostel.avif" alt="Hostel Logo" class="logo">
                    Dashboard
                </a>
            </li>
            <li><a href="#">Rooms</a></li>
            <li><a href="#">Staff</a></li>
            <li><a href="#">Residents</a></li>
            <li><a href="#">Billing Details</a></li>
            <li><a href="#">Payment Info</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
    </nav>
    <div class="content">
        <p>Welcome Admin!</p>
        
        <div class="info-box-container">
            <?php
                // Query to get total counts
                $roomCountQuery = "SELECT COUNT(*) AS totalRooms FROM hostel";
                $staffCountQuery = "SELECT COUNT(*) AS totalStaff FROM staff";
                $residentCountQuery = "SELECT COUNT(*) AS totalResidents FROM user";

                // Execute queries
                $roomCountResult = mysqli_query($link, $roomCountQuery);
                $staffCountResult = mysqli_query($link, $staffCountQuery);
                $residentCountResult = mysqli_query($link, $residentCountQuery);

                // Fetch counts
                $roomCount = mysqli_fetch_assoc($roomCountResult)['totalRooms'];
                $staffCount = mysqli_fetch_assoc($staffCountResult)['totalStaff'];
                $residentCount = mysqli_fetch_assoc($residentCountResult)['totalResidents'];
            ?>

            <div class="info-box">
                <h2>Total Rooms</h2>
                <p class="total-room">Room Number: <?php echo $roomCount; ?></p>
                <img src="image/Room.png" alt="Room Image">
            </div>

            <div class="info-box">
                <h2>Total Staff</h2>
                <p class="total-staff">Staff Count: <?php echo $staffCount; ?></p>
                <img src="image/staff.jpg" alt="Bed Image">
            </div>

            <div class="info-box">
                <h2>Total Residents</h2>
                <p class="total-staff">Residents Count: <?php echo $residentCount; ?></p>
                <img src="image/Residents.jpg" alt="Resident Image">
            </div>

            <div class="info-box">
                <h2>Total Billing</h2>
                <p class="total-payment">Total Amount: $5000</p>
                <img src="image/Payment.png" alt="Billing Image">
            </div>
        </div>

        <div class="graph-box-container">
            <div class="graph-box">
                <h2>Yearly Report</h2>
                <img src="image/Yearly.jpg" alt="Yearly Report Graph">
            </div>

            <div class="graph-box">
                <h2>Monthly Report</h2>
                <img src="image/Monthly.ppm" alt="Monthly Report Graph">
            </div>
        </div>

        <!-- Your content goes here -->
    </div>
    <div class="admin-profile">
        <img src="image/Admin.jpg" alt="Admin Profile">
        <p>ADMIN</p>
    </div>
    <script>
        // JavaScript code for hover effect
        const infoBoxes = document.querySelectorAll('.info-box');
        const graphBoxes = document.querySelectorAll('.graph-box');

        infoBoxes.forEach(box => {
            box.addEventListener('mouseenter', () => {
                box.style.transform = 'scale(1.1)';
            });

            box.addEventListener('mouseleave', () => {
                box.style.transform = 'scale(1)';
            });
        });

        graphBoxes.forEach(box => {
            box.addEventListener('mouseenter', () => {
                box.style.transform = 'scale(1.1)';
            });

            box.addEventListener('mouseleave', () => {
                box.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>
