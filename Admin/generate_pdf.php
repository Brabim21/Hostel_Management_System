<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill for Billing ID: <?php echo $billingDetails['billing_id']; ?></title>
    <style>
        /* CSS styles for the bill */
        .bill {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            border: 2px solid #333;
            font-family: Arial, sans-serif;
        }
        .bill h1 {
            text-align: center;
        }
        .bill p {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="bill">
        <h1>Bill for Billing ID: <?php echo $billingDetails['billing_id']; ?></h1>
        <p>User: <?php echo $billingDetails['user_name']; ?></p>
        <p>Room Name: <?php echo $billingDetails['room_name']; ?></p>
        <p>Total Fee: $<?php echo $billingDetails['total_fee']; ?></p>
        <p>Received Amount: $<?php echo $billingDetails['received_amount']; ?></p>
        <p>Pending Amount: $<?php echo $billingDetails['pending_amount']; ?></p>
        <p>Bill Date: <?php echo $billingDetails['bill_date']; ?></p>
    </div>
</body>
</html>