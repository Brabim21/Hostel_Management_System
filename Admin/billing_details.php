<?php
// Include database connection and setup
include_once "../configuration.php";

// Define variables for pagination
$limit = 10;
$page = isset($_GET['page'])? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Perform search if search query is present
$search = isset($_GET['search'])? $_GET['search'] : '';
$searchQuery = $search? "AND u.name LIKE '%$search%'" : ''; // Assuming 'name' is the column in the 'user' table

$residentName = "";
$receivedAmount = "";

// Fetch payment details from the database
if ($link) {
    // Adjusted SQL query to use the billing table
    $sql = "SELECT b.*, u.name AS resident_name, (b.total_fee - b.received_amount) AS pending_amount 
            FROM billing b
            INNER JOIN user u ON b.user_id = u.user_id
            WHERE 1 $searchQuery
            LIMIT $limit OFFSET $offset";
    $result = mysqli_query($link, $sql);

    // Fetch total number of billing records for pagination
    $totalSql = "SELECT COUNT(*) AS total 
                 FROM billing b
                 INNER JOIN user u ON b.user_id = u.user_id
                 WHERE 1 $searchQuery";
    $totalResult = mysqli_query($link, $totalSql);
    $totalRows = mysqli_fetch_assoc($totalResult)['total'];
    $totalPages = ceil($totalRows / $limit);

    // Calculate total received amount
    $totalReceivedAmount = 0;
    $receivedAmountSql = "SELECT SUM(received_amount) AS total_received 
                          FROM billing";
    $receivedAmountResult = mysqli_query($link, $receivedAmountSql);
    $totalReceivedAmount = mysqli_fetch_assoc($receivedAmountResult)['total_received'];
} else {
    echo "Error: Unable to establish database connection.";
}
// Close the database connection
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="manage_payment.css">

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

    <div class="container">
        <h1>Manage Payment</h1>
        <div class="search-container">
            <form method="get" action="">
                <input type="text" name="search" id="searchInput" placeholder="Search by resident name..." value="<?php echo $search;?>">
                <button type="submit">Search</button>
            </form>
        </div>
        <table id="paymentTable">
            <thead>
                <tr>
                    <th>Resident Name</th>
                    <th>Received Amount</th>
                    <th>Payment Date</th>
                    <th>Pending Amount</th>
                </tr>
            </thead>
            <tbody>
                 <?php
                if ($link && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>". $row['resident_name']. "</td>";
                        echo "<td>$". $row['received_amount']. "</td>"; 
                        echo "<td>". $row['bill_date']. "</td>"; 
                        echo "<td>$". $row['pending_amount']. "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No payment records found</td></tr>";
                }
                
              ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Received Amount:</th>
                    <td>$<?php echo $totalReceivedAmount;?></td>
                </tr>
            </tfoot>
        </table>
        <div class="pagination">
            <a href="?page=<?php echo ($page > 1) ? ($page - 1) : 1; ?>&search=<?php echo $search; ?>" id="prevBtn">Prev</a>
            <a href="?page=<?php echo ($page < $totalPages) ? ($page + 1) : $totalPages; ?>&search=<?php echo $search; ?>" id="nextBtn">Next</a>
        </div>
    <form id="update_status_form" method="post" action="update_billing.php" style="display: none;">
        <input type="hidden" name="payment_id[]" />
        <input type="hidden" name="new_status[]" />
    </form>
    </div>

<style>
    .generating-bill {
    margin-top: 20px; /* Adjust as needed */
    padding: 20px;
    border: 1px solid #ddd;
    margin-left: 240px; /* Same as the width of the left navigation bar */
}

.update-container {
    display: none; /* Hide the update form initially */
}
</style>

<div class="generating-bill">
        <div class="search-container-1">
            <form method="get" action="">
                <input type="text" name="search" id="searchInput" placeholder="Search by resident name..." value="<?php echo $search;?>">
                <button type="submit" id="searchButton-2">Search</button>

            </form>
        </div>

        <div class="update-bill">
            <div id="update-container">
                <h2>Update Payment</h2>
                <form method="post" action="update_billing.php">
                    <input type="hidden" name="update_id" id="update_id">
                    <label for="resident_name">Resident Name:</label>
                    <input type="text" name="resident_name" id="resident_name" required readonly>
                    <label for="room_name">Room Name:</label>
                    <input type="text" name="room_name" id="room_name" required readonly>
                    <label for="total_fee">Total Fee:</label>
                    <input type="number" name="total_fee" id="total_fee" step="0.01" required readonly>
                    <label for="pending_amount">Pending Amount:</label>
                    <input type="number" name="pending_amount" id="pending_amount" step="0.01" required readonly>
                    <label for="received_amount">Received Amount:</label>
                    <input type="number" name="received_amount" id="received_amount" step="0.01" required>
                    <button type="submit" id="updateButton" disabled>Update Payment</button>
                </form>
            </div>
        </div>
    </div>
    <script>

document.addEventListener('DOMContentLoaded', function() {
    const updateForm = document.querySelector('.update-bill form');
    const searchButton = document.getElementById('searchButton-2'); // Corrected id here

    searchButton.addEventListener('click', function(event) {
        event.preventDefault();
        
        const searchInput = document.getElementById('searchInput').value.trim();

        // Perform AJAX request to fetch resident details
        fetch(`fetch_resident_details.php?search=${searchInput}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Populate resident details into the update form
                    document.getElementById('resident_name').value = data.residentName;
                    document.getElementById('room_name').value = data.roomName;
                    document.getElementById('total_fee').value = data.totalFee;
                    document.getElementById('pending_amount').value = data.pendingAmount;
                    document.getElementById('received_amount').value = data.receivedAmount;

                    // Enable the update button
                    document.getElementById('updateButton').disabled = false;
                } else {
                    alert('Resident not found!');
                    // Clear the update form
                    updateForm.reset();
                    // Disable the update button
                    document.getElementById('updateButton').disabled = true;
                }
            })
            .catch(error => console.error('Error:', error));
    });

    updateForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(updateForm);

        // Perform AJAX request to update payment
        fetch('update_billing.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Payment updated successfully!');
                // Redirect to billing_details.php
                window.location.href = 'billing_details.php';
            } else {
                alert('Failed to update payment.');
            }
        })
        .catch(error => console.error('Error:', error));
    });
});




    // Add event listener to the logout link
    document.getElementById('logout').addEventListener('click', function() {
        // Show a confirmation dialog
        if (confirm('Are you sure you want to logout?\n you will be redirected to login page')) {
            // If user clicks OK, redirect to adminLogin.php
            window.location.href = 'adminLogin.php';
        } else {
            // If user clicks Cancel, do nothing
            return false;
        }
    });

    document.getElementById('search-container-1').addEventListener('click', function() {
    // Get the update form container
    var updateContainer = document.getElementById('update-container');

    // Fetch resident's name and received amount
    var residentName = "<?php echo $residentName; ?>";
    var receivedAmount = "<?php echo $receivedAmount; ?>";

    // Populate the form fields with fetched data
    document.getElementById('resident_name').value = residentName;
    document.getElementById('received_amount').value = receivedAmount;

    // Toggle visibility of the update form container
    updateContainer.style.display = updateContainer.style.display === 'none' ? 'block' : 'none';
});

    // Add event listener to the update button
    document.getElementById('update-btn').addEventListener('click', function() {
    // Get the update form container
    var updateContainer = document.getElementById('update-container');
    });

function handleSearch() {
        const searchInput = document.getElementById('searchInput');
        const residentName = searchInput.value;
        localStorage.setItem('residentName', residentName); // Store the resident name in local storage
        window.location.href = 'update_billing.php'; // Redirect to update_bill.php
    }

    // Call handleSearch when the search button is clicked
    document.querySelector('.search-container form').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission
        handleSearch();
    });

        function updatePaymentStatus(newStatus, paymentId) {
            // Update the status in the table
            document.getElementById(`status_${paymentId}`).innerText = newStatus;
            // Update the hidden input field
            document.getElementById(`new_status_${paymentId}`).value = newStatus;
            // Submit the form to update status in the database
            document.getElementById("update_status_form").submit();
        }

</script>
</body>
</html>
