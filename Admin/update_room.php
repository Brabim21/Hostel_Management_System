<?php
include_once "../configuration.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $roomId = $_POST['roomId'];
    $roomName = $_POST['roomName'];
    $roomPrice = $_POST['roomPrice'];
    $facility = $_POST['facility'];
    $residentCount = $_POST['residentCount'];

    // Update room details in the database
    $updateSql = "UPDATE hostel SET room_name='$roomName', room_price='$roomPrice', facility='$facility', residents_count='$residentCount' WHERE room_id=$roomId";

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
