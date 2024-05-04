<?php
// Include database connection
include_once "../configuration.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set
    if (isset($_POST['payment_id']) && isset($_POST['new_status'])) {
        // Prepare and bind the query
        $stmt = $link->prepare("UPDATE payment SET payment_status = ? WHERE payment_id = ?");
        $stmt->bind_param("si", $newStatus, $paymentId);

        // Set parameters and execute
        foreach ($_POST['payment_id'] as $key => $paymentId) {
            $newStatus = $_POST['new_status'][$key];
            $stmt->execute();
        }

        // Close statement
        $stmt->close();

        // Redirect to manage_payment.php after updating
        header("Location: manage_payment.php");
        exit();
    } else {
        echo "Error: All fields are required.";
    }
} else {
    echo "Error: Invalid request method.";
}
?>
