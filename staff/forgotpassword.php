<?php
// Database configuration
define("DB_SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "hostel_management_system");

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Create a PDO instance
    $dbh = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
} catch (PDOException $e) {
    // If connection fails, display an error message
    echo "Connection failed: " . $e->getMessage();
    die();
}

// Handle form submission
if (isset($_POST['update'])) {
    $email = trim($_POST['email']); // Trim leading/trailing spaces
    $newpassword = $_POST['newpassword'];
    $confirmpassword = $_POST['confirmpassword'];

    // Check if new password and confirm password match
    if ($newpassword === $confirmpassword) {
        // Make the email comparison case-insensitive
        $sql = "SELECT email FROM admin WHERE LOWER(email)=LOWER(:email)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            // Hash the new password for security
            $hashedPassword = password_hash($newpassword, PASSWORD_DEFAULT);

            $con = "UPDATE admin SET password=:newpassword WHERE LOWER(email)=LOWER(:email)";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $hashedPassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            echo "<script>alert('Your Password successfully changed');</script>";
        } else {
            echo "<script>alert('Email id is invalid');</script>";
        }
    } else {
        echo "<script>alert('New Password and Confirm Password do not match');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Recovery</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
  <style>
        body {
    font-family: 'Poppins', sans-serif;
    background-color: #f5f5f5;
  }
  .modal {
    display: block;
    background: rgba(0, 0, 0, 0.5);
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    overflow-y: auto; /* Added overflow-y for scrolling if needed */
  }
  .modal-dialog {
    margin: 50px auto;
    max-width: 400px;
    background: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2); /* Added box-shadow for a subtle effect */
  }
  .modal-title {
    font-size: 24px;
    text-align: center;
    margin-bottom: 20px;
  }
  .form-control {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
    transition: border-color 0.3s ease-in-out; /* Added transition for input focus effect */
  }
  .form-control:focus {
    border-color: #007bff; /* Updated focus border color */
  }
  .btn {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out; /* Added transition for button hover effect */
  }
  .btn:hover {
    background-color: #0056b3; /* Updated hover background color */
  }
  .text-center {
    text-align: center;
  }
  .gray-text {
    color: #666;
  }
  .close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 24px;
    color: #aaa;
    cursor: pointer;
  }
  </style>
</head>
<body>
  <div class="modal">
    <div class="modal-dialog">
      <div class="modal-header">
        <span class="modal-title">Password Recovery</span>
        <span class="close" onclick="closeModal()">×</span>
      </div>
      <div class="modal-body">
        <form name="chngpwd" method="post" onsubmit="return valid();">
          <input type="email" name="email" class="form-control" placeholder="Your Email address*" required=""><br>
          <input type="password" name="newpassword" class="form-control" placeholder="New Password*" required=""><br>
          <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password*" required=""><br>
          <input type="submit" value="Reset My Password" name="update" class="btn">
        </form>
        <div class="text-center">
          <p class="gray-text">For security reasons we don't store your password. Your password will be reset and a new one will be sent.</p>
          <p><a href="staffLogin.php" data-toggle="modal" onclick="closeModal()"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back to Login</a></p>
        </div>
      </div>
    </div>
  </div>

  <script>
    function valid() {
      if(document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
        alert("New Password and Confirm Password Field do not match  !!");
        document.chngpwd.confirmpassword.focus();
        return false;
      }
      return true;
    }

    function closeModal() {
      var modal = document.querySelector('.modal');
      modal.style.display = 'none';
    }
  </script>
</body>
</html>
