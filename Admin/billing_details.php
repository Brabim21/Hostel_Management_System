<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="billing_details.css">
    <title>Manage Bill and Generate New Bill</title>
</head>
<body>
<nav>
    <ul>
        <li>
            <a href="#">
                <img src="image/Hostel.avif" alt="Hostel Logo" class="logo">
                Dashboard
            </a>
        </li>
        <li><a href="manage_room.php">Rooms</a></li>
        <li><a href="managestaff.php">Staff</a></li>
        <li><a href="#">Residents</a></li>
        <li><a href="#">Billing Details</a></li>
        <li><a href="manage_payment.php">Payment Info</a></li>
        <li><a href="#" id="logout">Logout</a></li>
    </ul>
</nav>

<div class="content">
    <h2>Existing Billing Details</h2>
    <div class="search-box">
        <input type="text" id="searchInput" placeholder="Search by name">
    </div>
    <table id="billingTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Total Fee</th>
                <th>Received Amount</th>
                <th>Pending Amount</th>
                <th>Last Paid Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Billing details will be dynamically added here -->
        </tbody>
    </table>

    <h2>Make Bill Section</h2>
    <div class="search-box">
        <input type="text" id="residentSearch" placeholder="Search residents">
    </div>
    <div id="residentDetails" class="resident-details">
        <!-- Resident details will be dynamically added here -->
    </div>
</div>

<script src="billing_details.js"></script>
<script>
    function generateBill(userId) {
        // Your bill generation logic here
        // You can use userId to fetch resident details and generate bill
        // Once bill is generated, you can display it or perform any other action
        // For demonstration purposes, let's alert a message
        alert("Bill generated for user with ID: " + userId);
    }
</script>
</body>
</html>
