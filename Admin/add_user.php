<?php
// Include the database connection file
include '../configuration.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $age = mysqli_real_escape_string($link, $_POST['age']);
    $contactNumber = mysqli_real_escape_string($link, $_POST['contactNumber']);
    $address = mysqli_real_escape_string($link, $_POST['address']);
    $guardianName = mysqli_real_escape_string($link, $_POST['guardianName']);
    $guardianContactNumber = mysqli_real_escape_string($link, $_POST['guardianContactNumber']);

    // Handle citizenship front image upload
    $citizenshipFrontPath = "";
    if (isset($_FILES['citizenship']) && $_FILES['citizenship']['error'] === UPLOAD_ERR_OK) {
        $citizenshipFrontPath = "uploads/" . basename($_FILES['citizenship']['name']);
        move_uploaded_file($_FILES['citizenship']['tmp_name'], $citizenshipFrontPath);
    }

    // Handle citizenship back image upload
    $citizenshipBackPath = "";
    if (isset($_FILES['citizenshipBack']) && $_FILES['citizenshipBack']['error'] === UPLOAD_ERR_OK) {
        $citizenshipBackPath = "uploads/" . basename($_FILES['citizenshipBack']['name']);
        move_uploaded_file($_FILES['citizenshipBack']['tmp_name'], $citizenshipBackPath);
    }

    // Insert user details into the database using prepared statement
    $insertSql = "INSERT INTO user (name, email, password, age, contact_number, citizenship_front, citizenship_back, address, guardian_name, guardian_contact_number) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($link, $insertSql);
    mysqli_stmt_bind_param($stmt, "sssissssss", $name, $email, $password, $age, $contactNumber, $citizenshipFrontPath, $citizenshipBackPath, $address, $guardianName, $guardianContactNumber);

    if (mysqli_stmt_execute($stmt)) {
        // Insert successful
        echo "User added successfully.";

    } else {
        // Insert failed
        echo "Error: " . mysqli_error($link);
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($link);
?>
