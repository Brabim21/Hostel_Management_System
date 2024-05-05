<!DOCTYPE html>
<html>
<head>
  <title>Hostel Management System - Login</title>
  <link rel="stylesheet" href="ResidentLogin.css">
</head>
<body>
  <div class="container">
    <img src="Hostel.jpg" alt="Hostel Image" class="background-image">
    <h1>Hostel Management System</h1>
    <h2>Login</h2>
    <form id="login-form" action="login_process.php" method="post">
      <label for="email">Email/Registration Number:</label>
      <input type="text" id="email" name="email" placeholder="Your email or registration number">

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Your password">

      <input type="submit" name="login" value="Login">
    </form>
    <a href="ResidentSignup.php">New User</a> <!-- Link to sign-up page -->
    <a href="#">Forgot password?</a>
  </div>
</body>
</html>
