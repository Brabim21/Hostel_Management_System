<?php
// user_chat.php

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../Admin/db_connection.php'); // include your database connection

// Fetch the user_id from the query parameter
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

$admin_id = 1; // Assuming admin ID is 1, adjust accordingly

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $query = "INSERT INTO messages (sender_id, receiver_id, message, is_admin_sender) VALUES ($user_id, $admin_id, '$message', 0)";
    if (!mysqli_query($conn, $query)) {
        die('Error: ' . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Chat</title>
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

        #chat {
            margin-left: 250px;
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            overflow-y: auto;
            height: 300px;
        }

        #chat .message {
            margin-bottom: 20px;
        }

        #chat .message .sender {
            font-weight: bold;
            color: #333;
        }

        #chat .message .text {
            background-color: #f2f2f2;
            border-radius: 10px;
            padding: 10px;
            margin-left: 20px;
            display: inline-block;
            max-width: 70%;
        }

        #chat .message .text::after {
            content: "";
            clear: both;
            display: table;
        }

        #chat .message.admin .text {
            background-color: #e6f7ff;
        }

        /* Input form */
        form {
            margin-left: 250px;
            margin-top: 20px;
        }

        form textarea {
            width: calc(100% - 80px);
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            resize: none;
            margin-bottom: 10px;
        }

        form input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }
</style>
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
            <li><a href="#" id = "logout">Logout</a></li>
        </ul>
    </nav>

    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function fetchMessages() {
            $.ajax({
                url: 'fetch_user_messages.php',
                type: 'GET',
                data: { user_id: <?php echo $user_id; ?> },
                success: function(data) {
                    $('#chat').html(data);
                }
            });
        }

        $(document).ready(function() {
            fetchMessages(); // Initial fetch
            setInterval(fetchMessages, 2000); // Fetch new messages every 2 seconds
        });
    </script>
</head>
<body>
    <h1 style="margin-left: 250px">Chat with Admin</h1>
    <div id="chat" style="margin-left: 250px">
        <!-- Messages will be loaded here via AJAX -->
    </div>

    <form method="POST" style="margin-left: 250px">
        <textarea name="message"></textarea><br>
        <input type="submit" value="Send">
    </form>
</body>
</html>
