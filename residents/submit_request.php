<?php
require_once('configuration.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST['description'];
    $preferred_date = $_POST['preferred_date'];
    $additional_details = $_POST['additional_details'];
    
    // Handle file upload if an image is selected
    $image_path = null;
    if ($_FILES['image']['name']) {
        $target_dir = "uploads/";
        $image_path = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $image_path);
    }
    
    // Insert data into the database
    $sql = "INSERT INTO MaintenanceRequests (description, preferred_date, additional_details, image_path) 
            VALUES ('$description', '$preferred_date', '$additional_details', '$image_path')";
    
    if (mysqli_query($link, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }
    
    // Close the database connection
    mysqli_close($link);
}
?>

