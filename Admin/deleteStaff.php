<?php
// Include the database connection file
include '../configuration.php';

// Check if staff_id is provided
if (isset($_GET['staff_id'])) {
    // Sanitize the staff_id
    $staffId = mysqli_real_escape_string($link, $_GET['staff_id']);

    // Query to delete staff member
    $sql = "DELETE FROM staff WHERE staff_id = $staffId";

    // Execute the query
    if (mysqli_query($link, $sql)) {
        echo "Staff member deleted successfully.";
    } else {
        echo "Error deleting staff member: " . mysqli_error($link);
    }
} else {
    echo "Staff ID not provided.";
}

// Close the database connection
mysqli_close($link);
?>
