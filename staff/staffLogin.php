<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <title>HostelStays</title>
  <link rel="stylesheet" href="staffLogin.css">
</head>
<body>
  <div class="container">
    <p class="login-text">Staff Login Page</p>
    <div class="line"></div>

    <!-- Form tag added here -->
    <form id="login-form">

      <p id="email-id">Email or username</p>
      <input type="text" id="username" name="username" placeholder="Enter your username" pattern="^[a-zA-Z0-9._%+-]+@gmail.com$">

      <p id="pass-id">Enter password</p>
      <input type="password" id="password" name="password" placeholder="Enter your Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must contain at least one uppercase letter, one digit, and be at least 8 characters long." required>

      <input type="checkbox" id="showPasswordCheckbox">
      <label for="showPasswordCheckbox">Show Password</label>

      <!-- Moved Forgot Password link here -->
      <div class="forgot-password">
        <a href="./forgotpassword.php" id="forgot-password">Forgot Password?</a>
      </div>

      <button type="submit" id="sign-in">Sign in</button>

    </form>
    <!-- End of form -->

  </div>

  <script src="stafflogin.js"></script>
</body>
</html>
