<?php
// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostel_management_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch statistics data
$sql = "SELECT residentCount, maintenanceCount, eventCount, taskCount FROM statistics_table";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch data and format as JSON
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo "No data found";
}

$conn->close();
?>


!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System - Staff Page</title>
    <link rel="stylesheet" href="style.css">
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
            <li><a href="#">Resident Info</a></li>
            <li><a href="#">Rooms</a></li>
            <li><a href="#">Tasks</a></li>
            <li><a href="#">Event Calendar</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
    </nav>
    <div class="content">
        <p>Welcome Staff!</p>
        
        <div class="info-box-container">
            <div class="info-box">
                <h2>Total Residents</h2>
                <p id="residentCount">Residents Count</p>
                <img src="Residents.jpg" alt="Resident Image">
            </div>

            <div class="info-box">
                <h2>Maintenance</h2>
                <p id="maintenanceCount">Maintenance Count</p>
                <img src="Maintenance.png" alt="Bed Image">
            </div>

            <div class="info-box">
                <h2>Total Events</h2>
                <p id="eventCount">Events Count</p>
                <img src="Icon.png" alt="Resident Image">
            </div>

            <div class="info-box">
                <h2>Total Tasks</h2>
                <p id="taskCount">Task count</p>
                <img src="Task.png" alt="Billing Image">
            </div>
        </div>

        <div class="graph-box-container">
            <div class="graph-box">
                <h2>Resident Status</h2>
                <img src="GraphStaff.png" alt="Residents Status">
            </div>
        </div>
    
        <!-- Your content goes here -->
    </div>
    <div class="admin-profile">
        <img src="Staff.jpg" alt="Staff Profile">
        <p>STAFF</p>
    </div>


    <script src="home.js"></script>
</body>
</html>
