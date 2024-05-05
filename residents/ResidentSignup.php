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
    <form id="signup-form" action="signup_process.php" method="post"> <!-- Changed action to signup_process.php -->
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" placeholder="Your name">

      <label for="email">Email:</label>
      <input type="text" id="email" name="email" placeholder="Your email">

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Your password">

      <label for="age">Age:</label>
      <input type="number" id="age" name="age" placeholder="Your age">

      <label for="contact_number">Contact Number:</label>
      <input type="text" id="contact_number" name="contact_number" placeholder="Your contact number">

      <label for="college_studying">College Studying:</label>
      <input type="text" id="college_studying" name="college_studying" placeholder="College name">

      <label for="guardian_name">Guardian Name:</label>
      <input type="text" id="guardian_name" name="guardian_name" placeholder="Guardian name">

      <label for="guardian_contact_number">Guardian Contact Number:</label>
      <input type="text" id="guardian_contact_number" name="guardian_contact_number" placeholder="Guardian contact number">

      <label for="guardian_address">Guardian Address:</label>
      <input type="text" id="guardian_address" name="guardian_address" placeholder="Guardian address">

      <label for="company_name">Company Name:</label>
      <input type="text" id="company_name" name="company_name" placeholder="Company name">

      <input type="submit" name="signup" value="Sign Up">
    </form>
    <a href="login.php">Existing User</a> <!-- Link to login page -->
  </div>
</body>
</html>
