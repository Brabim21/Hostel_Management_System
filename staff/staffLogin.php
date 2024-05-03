<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <title>HostelStays</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    
    body {
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-color: #f0f0f0;
}

.container {
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  width: 320px;
}

.login-text {
  font-size: 24px;
  font-weight: 600;
  margin-bottom: 20px;
  text-align: center; /* Center the login text */
}

.line {
  height: 2px;
  background-color: #333;
  margin-bottom: 20px;
}

#email-id,
#pass-id {
  margin-bottom: 10px;
  font-size: 16px;
  font-weight: 500;
}

input[type="text"],
input[type="password"],
button[type="submit"],
a {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing: border-box;
}

input[type="checkbox"] {
  margin-right: 5px;
}

label {
  font-size: 14px;
}

button[type="submit"] {
  background-color: #007bff;
  color: #fff;
  cursor: pointer;
  transition: background-color 0.3s ease; /* Smooth color transition */
}

button[type="submit"]:hover {
  background-color: #0056b3; /* Darker shade on hover */
}

a {
  text-decoration: none;
  color: #007bff;
}

a:hover {
  text-decoration: underline;
}

/* Optional: Hide the password field initially */
#password {
  display: none;
}

  </style>
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

  <a href="./forgotpassword.php" id="forgot-password">Forgot Password?</a>

  <button type="submit" id="sign-in">Sign in</button>

</form>
    <!-- End of form -->

  </div>

  <!-- Script tag moved to the end of the body -->
  <script>
document.getElementById("showPasswordCheckbox").addEventListener("change", function() {
    var passwordField = document.getElementById("password");
    if (this.checked) {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";
    }
});

document.getElementById("login-form").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the default form submission

    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;

    // Check for presence of username and password fields
    if (username.trim() === "" || password.trim() === "") {
        alert("Please enter both username and password.");
        return;
    }

    // Enforce password regulations
    let passwordRegex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
    if (!passwordRegex.test(password)) {
        alert("Password must be at least 8 characters long and contain at least one uppercase letter and one digit.");
        return;
    }

    // Specify username criteria (e.g., requiring "@gmail.com" for email-based usernames)
    if (username.trim().toLowerCase().indexOf("@gmail.com") === -1) {
        alert("Username must be an email address with '@gmail.com'.");
        return;
    }

    // Send AJAX request to login.php
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../login.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                console.log("Response from login.php:", xhr.responseText); // Log the response
                // Check if the response exactly matches "success"
                if (xhr.responseText.trim() === "success") {
                    // If login is successful, redirect to home.php
                    console.log("Redirecting to home.php");
                    window.location.href = "home.php";
                } else {
                    console.log("Login failed:", xhr.responseText);
                    alert("Incorrect username or password. Please try again.");
                }
            } else {
                console.log("Error:", xhr.statusText);
                alert("Error occurred while logging in. Please try again later.");
            }
        }
    };
    xhr.send("username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password));
});

</script>
</body>
</html>

