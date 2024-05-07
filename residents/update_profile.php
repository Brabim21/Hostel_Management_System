<?php
// Include the database configuration
include 'configuration.php';

// Check if user is logged in
session_start();
if (!isset($_SESSION['email'])) {
    header("location: ResidentLogin.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $age = $_POST["age"];
    $contact_number = $_POST["contact_number"];
    $password = $_POST["password"];
    $citizenship_front = $_POST["citizenship_front"];
    $address = $_POST["address"];

    // Update the user profile in the database
    $email = $_SESSION['email']; // Get the user's email from session or wherever it's stored
    $sql = "UPDATE user SET name=?, age=?, contact_number=?, password=?, citizenship_front=?, address=? WHERE email=?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "sisssss", $name, $age, $contact_number, $password, $citizenship_front, $address, $email);
    mysqli_stmt_execute($stmt);

    // Check if update was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Redirect back to the profile page with a success message
        header("Location: profile.php?update=success");
        exit();
    } else {
        // Redirect back to the profile page with an error message
        header("Location: profile.php?update=error");
        exit();
    }
}
?>
