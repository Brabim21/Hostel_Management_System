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
    
            .update-form {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            z-index: 1001; /* ensure the form is above the overlay */
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
                <label for="assignedRoomId">Assigned Room Id:</label>
                <select id="assignedRoomId" name="assignedRoomId" required>
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
                
                <button type="submit">Update user details</button>
            </form>
        </div>
            </div>

 </div>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // Handle view/update button click
    $('.update-user').click(function() {
        var userId = $(this).data('user-id');
        // AJAX call to fetch user details from the server
        $.ajax({
            url: 'fetch_resident_details.php',
            method: 'POST',
            data: {userId: userId},
            dataType: 'json',
            success: function(response) {
                // Populate the form fields with fetched user details
                $('#name').val(response.name);
                $('#email').val(response.email);
                $('#age').val(response.age);
                $('#contactNumber').val(response.contact_number);
                $('#guardianName').val(response.guardian_name);
                $('#guardianContactNumber').val(response.guardian_contact_number);
                $('#address').val(response.address);
                $('#assignedRoomId').val(response.assigned_room_id);
                
                // Display the overlay
                $('.overlay').show();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    // Handle form submission when Add User button is clicked
    $('#addUserForm').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Collect form data
        var formData = new FormData(this);

        // Send form data to add_user.php using AJAX
        $.ajax({
            url: 'add_user.php',
            method: 'POST',
            data: formData,
            processData: false, // Prevent jQuery from automatically transforming the data into a query string
            contentType: false, // Prevent jQuery from setting the Content-Type header
            success: function(response) {
                console.log(response); // Log the response for debugging purposes
                // Optionally, you can redirect to another page or display a success message here
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log the error response for debugging purposes
                // Optionally, you can display an error message here
            }
        });
    });
});

function openEditUserOverlay(userId, name, email, age, contactNumber, guardianName, guardianContactNumber, address, assignedRoomId) {
    // Populate the form fields with existing user details
    document.getElementById('name').value = name;
    document.getElementById('email').value = email;
    document.getElementById('age').value = age;
    document.getElementById('contactNumber').value = contactNumber;
    document.getElementById('guardianName').value = guardianName;
    document.getElementById('guardianContactNumber').value = guardianContactNumber;
    document.getElementById('address').value = address;

    // Select the assigned room id in the dropdown
    var assignedRoomDropdown = document.getElementById('assignedRoomId');
    for (var i = 0; i < assignedRoomDropdown.options.length; i++) {
        if (assignedRoomDropdown.options[i].value === assignedRoomId) {
            assignedRoomDropdown.selectedIndex = i;
            break;
        }
    }

    // Display the overlay
    document.querySelector('.overlay').style.display = 'block';
}
</script>



</body>
</html>
