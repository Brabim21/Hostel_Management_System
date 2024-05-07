<?php
// Include configuration
require_once "configuration.php";


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $description = $_POST['description'];
    $preferredDate = $_POST['preferred_date']; // Check if this field exists in your HTML form
    $additionalDetails = $_POST['additional_details'];

    // Retrieve the email of the logged-in user (assuming stored in a session variable)
    session_start();
    if (isset($_SESSION['email'])) {
        $userEmail = $_SESSION['email'];
    } else {
        die("User email not found in session.");
    }
    session_write_close();

    // Insert into database
    $sql = "INSERT INTO request (Description, preferred_date, additional_details, email) VALUES ('$description', '$preferredDate', '$additionalDetails', '$userEmail')";
    if (mysqli_query($link, $sql)) {
        echo "Request submitted successfully.";

        // Send email to resident
        $to = $userEmail;
        $subject = "Maintenance Request Submitted";
        $message = "Your maintenance request has been submitted successfully.";
        $headers = "From: your_email@example.com";

        // Send email
        if (mail($to, $subject, $message, $headers)) {
            echo "Email sent successfully.";
        } else {
            echo "Error sending email.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link); // Output SQL error
    }
}

// Close connection
mysqli_close($link);
?>

