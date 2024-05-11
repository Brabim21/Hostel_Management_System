<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resi.css">
    <title>Manage Resident</title>

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

        /* CSS for action buttons */
.action-buttons {
    display: flex;
    justify-content: space-around;
    gap: 8px;
    align-items: center;
}

.action-buttons button {
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.action-buttons .update-btn {
    background-color: #007bff;
    color: #fff;
}

.action-buttons .delete-btn {
    background-color: #dc3545;
    color: #fff;
}

.action-buttons button:hover {
    filter: brightness(90%);
}



.delete-btn:hover {
  background-color: #c82333;
}

/* delete btn cancel clcik button in a table */

.close-btn-update {
    position: absolute;
    top: 10px;
    right: 50px;
    font-size: 24px;
    cursor: pointer;
    color: #000;
    z-index: 101;
}

.close-btn-update:hover {
    color: #555;
}

/* Style for the cross inside the close button */
.close-btn-update::before,
.close-btn-update::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 30px;
    height: 2px;
    background-color: #000;
}

.close-btn-update::before {
    transform: translate(-50%, -50%) rotate(45deg);
}

.close-btn-update::after {
    transform: translate(-50%, -50%) rotate(-45deg);
}




/* Overlay styles */
.delete-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999; /* Ensure it's above other content */
}

.delete-modal {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    text-align: center;
    position: relative; /* Ensure close button is positioned relative to this container */
}

/* Close button styles */
.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background: none;
    border: none;
    cursor: pointer;
    font-size: 20px;
    color: #333;
}

/* Button styles */
#delete-btn-final,
#cancel-btn-final {
    padding: 10px 20px;
    margin: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

#delete-btn-final {
    background-color: #f44336; /* Red */
    color: white;
}

#cancel-btn-final {
    background-color: #ccc; /* Light gray */
    color: #333;
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
            <li><a href="#" id = "logout">Logout</a></li>
        </ul>
    </nav>

    <div class="top-part">
        <h1>Manage Resident</h1>
        <div class="table">
    <table>
        <tr>
            <td>Id</td>
            <td>Name</td>
            <td>Email</td>
            <td>Age</td>
            <td>Contact Number</td>
            <td>Guardian Name</td>
            <td>Guardian Contact Name</td>
            <td>Address</td>
            <td>Assigned Room</td>
            <td>Status</td>
            <td>Actions</td>
        </tr>
        <?php
        include '../configuration.php';

        // Query to select all users
        $sql = "SELECT * FROM `user`";
        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["user_id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["age"] . "</td>";
                echo "<td>" . $row["contact_number"] . "</td>";
                echo "<td>" . $row["guardian_name"] . "</td>";
                echo "<td>" . $row["guardian_contact_number"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td>" . $row["assigned_room_name"] . "</td>";
                echo "<td>" . ($row["user_status"] == 1 ? 'Active' : 'Inactive') . "</td>";
                // You can add actions like edit or delete here
                echo "<td class='action-buttons'>";
                echo "<button class='update-btn' id='update-btn-" . $row['user_id'] . "'>Update</button>";
                echo "<button class='delete-btn' id='delete-btn-" . $row['user_id'] . "'>Delete</button>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='11'>No users found</td></tr>";
        }

        // Close connection
        mysqli_close($link);
        ?>
    </table>
</div>

    </div>

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


<!-- update form -->

<div class="overlay">
<div class="close-btn-update" onclick="closeOverlay()">&times;</div>
 <div class="update-form">
 <form id="updateUserForm" method="POST" action="update_user.php">
                <label for="firstName">Name:</label>
                <input type="text" id="name" name="name" required><br>
                <label for="firstName">Email:</label>
                <input type="email" id="email" name="email" required><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br>
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" required><br>
                <label for="contactNumber">Contact Number:</label>
                <input type="text" id="contactNumber" name="contactNumber" required><br>
                <label for="citizenship">Citizenship Front:</label>
                <input type="file" id="citizenship" name="citizenship" accept="image/*" required><br>
                <label for="citizenship-back">Citizenship Back:</label>
                <input type="file" id="citizenship-back" name="citizenshipBack" accept="image/*" required><br>
                <label for="guardianName">Guardian Name:</label>
                <input type="text" id="guardianName" name="guardianName" required><br>
                <label for="guardianContactNumber">Guardian Contact Number:</label>
                <input type="text" id="guardianContactNumber" name="guardianContactNumber" required><br>
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required><br>
                <label for="assignedRoomName">Assigned Room:</label>
            <select id="assignedRoomName" name="assignedRoomName" required>
                <option value="">Select a room</option>
                <?php include 'get_rooms.php'; ?>
            </select>
                
                <button type="submit">Update user details</button>
            </form>
        </div>
            </div>

 </div>
 </div>
 </div>

 <div class="delete-overlay" >
    <div class="delete-modal">
        <button class="close-btn" onclick="closeModal()">×</button>
        <p>Are you sure you want to delete this user?</p>
        <button id="delete-btn-final">Delete</button>
        <button id="cancel-btn-final">Cancel</button>
    </div>
</div>



<script>

function closeModal() {
    document.querySelector('.delete-overlay').style.display = 'none';
    document.querySelector('.delete-modal').style.display = 'none';
}


document.getElementById('delete-btn-1').addEventListener('click', function() {
    document.querySelector('.delete-overlay').classList.remove('hidden');
});


// JavaScript for showing/hiding the update form overlay
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector('.overlay').style.display = 'none';
});

function showUpdateForm() {
    document.querySelector('.overlay').style.display = 'flex';
}

function closeOverlay() {
    document.querySelector('.overlay').style.display = 'none';
}

// Attach event listeners to the update buttons
document.querySelectorAll('.update-btn').forEach(btn => {
    btn.addEventListener('click', showUpdateForm);
});


// Attach event listener to the close button
document.querySelector('.close-btn').addEventListener('click', closeOverlay);

</script>

</body>
</html>