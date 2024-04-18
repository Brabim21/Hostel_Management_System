<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Staff</title>
    <link rel="stylesheet" href="manageStaff.css">
</head>
<body>
    <h2>Staff Details</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Address</th>
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
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>";
                    echo "<button onclick='confirmDelete(" . $row['staff_id'] . ")'>Delete</button>";
                    echo "<button onclick='openEditOverlay(" . $row['staff_id'] . ")'>Update</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No staff found</td></tr>";
            }

            // Close the database connection
            mysqli_close($link);
            ?>
        </tbody>
    </table>

    <!-- Delete confirmation modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('deleteModal')">&times;</span>
            <p>Are you sure you want to delete this staff?</p>
            <button onclick="deleteStaff()">Delete</button>
            <button onclick="closeModal('deleteModal')">Cancel</button>
        </div>
    </div>

    <!-- Update overlay modal -->
    <div id="editOverlay" class="overlay">
        <div class="overlay-content">
            <span class="close" onclick="closeOverlay('editOverlay')">&times;</span>
            <h2>Edit Staff Details</h2>
            <!-- Form for updating staff details -->
            <!-- You can customize this form according to your requirements -->
            <form id="updateForm" action="updateStaff.php" method="post">
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
                <label for="contactNumber">Contact Number:</label>
                <input type="text" id="contactNumber" name="contactNumber" required><br>
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required><br>
                <!-- Submit button for updating staff details -->
                <button type="submit">Update</button>
            </form>
        </div>
    </div>

    <!-- JavaScript for modal and overlay functionality -->
    <script>
        function confirmDelete(staffId) {
            document.getElementById('deleteModal').style.display = 'block';
            // Store the staff ID in a hidden field in the modal
            document.getElementById('staffId').value = staffId;
        }

        function deleteStaff() {
            // Get the staff ID from the hidden field in the modal
            var staffId = document.getElementById('staffId').value;
            // Redirect to deleteStaff.php with the staff ID
            window.location.href = 'deleteStaff.php?staffId=' + staffId;
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function openEditOverlay(staffId) {
            // Retrieve staff details using AJAX and populate the update form
            // This function is beyond the scope of this example
            // You can implement it based on your application's requirements
        }

        function closeOverlay(overlayId) {
            document.getElementById(overlayId).style.display = 'none';
        }
    </script>









</body>
</html>
