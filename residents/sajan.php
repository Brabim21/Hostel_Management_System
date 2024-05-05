<!-- 
<?php
// Database configuration
define("DB_SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "hostel_management_system");

# Connection
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

# Check connection
if (!$link) {
  die("Connection failed: " . mysqli_connect_error());
}

# Set character set
mysqli_set_charset($link, "utf8");

// Function to validate email format
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@gmail\.com$/', $email);
}

// Redirect function
function redirectToDashboard() {
    header("location: ResidentDash.php");
    exit();
}

// Login handling
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username_err =""; $password_err = "";

    // Check if email is empty or invalid
    if (empty(trim($_POST["username"])) || !validateEmail(trim($_POST["username"]))) {
        $username_err = "Please enter a valid email address ending with '@gmail.com'.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // If email and password are provided, verify against database
    if (empty($username_err) && empty($password_err)) {
        // Prepare and execute SQL statement to fetch user data
        $sql = "SELECT user_id, email, password FROM `user` WHERE email = ?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $username;

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);

            // Check if email exists, then verify password
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $user_id, $db_username, $db_password);
                if (mysqli_stmt_fetch($stmt)) {
                    if (password_verify($password, $db_password)) {
                        // Password is correct, start a new session
                        session_start();
                        $_SESSION["user_id"] = $user_id;
                        redirectToDashboard();
                    } else {
                        // Password is incorrect
                        $password_err = "The password you entered is incorrect.";
                    }
                }
            } else {
                // No user found with the given email
                $username_err = "No account found with that email.";
            }
        } else {
            echo "Error: Unable to execute SQL statement.";
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System</title>
    <link rel="stylesheet" href="ResidentLogin.css">
</head>

<body>
    <div class="container">
        <img src="Hostel.jpg" alt="Hostel Image" class="background-image">
        <h1>Hostel Management System</h1>
        <h2>Account</h2>
        <form id="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Email/Registration Number:</label>
            <input type="text" id="username" name="username" placeholder="Your email or registration number">
            <span class="error"><?php echo isset($username_err) ? $username_err : ""; ?></span>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Your password">
            <span class="error"><?php echo isset($password_err) ? $password_err : ""; ?></span>

            <input type="submit" name="login" value="Login">
        </form>
        <a href="#" id="existing-user-link">Existing User</a> | <a href="#" id="new-user-link">New User</a>
        <div id="signup-form" style="display: none;">
            <h2>Sign Up</h2>
            <form action="signup.php" method="post">
                <label for="new-username">Email:</label>
                <input type="text" id="new-username" name="username" placeholder="Your email">

                <label for="new-password">Password:</label>
                <input type="password" id="new-password" name="password" placeholder="Your password">

                <input type="submit" value="Sign Up">
            </form>
        </div>
        <a href="#">Forgot password?</a>
    </div>

    <script>
        document.getElementById('existing-user-link').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior
            document.getElementById('login-form').style.display = 'block';
            document.getElementById('signup-form').style.display = 'none';
        });

        document.getElementById('new-user-link').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior
            document.getElementById('login-form').style.display = 'none';
            document.getElementById('signup-form').style.display = 'block';
        });
    </script>
</body>

</html> -->
