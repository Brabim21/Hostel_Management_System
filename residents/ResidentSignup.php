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
    <form id="signup-form" action="signup_process.php" method="post">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" placeholder="Your name">
      <?php if (isset($_GET['name_err'])) echo "<p class='error'>" . $_GET['name_err'] . "</p>"; ?>

      <label for="email">Email:</label>
      <input type="text" id="email" name="email" placeholder="Your email">
      <?php if (isset($_GET['email_err'])) echo "<p class='error'>" . $_GET['email_err'] . "</p>"; ?>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Your password">
      <?php if (isset($_GET['password_err'])) echo "<p class='error'>" . $_GET['password_err'] . "</p>"; ?>

      <label for="age">Age:</label>
      <input type="number" id="age" name="age" placeholder="Your age">

      <label for="contact_number">Contact Number:</label>
      <input type="text" id="contact_number" name="contact_number" placeholder="Your contact number">

      <label for="guardian_name">Guardian Name:</label>
      <input type="text" id="guardian_name" name="guardian_name" placeholder="Guardian name">

      <label for="guardian_contact_number">Guardian Contact Number:</label>
      <input type="text" id="guardian_contact_number" name="guardian_contact_number" placeholder="Guardian contact number">

      <label for="address"> Address:</label>
      <input type="text" id="address" name="address" placeholder="address">

      <input type="submit" name="signup" value="Sign Up">
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
    <a href="ResidentLogin.php">Existing User</a>
  </div>
</body>
</html>
