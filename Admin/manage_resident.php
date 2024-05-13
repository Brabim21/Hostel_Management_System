<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Residents</title>
    <link rel="stylesheet" href="managestaff.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
   .citizenship-image {
            max-width: 50px;
            max-height: 50px;
        }

        /* Overlay styles */
.overlay {
    display: none; /* Initially hidden */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    justify-content: center;
    align-items: center;
}

/* Form container styles */
.update-form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    max-width: 500px;
    width: 80%;
}

/* Form and input styles */
#updateUserForm {
    display: flex;
    flex-direction: column;
}

#updateUserForm label {
    margin-bottom: 5px;
    color: #666;
}

#updateUserForm input[type="text"],
#updateUserForm input[type="email"],
#updateUserForm input[type="password"],
#updateUserForm input[type="number"],
#updateUserForm select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-bottom: 15px;
}

#updateUserForm input[type="file"] {
    margin-bottom: 15px;
}

#updateUserForm button[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 20px;
}

#updateUserForm button[type="submit"]:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <nav class="left-nav">
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
            <li><a href="manage_payment.php">Payment Info</a></li>
            <li><a href="chat.php">Chat</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
    </nav>
    <div class="content">
        <h2>Residents</h2>
        <div class="search-container">
            <form method="get" action="">
                <input type="text" name="search" id="searchInput" placeholder="Search by resident name...">
                <button type="submit">Search</button>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Contact Number</th>
                    <th>Guardian Name</th>
                    <th>Guardian Contact Number</th>
                    <th>Address</th>
                    <th>Assigned Room</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection
                include '../configuration.php';

                // Initialize variables for search and pagination
                $search = isset($_GET['search'])? $_GET['search'] : '';
                $recordsPerPage = 10;
                $page = isset($_GET['page'])? $_GET['page'] : 1;
                $startFrom = ($page - 1) * $recordsPerPage;

                // SQL query with search condition
                $sql = "SELECT user_id, name, email, age, contact_number, guardian_name, guardian_contact_number, address, assigned_room_name, user_status 
                        FROM user";
                if (!empty($search)) {
                    $sql.= " WHERE name LIKE '%$search%'";
                }

                // Apply pagination to the query
                $sql.= " LIMIT $startFrom, $recordsPerPage";

                // Execute the query
                $result = mysqli_query($link, $sql);

                // Check if any records were found
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>". $row['user_id']. "</td>";
                        echo "<td>". $row['name']. "</td>";
                        echo "<td>". $row['email']. "</td>";
                        echo "<td>". $row['age']. "</td>";
                        echo "<td>". $row['contact_number']. "</td>";
                        echo "<td>". $row['guardian_name']. "</td>";
                        echo "<td>". $row['guardian_contact_number']. "</td>";
                        echo "<td>". $row['address']. "</td>";
                        echo "<td>". $row['assigned_room_name']. "</td>";
                        echo "<td>". ($row['user_status'] == 1? 'Approved' : 'Pending'). "</td>";
                        echo "<td>";
                        echo "<button class='btn btn-primary update-user' data-user-id='". $row['user_id']."' onclick='openEditUserOverlay(" . $row['user_id'] . ", \"" . $row['name'] . "\", \"" . $row['email'] . "\", " . $row['age'] . ", \"" . $row['contact_number'] . "\", \"" . $row['guardian_name'] . "\", \"" . $row['guardian_contact_number'] . "\", \"" . $row['address'] . "\", \"" . $row['assigned_room_name'] . "\")'>View/Update</button>";
                        echo "<button class='btn btn-danger delete-user' data-user-id='". $row['user_id']."'>Delete</button>";
                        
                        echo "</td>";
                        echo "</tr>";
                        
                    }
                } else {
                    echo "<tr><td colspan='11'>No residents found</td></tr>";
                }

                // Close the database connection
             ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php
            // Calculate total pages
            $totalRecordsQuery = "SELECT COUNT(*) FROM user";
            $totalRecordsResult = mysqli_query($link, $totalRecordsQuery);
            $totalRecords = mysqli_fetch_row($totalRecordsResult)[0];
            $totalPages = ceil($totalRecords / $recordsPerPage);

            // Generate pagination links
            for ($i = 1; $i <= $totalPages; $i++) {
                echo "<a href='?search=". urlencode($search). "&page=$i'>Page $i</a> ";
            }
            mysqli_close($link);

         ?>
        </div>
    </div>

<style>
    .add-user {
    margin-left: 240px; /* Adjust this value according to the width of your left navigation bar */
    padding: 20px;
    border: 1px solid #ddd;
    background-color: #f9f9f9;
}
</style>


<div class="add-user">
    <h2>Add User</h2>
    <form id="addUserForm" method="post" enctype="multipart/form-data">
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
        <label for="assignedRoomId">Assigned Room Id:</label>
        <select id="assignedRoomName" name="assignedRoomName" required>
            <option value="">Select a room</option>
            <?php
                $sql = "SELECT room_id, room_name FROM hostel";
                $result = mysqli_query($link, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='". $row['room_id']. "'>". $row['room_name']. "</option>";
                    }
                } else {
                    echo "<option value=''>No rooms found</option>";
                }
            ?> 
        </select>
        <br>
        <button type="submit">Add User</button>
    </form>
</div>


<div class="overlay">
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



 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

// Function to open the edit user overlay
function openEditUserOverlay(userId, name, email, age, contactNumber, guardianName, guardianContactNumber, address, assignedRoomName, assignedRoomId) {
    // Set values in the form fields
    document.getElementById("userId").value = userId; // Add hidden field for user ID
    document.getElementById("name").value = name;
    document.getElementById("email").value = email;
    document.getElementById("age").value = age;
    document.getElementById("contactNumber").value = contactNumber;
    document.getElementById("guardianName").value = guardianName;
    document.getElementById("guardianContactNumber").value = guardianContactNumber;
    document.getElementById("address").value = address;
    
    // Find the assigned room select element
    var assignedRoomSelect = document.getElementById("assignedRoomId");
    
    // Loop through options to find the one with the assigned room name
    for (var i = 0; i < assignedRoomSelect.options.length; i++) {
        if (assignedRoomSelect.options[i].text === assignedRoomName) {
            assignedRoomSelect.selectedIndex = i;
            break;
        }
    }

    // Display the overlay
    document.querySelector('.overlay').style.display = 'flex';
}

// Add event listener to the View/Update buttons with class 'btn btn-primary update-user'
document.addEventListener('DOMContentLoaded', function () {
    var updateButtons = document.querySelectorAll('.btn.btn-primary.update-user');
    updateButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var userId = this.getAttribute('data-user-id');
            var name = this.getAttribute('data-name');
            var email = this.getAttribute('data-email');
            var age = this.getAttribute('data-age');
            var contactNumber = this.getAttribute('data-contact-number');
            var guardianName = this.getAttribute('data-guardian-name');
            var guardianContactNumber = this.getAttribute('data-guardian-contact-number');
            var address = this.getAttribute('data-address');
            var assignedRoomName = this.getAttribute('data-assigned-room-name');
            var assignedRoomId = this.getAttribute('data-assigned-room-id');
            openEditUserOverlay(userId, name, email, age, contactNumber, guardianName, guardianContactNumber, address, assignedRoomName, assignedRoomId);
        });
    });

    // Add event listener to the close button
    document.querySelector('.close').addEventListener('click', closeOverlay);
});


</script>



</body>
</html>
