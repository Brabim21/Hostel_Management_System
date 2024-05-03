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

// Function to validate password complexity
function validatePassword($password) {
    return preg_match('/^(?=.*[A-Za-z])(?=.*\d).{8,}$/', $password);
}

try {
    // Create a PDO instance
    $dbh = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
} catch (PDOException $e) {
    // If connection fails, display an error message
    echo "Connection failed: " . $e->getMessage();
    die();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if name, email, and password are provided
    if (empty($_POST["name"])) {
        $name_err = "Name is required.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Check if email is empty or invalid
    if (empty($_POST["username"]) || !validateEmail($_POST["username"])) {
        $username_err = "Please enter a valid email address ending with '@gmail.com'.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty or doesn't meet complexity requirements
    if (empty($_POST["password"]) || !validatePassword($_POST["password"])) {
        $password_err = "Password must be at least 8 characters long and contain at least 1 letter and 1 number.";
    } else {
        $password = trim($_POST["password"]);
    }

    // If all fields are valid, insert data into the database
    if (empty($name_err) && empty($username_err) && empty($password_err)) {
        // Prepare and execute SQL statement to insert data into the database
        $sql = "INSERT INTO `user`(`name`, `email`, `password`) VALUES (:name, :email, :password)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":email", $username, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        if ($stmt->execute()) {
            // Redirect to success page or perform other actions
            header("location: success.php");
            exit();
        } else {
            echo "Error: Unable to execute SQL statement.";
        }
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
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" placeholder="Your name">
      <span class="error"><?php echo isset($name_err) ? $name_err : ""; ?></span>

      <label for="username">Email/Registration Number:</label>
      <input type="text" id="username" name="username" placeholder="Your email or registration number">
      <span class="error"><?php echo isset($username_err) ? $username_err : ""; ?></span>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Your password">
      <span class="error"><?php echo isset($password_err) ? $password_err : ""; ?></span>

      <input type="submit" value="Sign Up">
    </form>
    <a href="#" id="existing-user-link">Existing User</a> | <a href="#" id="new-user-link">New User</a>
    <div id="signup-form" style="display: none;">
      <h2>Sign Up</h2>
      <form action="residencelogin.php" method="post">
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
</html>
