<?php
require_once('tc/src/Tcpdf.php');

// Include database connection and setup
include_once "../configuration.php";

// Check if billing_id is provided in the URL
if(isset($_GET['billing_id'])) {
    // Sanitize the input to prevent SQL injection
    $billing_id = mysqli_real_escape_string($link, $_GET['billing_id']);

    // Query to fetch billing details based on billing_id
    $query = "SELECT b.*, u.name AS user_name, u.assigned_room_name AS room_name
              FROM billing b
              INNER JOIN user u ON b.user_id = u.user_id
              WHERE b.billing_id = '$billing_id'";
    $result = mysqli_query($link, $query);

    if(mysqli_num_rows($result) == 1) {
        // Fetch the billing details
        $row = mysqli_fetch_assoc($result);

        // Create new PDF instance
        $pdf = new TCPDF();

        // Set document information
        $pdf->SetCreator('Your Name');
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Bill for Billing ID: ' . $row['billing_id']);
        $pdf->SetSubject('Bill');
        $pdf->SetKeywords('Bill, PDF, PHP');

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // Output the bill details
        $pdf->Write(0, "Bill for Billing ID: " . $row['billing_id'], '', 0, 'C', true, 0, false, false, 0);
        $pdf->Ln();
        $pdf->Write(0, "User: " . $row['user_name'], '', 0, 'L', true, 0, false, false, 0);
        $pdf->Ln();
        $pdf->Write(0, "Room Name: " . $row['room_name'], '', 0, 'L', true, 0, false, false, 0);
        $pdf->Ln();
        $pdf->Write(0, "Total Fee: $" . $row['total_fee'], '', 0, 'L', true, 0, false, false, 0);
        $pdf->Ln();
        $pdf->Write(0, "Received Amount: $" . $row['received_amount'], '', 0, 'L', true, 0, false, false, 0);
        $pdf->Ln();
        $pdf->Write(0, "Pending Amount: $" . $row['pending_amount'], '', 0, 'L', true, 0, false, false, 0);
        $pdf->Ln();
        $pdf->Write(0, "Bill Date: " . $row['bill_date'], '', 0, 'L', true, 0, false, false, 0);

        // Close and output PDF
        $pdf->Output('bill.pdf', 'D');
        exit;
    } else {
        echo "Billing ID not found!";
    }
} else {
    echo "Billing ID not provided!";
}
?>
