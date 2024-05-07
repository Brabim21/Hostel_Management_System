<?php
// Database configuration
define("DB_SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "hostel_management_system");

// Connection
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set character set
mysqli_set_charset($link, "utf8");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup"])) {
    $name_err = $email_err = $password_err = "";

    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Check for errors before inserting into database
    if (empty($name_err) && empty($email_err) && empty($password_err)) {
        // Prepare and execute SQL statement to insert user data
        $sql = "INSERT INTO `user` (name, email, password, age, contact_number, guardian_name, guardian_contact_number, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssss", $param_name, $param_email, $param_password, $param_age, $param_contact_number, $param_guardian_name, $param_guardian_contact_number, $param_address);
        $param_name = $name;
        $param_email = $email;
        $param_password = $password; // Password is not hashed
        $param_age = $_POST["age"];
        $param_contact_number = $_POST["contact_number"];
        $param_guardian_name = $_POST["guardian_name"];
        $param_guardian_contact_number = $_POST["guardian_contact_number"];
        $param_address = $_POST["guardian_address"];

        if (mysqli_stmt_execute($stmt)) {
            // Sign up successful, redirect to login page
            header("location: ResidentLogin.php");
            exit();
        } else {
            // If insertion fails, display an error message
            echo "<script>alert('Error: Unable to sign up. Please try again later.');</script>";
        }
        mysqli_stmt_close($stmt);
    }
}

// Close connection
mysqli_close($link);
?>
