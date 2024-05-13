<?php
// Include database connection and setup
include_once "../configuration.php";

// Query to fetch user table data
$query = "SELECT * FROM user";
$result = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Residents</title>
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

    .container {
        margin-left: 220px; /* Adjust based on nav width */
        padding: 20px;
    }

    .small-table {
        margin-left: 220px; /* Add left margin */
        font-size: 12px; /* Adjust the font size */
    }

    .small-table th,
    .small-table td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 2px; /* Adjust the padding */
    }

    .small-table th {
        background-color: #f2f2f2;
    }

.add-user {
            margin-left: 220px; /* Adjust based on nav width */
            padding: 20px;
            text-align: center;
        }


</style>

</head>
<body>
<nav>
        <ul>
            <li>
                <a href="home.php">
                    <img src="image/Hostel.avif" alt="Hostel Logo" class="logo">
                    Dashboard
                </a>
            </li>
            <li><a href="manage_room.php">Rooms</a></li>
            <li><a href="managestaff.php">Staff</a></li>
            <li><a href="#">Residents</a></li>
            <li><a href="billing_details.php">Billing Details</a></li>
            <li><a href="chat.php">Chat</a></li>
            <li><a href="manage_payment.php">Payment Info</a></li>
            <li><a href="#" id="logout">Logout</a></li>
        </ul>
    </nav>
    <h2  style="margin-left: 220px;">Manage Residents</h2>
    <table class="small-table">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Contact Number</th>
                <th>Citizenship Front</th>
                <th>Citizenship Back</th>
                <th>Guardian Name</th>
                <th>Guardian Contact Number</th>
                <th>Address</th>
                <th>Assigned Room Name</th>
                <th>User Status</th>
                <th>Actions</th> <!-- New column for actions -->
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['user_id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['age'] . "</td>";
                echo "<td>" . $row['contact_number'] . "</td>";
                echo "<td> <img src= '" .$row['citizenship_front'] . "' alt='Citizenship Front' style='width: 50px;'> </td>";
                echo "<td> <img src= '" .$row['citizenship_back'] . "' alt='Citizenship Back' style='width: 50px;'> </td>";
                echo "<td>" . $row['guardian_name'] . "</td>";
                echo "<td>" . $row['guardian_contact_number'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['assigned_room_name'] . "</td>";
                echo "<td>" . $row['user_status'] . "</td>";
                echo "<td><a href='update_user.php?user_id=" . $row['user_id'] . "'>Update</a> | <a href='delete_user.php?user_id=" . $row['user_id'] . "'>Delete</a></td>"; // Update and delete buttons
                echo "</tr>";
            }
           
            ?>
        </tbody>
    </table>


    <div class="add-user">
    <h2>Add User</h2>
    <form id="addUserForm" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>
        </div>
        <div class="form-group">
            <label for="contactNumber">Contact Number:</label>
            <input type="text" id="contactNumber" name="contactNumber" required>
        </div>
        <div class="form-group">
            <label for="citizenship">Citizenship Front:</label>
            <input type="file" id="citizenship" name="citizenship" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="citizenship-back">Citizenship Back:</label>
            <input type="file" id="citizenship-back" name="citizenshipBack" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="guardianName">Guardian Name:</label>
            <input type="text" id="guardianName" name="guardianName" required>
        </div>
        <div class="form-group">
            <label for="guardianContactNumber">Guardian Contact Number:</label>
            <input type="text" id="guardianContactNumber" name="guardianContactNumber" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="assignedRoomName">Assigned Room:</label>
            <select id="assignedRoomName" name="assignedRoomName" required>
                <option value="">Select a room</option>
                <?php include 'get_rooms.php'; ?>
            </select>
        </div>

        <button type="submit">Add User</button>
    </form>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the form element
        const form = document.getElementById("addUserForm");

        // Add event listener for form submission
        form.addEventListener("submit", function(event) {
            // Prevent default form submission
            event.preventDefault();

            // Create FormData object to collect form data
            const formData = new FormData(form);

            // Make a POST request to add_user.php with form data
            fetch("add_user.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Display the response message
                alert(data);
                // Redirect to the desired page if needed
                window.location.href = "manage_resident.php";
            })
            .catch(error => {
                console.error("Error:", error);
            });
        });
    });
</script>

    
</body>
</html>
