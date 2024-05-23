<!DOCTYPE html>
<html>
<head>
  <title>Hostel Management System - Sign Up</title>
  <link rel="stylesheet" href="ResidentLogin.css">
</head>
<body>
  <div class="container">
    <img src="Hostel.jpg" alt="Hostel Image" class="background-image">
    <h1>Hostel Management System</h1>
    <h2>Sign Up</h2>
    <div class="login-container">
      <form id="signup-form" action="signup_process.php" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Your name">
        <?php if (isset($_GET['name_err'])) echo "<p class='error'>" . $_GET['name_err'] . "</p>"; ?>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" placeholder="Your email">
        <?php if (isset($_GET['email_err'])) echo "<p class='error'>" . $_GET['email_err'] . "</p>"; ?>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Your password">
        <?php if (isset($_GET['password_err'])) echo "<p class='error'>" . $_GET['password_err'] . "</p>"; ?>

      <div class="citizenship-container">
      <label for="citizenship_front">Citizenship Front:</label>
        <input type="file" id="citizenship_front" name="citizenship_front">

        <label for="citizenship_back">Citizenship Back:</label>
        <input type="file" id="citizenship_back" name="citizenship_back">
      </div>
  
      <input type="submit" name="signup" value="Sign Up" class="button orange-button">

      
    </form>

        <div class="error-messages">
              <?php
              // Display error messages if they exist
              if (isset($_GET['name_err'])) {
                  echo "<p class='error'>" . $_GET['name_err'] . "</p>";
              }
              if (isset($_GET['email_err'])) {
                  echo "<p class='error'>" . $_GET['email_err'] . "</p>";
              }
              if (isset($_GET['password_err'])) {
                  echo "<p class='error'>" . $_GET['password_err'] . "</p>";
              }
              ?>
            </div>
            <a href="ResidentLogin.php" class="button orange-button" id="existing-user">Existing User</a>
          </div>
    </div>
</body>
    
</html>

