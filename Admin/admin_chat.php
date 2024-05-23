<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System - Chat-Page</title>
    <link rel="stylesheet" href="chat.css">
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
            <li><a href="#" id = "logout">Logout</a></li>
        </ul>
    </nav>

<?php
// admin_chat.php

include('db_connection.php'); // include your database connection

$user_id = $_GET['user_id'];
$admin_id = 1; // Assuming admin ID is 1, adjust accordingly

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    $query = "INSERT INTO messages (sender_id, receiver_id, message, is_admin_sender) VALUES ($admin_id, $user_id, '$message', 1)";
    mysqli_query($conn, $query);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Chat</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function fetchMessages() {
            $.ajax({
                url: 'fetch_messages.php',
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

<style>

    #chat{

        width: 500px;
        height: 300px;
        border: 1px solid black;
        overflow-y: scroll;
        padding: 10px;
    
    }

    .text-box{

        margin-left: 250px;
        margin-top: 20px;
        width: 500px;
        height: 50px;
    }
</style>

    <h1 style="margin-left: 250px">Chat with User</h1>
    <div id="chat" style="margin-left: 250px">

        <!-- Messages will be loaded here via AJAX -->
    </div>

    <form method="POST" class = "text-box" >
        <textarea name="message"></textarea><br>
        <input type="submit" value="Send">
    </form>
</body>
</html>
