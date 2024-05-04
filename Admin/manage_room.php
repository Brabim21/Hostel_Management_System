<?php include_once "../configuration.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Room</title>
    <link rel="stylesheet" href="manage_room.css">
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
            <li><a href="#">Rooms</a></li>
            <li><a href="managestaff.php">Staff</a></li>
            <li><a href="#">Residents</a></li>
            <li><a href="#">Billing Details</a></li>
            <li><a href="manage_payment.php">Payment Info</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
    </nav>

    <div class="content">
        <h1>Manage Room</h1>

        <table>
            <thead>
                <tr>
                    <th>Room Name</th>
                    <th>Room Price</th>
                    <th>Facility</th>
                    <th>Resident Count</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM hostel";
                $result = mysqli_query($link, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['room_name'] . "</td>";
                        echo "<td>" . $row['room_price'] . "</td>";
                        echo "<td>" . nl2br($row['facility']) . "</td>";
                        echo "<td>" . (isset($row['residents_count']) ? $row['residents_count'] : 'N/A') . "</td>";
                        echo "<td>";
                        echo "<button onclick='openEditOverlay(" . $row['room_id'] . ", \"" . $row['room_name'] . "\", " . $row['room_price'] . ", \"" . $row['facility'] . "\", " . (isset($row['residents_count']) ? $row['residents_count'] : 'N/A') . ")'>Update</button>";



                        echo "<button onclick='confirmDelete(" . $row['room_id'] . ")' class='delete-button'>Delete</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No rooms found</td></tr>";
                }
                mysqli_close($link);
                ?>
            </tbody>
        </table>

        <!-- Update overlay modal -->
        <div id="editOverlay" class="overlay">
            <div class="overlay-content">
                <span class="close" onclick="closeOverlay('editOverlay')">&times;</span>
                <h2>Edit Room Details</h2>
                <form id="updateForm" method="post" action="update_room.php">
                    <input type="hidden" id="roomId" name="roomId">
                    <label for="roomName">Room Name:</label>
                    <input type="text" id="roomName" name="roomName" required><br>
                    <label for="roomPrice">Room Price:</label>
                    <input type="text" id="roomPrice" name="roomPrice" required><br>
                    <label for="facility">Facility:</label>
                    <input type="text" id="facility" name="facility" required><br>
                    <label for="residentCount">Resident Count:</label>
                    <input type="text" id="residentCount" name="residentCount"><br>
                    <button type="submit">Update</button>
                </form>
            </div>
        </div>

        <!-- Add Room section -->

        <div id="addRoomSection">
            <h2>Add Room</h2>
            <form id="addRoomForm" method="post" action="add_room.php">
                <label for="roomName">Room Name:</label>
                <input type="text" id="roomName" name="roomName" required><br>
                <label for="roomPrice">Room Price:</label>
                <input type="text" id="roomPrice" name="roomPrice" required><br>
                <label for="facility">Facility:</label>
                <textarea id="facility" name="facility" rows="4" required></textarea><br>
                <label for="residentCount">Resident Count:</label>
                <input type="text" id="residentCount" name="residentCount"><br>
                <button type="submit">Add Room</button>
            </form>
        </div>

        <!-- Delete confirmation modal -->
        <div id="deleteModal" class="modal">
            <div class="modal-content delete-modal-content">
                <span class="close" onclick="closeModal('deleteModal')">&times;</span>
                <p>Are you sure you want to delete this room?</p>
                <input type="hidden" id="roomIdToDelete">
                <button onclick="deleteRoom()">Delete</button>
                <button onclick="closeModal('deleteModal')" class="delete-button">Cancel</button>
            </div>
        </div>

    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('facility').addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                var facilityInput = document.getElementById('facility');
                var facilityText = facilityInput.value.trim(); // Remove leading and trailing whitespace
                if (facilityText !== '') {
                    facilityInput.value += '\n- '; // Add dash for each facility
                }
            }
        });
    });

  

    function openEditOverlay(roomId, roomName, roomPrice, facility, residentCount) {
    // Populate the form fields with existing room details
    document.getElementById('roomId').value = roomId;
    document.getElementById('roomName').value = roomName;
    document.getElementById('roomPrice').value = roomPrice;
    document.getElementById('facility').value = facility;
    document.getElementById('residentCount').value = residentCount;

    // Display the overlay
    document.getElementById('editOverlay').style.display = 'block'; 
}


    function confirmDelete(roomId) {
        document.getElementById('deleteModal').style.display = 'block';
        // Store the room ID in a hidden field in the modal
        document.getElementById('roomIdToDelete').value = roomId;
    }

    function deleteRoom() {
        var roomId = document.getElementById('roomIdToDelete').value;
        window.location.href = 'delete_room.php?roomId=' + roomId;
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    function closeOverlay(overlayId) {
        document.getElementById(overlayId).style.display = 'none';
    }
</script>




</body>
</html>
