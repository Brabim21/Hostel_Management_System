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
            <li><a href="#">Billing Details</a></li>
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
        <div class="add-staff">
            <h2>Add Staff</h2>
            <form id="addStaffForm" action="addstaff.php" method="post" enctype="multipart/form-data">

                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" required><br>
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" required><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br>
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" required><br>
                <label for="citizenship">Citizenship Front:</label>
                <input type="file" id="citizenship" name="citizenship" accept="image/*" required><br>
                <label for="citizenship-back">Citizenship Back:</label>
                <input type="file" id="citizenship-back" name="citizenshipBack" accept="image/*" required><br>

                <label for="contactNumber">Contact Number:</label>
                <input type="text" id="contactNumber" name="contactNumber" required><br>
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required><br>
                <button type="submit">Add Staff</button>
            </form>
        </div>

    </div>

</body>
</html>
