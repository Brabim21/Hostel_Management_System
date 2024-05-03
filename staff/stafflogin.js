document.getElementById("showPasswordCheckbox").addEventListener("change", () => {
    const passwordField = document.getElementById("password");
    passwordField.type = this.checked ? "text" : "password";
});

document.getElementById("login-form").addEventListener("submit", async (event) => {
    event.preventDefault(); // Prevent the default form submission

    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();

    // Check for presence of username and password fields
    if (!username || !password) {
        alert("Please enter both username and password.");
        return;
    }

    // Enforce password regulations
    const passwordRegex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
    if (!passwordRegex.test(password)) {
        alert("Password must be at least 8 characters long and contain at least one uppercase letter and one digit.");
        return;
    }

    // Specify username criteria (e.g., requiring "@gmail.com" for email-based usernames)
    if (!username.toLowerCase().includes("@gmail.com")) {
        alert("Username must be an email address with '@gmail.com'.");
        return;
    }

    // Simulate server-side validation and response handling
    const response = await simulateLogin(username, password);

    // Check if the response exactly matches "success"
    if (response === "success") {
        // If login is successful, redirect to dashboard
        alert("Login successful. Redirecting to dashboard.");
        window.location.href = "dashboard.php";
    } else {
        alert("Incorrect username or password. Please try again.");
    }
});

// Simulated login function for demonstration purposes
async function simulateLogin(username, password) {
    // Simulate server-side validation
    await new Promise((resolve) => setTimeout(resolve, 1000));

    // Simulate response (replace with actual AJAX request in production)
    const success = true; // Simulate successful login for demonstration
    return success ? "success" : "error";
}

