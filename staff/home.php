<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System - Staff Page</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script> <!-- Include your JavaScript file -->
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
                <p id="residentCount">Residents Count: 80</p>
                <img src="Residents.jpg" alt="Resident Image">
            </div>

            <div class="info-box">
                <h2>Maintenance</h2>
                <p id="maintenanceCount">Maintenance Count: 12</p>
                <img src="Maintenance.png" alt="Bed Image">
            </div>

            <div class="info-box">
                <h2>Total Events</h2>
                <p id="eventCount">Events Count: 4</p>
                <img src="Icon.png" alt="Resident Image">
            </div>

            <div class="info-box">
                <h2>Total Tasks</h2>
                <p id="taskCount">Task count: 20</p>
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

    <script>
        // Example JavaScript functionality to update counts dynamically
        const residentCountElement = document.getElementById('residentCount');
        const maintenanceCountElement = document.getElementById('maintenanceCount');
        const eventCountElement = document.getElementById('eventCount');
        const taskCountElement = document.getElementById('taskCount');

        // Simulate data update
        setInterval(() => {
            // Update counts randomly (for demonstration purposes)
            residentCountElement.textContent = `Residents Count: ${Math.floor(Math.random() * 100)}`;
            maintenanceCountElement.textContent = `Maintenance Count: ${Math.floor(Math.random() * 20)}`;
            eventCountElement.textContent = `Events Count: ${Math.floor(Math.random() * 10)}`;
            taskCountElement.textContent = `Task count: ${Math.floor(Math.random() * 30)}`;
        }, 5000); // Update every 5 seconds (adjust as needed)
    </script>
</body>
</html>
