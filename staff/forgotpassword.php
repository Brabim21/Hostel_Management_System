<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
  include '../configuration.php';

  $email = $_POST['email'];

  $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $stmt = $conn->prepare("SELECT * FROM staff WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    header("Location: passwordChange.php?email=" . urlencode($email));
    exit;
  } else {
    $error_message = "No account found with that email address.";
  }

  $stmt->close();
  $conn->close();
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
      overflow-y: auto;
      /* Added overflow-y for scrolling if needed */
    }

    .modal-dialog {
      margin: 50px auto;
      max-width: 400px;
      background: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
      /* Added box-shadow for a subtle effect */
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
      transition: border-color 0.3s ease-in-out;
      /* Added transition for input focus effect */
    }

    .form-control:focus {
      border-color: #007bff;
      /* Updated focus border color */
    }

    .btn {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease-in-out;
      /* Added transition for button hover effect */
    }

    .btn:hover {
      background-color: #0056b3;
      /* Updated hover background color */
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
        <?php if (isset($error_message)) : ?>
          <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
        <form name="chngpwd" method="post" onsubmit="return valid();">
          <input type="email" name="email" class="form-control" placeholder="Your Email address*" required><br>
          <input type="submit" value="Reset My Password" name="update" class="btn">
        </form>
        <div class="text-center">
          <!-- <p class="gray-text">For security reasons we don't store your password. Your password will be reset and a new one will be sent.</p> -->
          <p><a href="staffLogin.php" onclick="closeModal()"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back to Login</a></p>
        </div>
      </div>
    </div>
  </div>

  <script>
    function valid() {
      var email = document.forms["chngpwd"]["email"].value;
      if (email == "") {
        alert("Email must be filled out");
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
