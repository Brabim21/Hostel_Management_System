<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System - Chat-Page</title>
    <link rel="stylesheet" href="chat.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .users-list {
            margin-left: 250px;
            margin-top: 20px;
        }
        .users-list h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .users-list p {
            margin: 10px 0;
        }
        .users-list p a {
            text-decoration: none;
            color: #0066cc;
            font-weight: bold;
            transition: color 0.3s;
        }
        .users-list p a:hover {
            color: #004080;
        }
    </style>
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
            <li><a href="manage_room.php">Rooms</a></li>
            <li><a href="managestaff.php">Staff</a></li>
            <li><a href="manage_resident.php">Residents</a></li>
            <li><a href="billing_details.php">Billing Details</a></li>
            <li><a href="manage_payment.php">Payment Info</a></li>
            <li><a href="admin_view_users.php">Chat</a></li>
            <li><a href="#" id="logout">Logout</a></li>
        </ul>
    </nav>
    <div class="users-list">
        <?php
        // admin_view_users.php

        // Enable error reporting
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        include('db_connection.php'); // include your database connection

        $query = "SELECT user_id, name, email FROM user";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die('Query Failed: ' . mysqli_error($conn));
        }

        echo "<h1>Users List</h1>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<p><a href='admin_chat.php?user_id=" . $row['user_id'] . "'>" . $row['name'] . "</a></p>";
        }
        ?>
    </div>
</body>
</html>
