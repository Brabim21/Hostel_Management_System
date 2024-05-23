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
    <link rel="stylesheet" href="manage_resident.css">
   
</head>
<body>
<<nav>
    <ul>
        <li>
            <img src="image/Hostel.avif" alt="Hostel Logo" class="logo">
            <a href="home.php">Dashboard</a>
        </li>
        <li><a href="manage_room.php">Rooms</a></li>
        <li><a href="managestaff.php">Staff</a></li>
        <li><a href="manage_resident.php">Residents</a></li>
        <li><a href="#">Billing Details</a></li>
        <li><a href="manage_payment.php">Payment Info</a></li>
        <li><a href="chat.php">Chat</a></li>
        <li><a href="#" id="logout">Logout</a></li>
    </ul>
</nav>
<h2 style="margin-left: 240px;">Manage Residents</h2>
<div id="table_container"> 
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
                <th>Actions</th>
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
                echo "<td> <img src='" . $row['citizenship_front'] . "' alt='Citizenship Front' style='width: 50px;'> </td>";
                echo "<td> <img src='" . $row['citizenship_back'] . "' alt='Citizenship Back' style='width: 50px;'> </td>";
                echo "<td>" . $row['guardian_name'] . "</td>";
                echo "<td>" . $row['guardian_contact_number'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['user_status'] . "</td>";
                echo "<td><a href='update_user.php?user_id=" . $row['user_id'] . "'>Update</a> | <a href='delete_user.php?user_id=" . $row['user_id'] . "'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<button class="add-resident-btn" id="addResidentBtn">Add Resident</button>

<!-- Modal for Add User Form -->
<div id="addUserModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
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
                <label for="contact_number">Contact Number:</label>
                <input type="text" id="contact_number" name="contact_number" required>
            </div>
            <div class="form-group">
                <label for="citizenship_front">Citizenship Front:</label>
                <input type="file" id="citizenship_front" name="citizenship_front" required>
            </div>
            <div class="form-group">
                <label for="citizenship_back">Citizenship Back:</label>
                <input type="file" id="citizenship_back" name="citizenship_back" required>
            </div>
            <div class="form-group">
                <label for="guardian_name">Guardian Name:</label>
                <input type="text" id="guardian_name" name="guardian_name" required>
            </div>
            <div class="form-group">
                <label for="guardian_contact_number">Guardian Contact Number:</label>
                <input type="text" id="guardian_contact_number" name="guardian_contact_number" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="assigned_room_name">Assigned Room Name:</label>
                <select id="assigned_room_name" name="assigned_room_name">
                    <option value="Room 1">Room 1</option>
                    <option value="Room 2">Room 2</option>
                    <option value="Room 3">Room 3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="user_status">User Status:</label>
                <select id="user_status" name="user_status">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>
            <button type="submit">Add User</button>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const addResidentBtn = document.getElementById("addResidentBtn");
    const modal = document.getElementById("addUserModal");
    const closeBtn = document.getElementsByClassName("close")[0];

    addResidentBtn.onclick = function() {
        modal.style.display = "flex";
    }

    closeBtn.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    const form = document.getElementById("addUserForm");
    form.addEventListener("submit", function(event) {
        event.preventDefault();

        const formData = new FormData(form);

        fetch("add_user.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
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
