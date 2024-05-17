<?php
// Include the database configuration
include 'configuration.php';

// Include the password validation function
function validatePassword($password) {
    return preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password);
}

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
    $guardian_name = $_POST["guardian_name"]; // Include the guardian's name in form submission

    // Initialize a variable to track if the password is changed
    $password_changed = false;

    // Validate password complexity
    if (!empty($password) && !validatePassword($password)) {
        // Redirect back to the profile page with an error message
        header("Location: profile.php?password_err=Password must contain at least one uppercase letter, one number, and be at least 8 characters long.");
        exit();
    }

    // Update the user profile in the database
    $email = $_SESSION['email']; // Get the user's email from session or wherever it's stored
    $sql = "UPDATE user SET name=?, age=?, contact_number=?, citizenship_front=?, guardian_name=?, address=? ";
    $params = array($name, $age, $contact_number, $citizenship_front, $guardian_name, $address);

    // Append password update if it's not empty
    if (!empty($password)) {
        $sql .= ", password=?";
        $params[] = $password;
        $password_changed = true;
    }

    $sql .= " WHERE email=?";
    $params[] = $email;

    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, str_repeat("s", count($params)), ...$params);
    mysqli_stmt_execute($stmt);

    // Check if update was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // If password is changed, redirect to the login page
        if ($password_changed) {
            // Redirect to the login page
            header("Location: ResidentLogin.php");
            exit();
        } else {
            // Redirect to the profile page with a success message or any other appropriate action
            header("Location: profile.php?update=success");
            exit();
        }
    } else {
        // Redirect back to the profile page with an error message
        header("Location: profile.php?update=error");
        exit();
    }
}
?>
