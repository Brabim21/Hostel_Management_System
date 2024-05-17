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

$name_err = $email_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup"])) {

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
        // Check if email is a valid Gmail address
        if (!preg_match('/^[a-zA-Z0-9._%+-]+@gmail\.com$/', $email)) {
            $email_err = "Please enter a valid Gmail address.";
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
        // Check if password meets criteria (1 uppercase letter, 1 number, and length >= 8)
        if (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
            $password_err = "Password must contain at least one uppercase letter, one number, and be at least 8 characters long.";
        }
    }

    // Handle file uploads
    if (isset($_FILES['citizenship_front']) && isset($_FILES['citizenship_back'])) {
        $citizenship_front_tmp = $_FILES['citizenship_front']['tmp_name'];
        $citizenship_back_tmp = $_FILES['citizenship_back']['tmp_name'];

        $citizenship_front_name = $_FILES['citizenship_front']['name'];
        $citizenship_back_name = $_FILES['citizenship_back']['name'];

        // Store images in the project directory
        $citizenship_front_path = $citizenship_front_name;
        $citizenship_back_path = $citizenship_back_name;

        move_uploaded_file($citizenship_front_tmp, $citizenship_front_path);
        move_uploaded_file($citizenship_back_tmp, $citizenship_back_path);
    }

    // Check for errors before inserting into database
    if (empty($name_err) && empty($email_err) && empty($password_err)) {
        // Prepare and execute SQL statement to insert user data
        $sql = "INSERT INTO `user` (name, email, password, citizenship_front, citizenship_back) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_email, $param_password, $param_citizenship_front, $param_citizenship_back);
        $param_name = $name;
        $param_email = $email;
        $param_password = $password;
        $param_citizenship_front = $citizenship_front_path;
        $param_citizenship_back = $citizenship_back_path;

        if (mysqli_stmt_execute($stmt)) {
            // Sign up successful, redirect to login page
            header("location: ResidentLogin.php");
            exit();
        } else {
            // If insertion fails, display an error message
            echo "<script>alert('Error: Unable to sign up. Please try again later.');</script>";
        }
        mysqli_stmt_close($stmt);
    } else {
        // Redirect back to signup page with error messages
        header("location: ResidentSignup.php?name_err=$name_err&email_err=$email_err&password_err=$password_err");
        exit();
    }
}

// Close connection
mysqli_close($link);
?>
