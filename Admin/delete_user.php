<?php
require_once 'db_connect.php'; // Include your database connection file

if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    // Check if the user exists
    $sql = "SELECT user_id FROM user WHERE user_id =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // User exists, proceed to delete
        $sql = "DELETE FROM user WHERE user_id =?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        echo "User deleted successfully";
    } else {
        echo "User not found";
    }
} else {
    echo "No user ID provided";
}

$stmt->close();
$conn->close();
?>
