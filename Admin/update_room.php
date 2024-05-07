<?php
include_once "../configuration.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $roomId = $_POST['roomId'];
    $roomName = $_POST['roomName'];
    $roomPrice = $_POST['roomPrice'];
    $facility = $_POST['facility'];
    $residentCount = $_POST['residentCount'];

    // Sanitize form data to prevent SQL injection
    $roomId = mysqli_real_escape_string($link, $roomId);
    $roomName = mysqli_real_escape_string($link, $roomName);
    $roomPrice = mysqli_real_escape_string($link, $roomPrice);
    $facility = mysqli_real_escape_string($link, $facility);
    $residentCount = mysqli_real_escape_string($link, $residentCount);

    // Update room details in the database
    $updateSql = "UPDATE hostel SET room_name='$roomName', room_price='$roomPrice', facility='$facility', residents_count='$residentCount' WHERE room_id='$roomId'";

    if (mysqli_query($link, $updateSql)) {
        // Update successful
        echo "Room details updated successfully.";
    } else {
        // Update failed
        echo "Error updating room details: " . mysqli_error($link);
    }

    // Close the database connection
    mysqli_close($link);
}
?>