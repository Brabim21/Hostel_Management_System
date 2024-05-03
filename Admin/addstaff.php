<?php
// Include the database connection file
include '../configuration.php';

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $age = $_POST['age'];
    $contactNumber = $_POST['contactNumber'];
    $address = $_POST['address'];

    // Process and upload citizenship image (assuming you are storing the file path in the database)

    // Example: Move uploaded file to a directory and store its path
    $citizenshipImagePath = ""; // Set a default value
    if (isset($_FILES['citizenship']) && $_FILES['citizenship']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = "citizenship_images/";
        $uploadFile = $uploadDir . basename($_FILES['citizenship']['name']);
        if (move_uploaded_file($_FILES['citizenship']['tmp_name'], $uploadFile)) {
            $citizenshipImagePath = $uploadFile;
        }
    }

    // Insert staff details into the database
    $sql = "INSERT INTO staff (first_name, last_name, email, password, age, contact_number, address, citizenship) 
            VALUES ('$firstName', '$lastName', '$email', '$password', '$age', '$contactNumber', '$address', '$citizenshipImagePath')";

    if (mysqli_query($link, $sql)) {
        // Redirect to managestaff.php after successful insertion
        header("Location: managestaff.php");
        exit;
    } else {
        // Handle error if insertion fails
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }

    // Close the database connection
    mysqli_close($link);
}
?>
