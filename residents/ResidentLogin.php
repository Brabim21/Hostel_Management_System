<!DOCTYPE html>
<html>
<head>
  <title>Hostel Management System</title>
  <link rel="stylesheet" href="ResidentLogin.css">
</head>
<body>
  <div class="container">
    <img src="Hostel.jpg" alt="Hostel Image" class="background-image">
    <h1>Hostel Management System</h1>
    <h2>Account</h2>
    <form id="login-form" action="#" method="post">
      <label for="username">Email/Registration Number:</label>
      <input type="text" id="username" name="username" placeholder="Your email or registration number">

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Your password">

      <input type="submit" value="Login">
    </form>
    <a href="#" id="existing-user-link">Existing User</a> | <a href="#" id="new-user-link">New User</a>
    <div id="signup-form" style="display: none;">
      <h2>Sign Up</h2>
      <form action="#" method="post">
        <label for="new-username">Email:</label>
        <input type="text" id="new-username" name="new-username" placeholder="Your email">

        <label for="new-password">Password:</label>
        <input type="password" id="new-password" name="new-password" placeholder="Your password">

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
