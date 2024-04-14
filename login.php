<?php
require_once "configuration.php"; // Include database configuration

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // For admin users
    $stmt_admin = $link->prepare("SELECT email, password FROM admin WHERE email = ?");
    $stmt_admin->bind_param("s", $username);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();

    if ($result_admin->num_rows == 1) {
        $row_admin = $result_admin->fetch_assoc();
        $stored_password_admin = $row_admin['password'];

        // Verify the password
        if ($password === $stored_password_admin) { // Comparing plaintext passwords
            echo "success"; // Send success response
            exit; // Terminate script execution after sending response
        } else {
            echo "Incorrect password."; // Send error response
            exit; // Terminate script execution after sending response
        }
    } else {
        // For staff users
        $stmt_staff = $link->prepare("SELECT email, password FROM staff WHERE email = ?");
        $stmt_staff->bind_param("s", $username);
        $stmt_staff->execute();
        $result_staff = $stmt_staff->get_result();

        if ($result_staff->num_rows == 1) {
            $row_staff = $result_staff->fetch_assoc();
            $stored_password_staff = $row_staff['password'];

            // Verify the password
            if ($password === $stored_password_staff) { // Comparing plaintext passwords
                echo "success"; // Send success response
                exit; // Terminate script execution after sending response
            } else {
                echo "Incorrect password."; // Send error response
                exit; // Terminate script execution after sending response
            }
        } else {
            echo "No user found with the provided email."; // Send error response
            exit; // Terminate script execution after sending response
        }
    }
} else {
    echo "Invalid request method."; // Send error response
    exit;
}
?>
