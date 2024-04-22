<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System - Staff Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        nav {
            background-color: #333;
            color: #fff;
            width: 200px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: left;
        }
        nav ul li {
            margin-bottom: 10px;
        }
        nav ul li a {
            display: block;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            transition: background-color 0.3s;
        }
        nav ul li a:hover {
            background-color: #555;
        }
        nav ul li a:hover .logo {
            transform: scale(1.1); /* Example hover effect */
        }
        .logo {
            width: 100px; /* Adjust as needed */
            margin-bottom: 20px; /* Spacing between logo and links */
            transition: transform 0.3s; /* Transition effect */
        }
        .content {
            margin-left: 220px; /* Adjust based on nav width */
            padding: 20px;
            text-align: center;
        }
        .admin-profile {
            position: fixed;
            top: 10px;
            right: 20px;
            text-align: center;
            color: #333;
        }
        .admin-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #fff;
        }
        .info-box-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        .info-box {
            border: 2px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            text-align: center;
            width: 200px;
            transition: transform 0.3s; /* Transition effect */
        }
        .info-box img {
            max-width: 100px;
            max-height: 100px;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .info-box:hover {
            transform: scale(1.1); /* Example hover effect */
        }
        .graph-box-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        .graph-box {
            border: 2px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            text-align: center;
            width: 450px; /* Adjusted width */
            height: 300px; /* Adjusted height */
            transition: transform 0.3s; /* Transition effect */
        }
        .graph-box:hover {
            transform: scale(1.1); /* Example hover effect */
        }
        .graph-box h2 {
            margin-top: 0;
        }
        .graph-box img {
            max-width: 400px; /* Adjusted width */
            max-height: 250px; /* Adjusted height */
            border-radius: 10px;
            margin-top: 10px;
        }
    </style>
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
                <p>Residents Count: 80</p>
                <img src="Residents.jpg" alt="Resident Image">
            </div>

            <div class="info-box">
                <h2>Maintenance</h2>
                <p>Maintenance Count: 12</p>
                <img src="Maintenance.png" alt="Bed Image">
            </div>

            <div class="info-box">
                <h2>Total Events</h2>
                <p>Events Count: 4</p>
                <img src="Icon.png" alt="Resident Image">
            </div>

            <div class="info-box">
                <h2>Total Tasks</h2>
                <p>Task count: 20</p>
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
</body>
</html>
