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
                $sql = "SELECT user_id, name, email, age, contact_number, guardian_name, guardian_contact_number, address, assigned_room_id, user_status 
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
                        echo "<td>". $row['assigned_room_id']. "</td>";
                        echo "<td>". ($row['user_status'] == 1? 'Approved' : 'Pending'). "</td>";
                        echo "<td>";
                        echo "<button class='btn btn-primary update-user' data-user-id='". $row['user_id']."' data-toggle='modal' data-target='#userDetailsModal'>View/Update</button>";
                        echo "<button class='btn btn-danger delete-user' data-user-id='". $row['user_id']."' data-toggle='modal' data-target='#userDetailsModal'>Delete</button>";
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
                
                <button type="submit">Add User</button>
            </form>
        </div>


    <!-- Modal for user details -->
<div class="modal fade" id="userDetailsModal" tabindex="-1" role="dialog" aria-labelledby="userDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userDetailsModalLabel">User Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="userDetailsForm">
                    <!-- User details form fields will be populated here -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update-user-btn" data-dismiss="modal">Update</button>
                <button type="button" class="btn btn-danger delete-user-btn" data-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Function to show user details in a modal
    function showUserDetails(userId) {
        $.ajax({
            url: 'fetch_user_details.php',
            method: 'POST',
            data: {userId: userId},
            success: function(response) {
                var userDetails = JSON.parse(response);
                $('#userDetailsModal #userDetailsForm').html(`
                    <input type="hidden" name="user_id" value="${userDetails.user_id}">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="${userDetails.name}" class="form-control">
                    </div>
                    <!-- Add other fields as needed -->
                `);
                $('#userDetailsModal').modal('show');
            }
        });
    }

    // Handle update button click
    $('body').on('click', '.update-user', function() {
        var userId = $(this).data('user-id');
        showUserDetails(userId);
    });

    // Handle delete button click
    $('body').on('click', '.delete-user', function() {
        var userId = $(this).data('user-id');
        if (confirm('Are you sure you want to delete this user?')) {
            $.ajax({
                url: 'delete_user.php',
                method: 'POST',
                data: {userId: userId},
                success: function(response) {
                    location.reload(); // Reload the page to reflect the changes
                }
            });
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('addUserForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Collect form data
        var formData = new FormData(this);

        // Send the form data to adduser.php using AJAX
        fetch('adduser.php', {
            method: 'POST',
            body: formData
        })
       .then(response => response.text())
       .then(data => {
            console.log(data); // Log the response text for debugging
            // Redirect back to manage_resident.php
            window.location.href = 'manage_resident.php';
        })
       .catch(error => {
            console.error('Error:', error);
        });
    });
});
</script>


</body>
</html>
