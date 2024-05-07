<?php
require_once 'db_connect.php'; // Include your database connection file

if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    $sql = "SELECT * FROM user WHERE user_id =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    echo json_encode($user);
}
$stmt->close();
$conn->close();
?>
