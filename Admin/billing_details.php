<?php
// Include database connection and setup
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once "../configuration.php";


// Query to fetch billing details along with user information
$query = "SELECT b.billing_id, u.name, b.total_fee, b.received_amount, b.pending_amount, b.bill_date
          FROM billing b
          INNER JOIN user u ON b.user_id = u.user_id";

$result = mysqli_query($link, $query);

// Check if the query was successful


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="billing_details.css">

    <style>
        .add-bill{

            margin-left: 300px;
        }
    </style>

    <title>PBilling</title>
</head>
<body>
    <nav>
        <ul>
            <li>
                <a href="home.php">
                    <img src="image/Hostel.avif" alt="Hostel Logo" class="logo">
                    Dashboard
                </a>
            </li>
            <li><a href="manage_room.php">Rooms</a></li>
            <li><a href="managestaff.php">Staff</a></li>
            <li><a href="manage_resident.php">Residents</a></li>
            <li><a href="#">Billing Details</a></li>
            <li><a href="manage_payment.php">Payment Info</a></li>
             <li><a href="chat.php">Chat</a></li>
            <li><a href="#" id="logout">Logout</a></li>
        </ul>
    </nav>
<!-- Search form -->
    

    <div class="billing-table">
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Search by user name...">
        <button onclick="searchUsers()">Search</button>
    </div>
        <h2>Billing Details</h2>
        <table id="billingTable">
        <?php
            // Include database connection and setup
            include_once "../configuration.php";

            // Query to fetch all users' billing details
            $query = "SELECT b.billing_id, u.name, b.total_fee, b.received_amount, b.pending_amount, b.bill_date
                    FROM billing b
                    INNER JOIN user u ON b.user_id = u.user_id";

            $result = mysqli_query($link, $query);

            // Check if any results were found
            if(mysqli_num_rows($result) > 0) {
                // Display table header
                echo "<thead><tr><th>Billing ID</th><th>User Name</th><th>Total Fee</th><th>Received Amount</th><th>Pending Amount</th><th>Bill Date</th><th>Generate Bill</th><th>Update</th><th>Update Total</th></tr></thead>";
                echo "<tbody>";

                // Display table rows with data
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['billing_id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['total_fee'] . "</td>";
                    echo "<td>" . $row['received_amount'] . "</td>";
                    echo "<td>" . $row['pending_amount'] . "</td>";
                    echo "<td>" . $row['bill_date'] . "</td>";
                    // / Button to generate bill
                    echo "<td><button onclick=\"generateBill('" . $row['billing_id'] . "')\">Generate</button></td>";
                    // Button to update received amount
                    echo "<td><button onclick=\"updatePendingAmount('" . $row['billing_id'] . "')\">Update</button></td>";
                    echo "<td><button onclick=\"updateTotalAmount('" . $row['billing_id'] . "')\">Update Total</button></td>";
                   
                    echo "</tr>";
                }

                echo "</tbody>";
            } else {
                echo "<tr><td colspan='6'>No results found.</td></tr>";
            }
            ?>
        </table>
    </div>



    


<script>
function searchUser() {
    var searchQuery = document.getElementById("searchUser").value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "search_user.php?name=" + searchQuery, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText); // Log the response to the console
            var result = JSON.parse(xhr.responseText); // Attempt to parse the response
            if (result.success) {
                document.getElementById("searchResult").innerHTML = `
                    <p>Name: ${result.user.name}</p>
                    <p>Assigned Room Name: ${result.user.assigned_room_name}</p>
                `;
                // Fill form fields with user details
                document.getElementById("total_fee").value = "";
                document.getElementById("received_amount").value = "";
                document.getElementById("pending_amount").value = "";
                document.getElementById("bill_date").value = "";
            } else {
                document.getElementById("searchResult").innerHTML = "User not found";
            }
        }
    };
    xhr.send();
}

</script>







    <script>
         function searchUsers() {
            var searchQuery = document.getElementById("searchInput").value;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("billingTable").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "search_user.php?search=" + searchQuery, true);
            xhttp.send();
        }

        function generateBill(billingId) {
            // Assuming you want to redirect to a PHP script to generate the bill
            window.location.href = "generate_bill.php?billing_id=" + billingId;
        }

        function updatePendingAmount(billingId) {
            var receivedAmount = prompt("Enter the amount paid by the user:");
            // Validate if receivedAmount is a valid number
            if (receivedAmount !== null && !isNaN(receivedAmount) && receivedAmount.trim() !== "") {
                // Assuming you want to redirect to a PHP script to update the pending amount
                window.location.href = "update_pending_amount.php?billing_id=" + billingId + "&received_amount=" + receivedAmount;
            } else {
                alert("Please enter a valid amount.");
            }
        }

        function updateTotalAmount(billingId) {
            var totalAmount = prompt("Enter the new total amount:");
            // Validate if totalAmount is a valid number
            if (totalAmount !== null && !isNaN(totalAmount) && totalAmount.trim() !== "") {
                // Assuming you want to redirect to a PHP script to update the total amount
                window.location.href = "update_total_amount.php?billing_id=" + billingId + "&total_amount=" + totalAmount;
            } else {
                alert("Please enter a valid amount.");
            }
        }

        
    </script>
</body>
</html>
