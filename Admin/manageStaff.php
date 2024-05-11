<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="managestaff.css">
    <title>Manage Staff</title>
    <style>
        .citizenship-image {
            max-width: 50px;
            max-height: 50px;
        }
/* General styles for the form container */
.add-staff {
    width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Heading style */
.add-staff h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

/* Form row layout */
.form-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

/* Half-width elements */
.half-width {
    width: 48%; /* Adjust for spacing */
}

/* Label styles */
label {
    display: block;
    margin-bottom: 5px;
    color: #666;
}

/* Input and button styles */
input[type="text"], input[type="email"], input[type="password"], input[type="number"], input[type="file"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

button[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 20px;
}

button[type="submit"]:hover {
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
            <li><a href="manage_resident.php">Residents</a></li>
            <li><a href="billing_details.php">Billing Details</a></li>
            <li><a href="manage_payment.php">Payment Info</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
    </nav>
    <div class="content">
        <h2>Staff Details</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Password</th>
                    <th>Address</th>
                    <th>Citizenship</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include the database connection file
                include '../configuration.php';

                // Query to fetch staff details
                $sql = "SELECT * FROM staff";

                // Execute the query
                $result = mysqli_query($link, $sql);

                // Check if any rows are returned
                if (mysqli_num_rows($result) > 0) {
                    // Loop through each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['staff_id'] . "</td>";
                        echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
                        echo "<td>" . $row['age'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['contact_number'] . "</td>";
                        echo "<td>" . $row['password'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td><img src='" . $row['citizenship_front'] . "' alt='Citizenship' class='citizenship-image'></td>";
                        echo "<td>";
                        echo "<button onclick='openEditOverlay(" . $row['staff_id'] . ", \"" . $row['first_name'] . "\", \"" . $row['last_name'] . "\", " . $row['age'] . ", \"" . $row['email'] . "\",\"" . $row['password'] . "\",  \"" . $row['contact_number'] . "\", \"" . $row['address'] . "\")'>Update</button>";
                        echo "<button onclick='confirmDelete(" . $row['staff_id'] . ")' class='delete-button'>Delete</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No staff found</td></tr>";
                }

                // Close the database connection
                mysqli_close($link);
                ?>
            </tbody>
        </table>

        <!-- Delete confirmation modal -->
        <div id="deleteModal" class="modal">
            <div class="modal-content delete-modal-content">
                <span class="close" onclick="closeModal('deleteModal')">&times;</span>
                <p>Are you sure you want to delete this staff?</p>
                <input type="hidden" id="staffIdToDelete">
                <button onclick="deleteStaff()">Delete</button>
                <button onclick="closeModal('deleteModal')" class="delete-button">Cancel</button>
            </div>
        </div>

    <style>
        /* Modal styles */
.modal {
    display: none; /* Initially hidden */
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5); /* Semi-transparent background */
    overflow: auto; /* Enable scrolling if needed */
    justify-content: center;
    align-items: center;
}

/* Modal content styles */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    border-radius: 8px;
    width: 80%;
    max-width: 500px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    position: relative;
    text-align: center; /* Center the buttons */
}

/* Close button styles */
.close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px;
    color: #aaa;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
}

/* Delete button styles */
.delete-button {
    background-color: #dc3545;
    color: #fff;
    margin-top: 10px;
}

.delete-button:hover {
    background-color: #c82333;
}

    </style>

        <!-- Update overlay modal -->
        <div id="editOverlay" class="overlay">
            <div class="overlay-content">
                <span class="close" onclick="closeOverlay('editOverlay')">&times;</span>
                <h2>Edit Staff Details</h2>
                <!-- Form for updating staff details -->
                <form id="updateForm" action="updatestaff.php" method="post">
                    <!-- Input fields for updating staff details -->
                    <!-- Populate these fields with existing staff details -->
                    <input type="hidden" id="staffId" name="staffId">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="firstName" required><br>
                    <label for="lastName">Last Name:</label>
                    <input type="text" id="lastName" name="lastName" required><br>
                    <label for="age">Age:</label>
                    <input type="number" id="age" name="age" required><br>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required><br>
                    <label for="email">Password:</label>
                    <input type="password" id="password" name="password" required><br>
                    <label for="contactNumber">Contact Number:</label>
                    <input type="text" id="contactNumber" name="contactNumber" required><br>
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" required><br>
                    <!-- Submit button for updating staff details -->
                    <button type="submit">Update</button>
                </form>
            </div>
        </div>

<!-- Pop up for this edit table  -->

<style>
    /* Overlay styles */
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: none; /* Initially hidden */
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

/* Overlay content styles */
.overlay-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 80%;
    max-width: 500px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    height: 70vh; /* Set a specific height, adjust as needed */
    overflow-y: auto; /* Enable vertical scrolling */
}


/* Close button styles */
.close {
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

/* Heading style */
.overlay-content h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

/* Form and input styles */
#updateForm {
    display: flex;
    flex-direction: column;
}

#updateForm label {
    margin-bottom: 5px;
    color: #666;
}

#updateForm input[type="text"], 
#updateForm input[type="email"], 
#updateForm input[type="password"], 
#updateForm input[type="number"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-bottom: 15px;
}

#updateForm button[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 20px;
}

#updateForm button[type="submit"]:hover {
    background-color: #0056b3;
}
#middle {
    width: 100%;
    height: 100px; /* Adjust based on your needs */
    overflow-y: auto; /* Trigger vertical scroll */
    overflow-x: hidden; /* Hide the horizontal scroll */
}

</style>


        <!-- JavaScript for overlay functionality -->
        <script>
            function openEditOverlay(staffId, firstName, lastName, age, email, contactNumber, address) {
                // Populate the form fields with existing staff details
                document.getElementById('staffId').value = staffId;
                document.getElementById('firstName').value = firstName;
                document.getElementById('lastName').value = lastName;
                document.getElementById('age').value = age;
                document.getElementById('email').value = email;
                document.getElementById('contactNumber').value = contactNumber;
                document.getElementById('address').value = address;

                // Display the overlay
                document.getElementById('editOverlay').style.display = 'block';
            }

            function closeOverlay(overlayId) {
                document.getElementById(overlayId).style.display = 'none';
            }

            function confirmDelete(staffId) {
                document.getElementById('deleteModal').style.display = 'block';
                // Store the staff ID in a hidden field in the modal
                document.getElementById('staffIdToDelete').value = staffId;
            }

            function deleteStaff() {
                // Get the staff ID from the hidden field in the modal
                var staffId = document.getElementById('staffIdToDelete').value;
                // Redirect to deleteStaff.php with the staff ID
                window.location.href = 'deletestaff.php?staffId=' + staffId;
            }

            function closeModal(modalId) {
                document.getElementById(modalId).style.display = 'none';
            }

                // Add event listener to the logout link
    document.getElementById('logout').addEventListener('click', function() {
        // Show a confirmation dialog
        if (confirm('Are you sure you want to logout?')) {
            // If user clicks OK, redirect to adminLogin.php
            window.location.href = 'adminLogin.php';
        } else {
            // If user clicks Cancel, do nothing
            return false;
        }
    });
        </script>

        <!-- Add Staff Form -->
<!-- Add Staff Form -->
<div class="add-staff">
    <h2>Add Staff</h2>
    <form id="addStaffForm" action="addstaff.php" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="half-width">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" required>
            </div>
            <div class="half-width">
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" required>
            </div>
        </div>

        <div class="form-row">
            <div class="half-width">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="half-width">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
        </div>

        <div class="form-row">
            <div class="half-width">
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" required>
            </div>
            <div class="half-width">
                <label for="citizenship">Citizenship Front:</label>
                <input type="file" id="citizenship" name="citizenship" accept="image/*" required>
            </div>
        </div>

        <div class="form-row">
            <div class="half-width">
                <label for="citizenship-back">Citizenship Back:</label>
                <input type="file" id="citizenship-back" name="citizenshipBack" accept="image/*" required>
            </div>
            <div class="half-width">
                <label for="contactNumber">Contact Number:</label>
                <input type="text" id="contactNumber" name="contactNumber" required>
            </div>
        </div>

        <div class="form-row">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
        </div>

        <button type="submit">Add Staff</button>
    </form>
</div>


</body>
</html>
