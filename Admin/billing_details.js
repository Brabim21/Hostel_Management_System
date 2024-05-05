// JavaScript code for searching residents and generating bill
// Add event listener to the logout link
document.getElementById('logout').addEventListener('click', function() {
    // Show a confirmation dialog
    if (confirm('Are you sure you want to logout?')) {
        // If user clicks OK, submit the logout form
        document.getElementById('logout-form').submit();
    } else {
        // If user clicks Cancel, do nothing
        return false;
    }
});

// JavaScript code for searching residents and generating bill
const residents = <? php echo json_encode($residents); ?>; // Fetch residents from PHP
const searchInput = document.getElementById('residentSearch');
const residentDetails = document.getElementById('residentDetails');

// Function to filter residents based on search input
function filterResidents(searchTerm) {
    return residents.filter(resident =>
        resident.name.toLowerCase().includes(searchTerm.toLowerCase())
    );
}

// Function to display resident details
function displayResidentDetails(residents) {
    residentDetails.innerHTML = ''; // Clear previous results
    residents.forEach(resident => {
        const residentDiv = document.createElement('div');
        residentDiv.innerHTML = `
            <h3>${resident.name}</h3>
            <p><strong>Room No:</strong> ${resident.roomNo}</p>
            <p><strong>Address:</strong> ${resident.address}</p>
            <p><strong>Phone No:</strong> ${resident.phone}</p>
            <form action="generate_bill.php" method="POST">
                <input type="hidden" name="residentId" value="${resident.id}">
                <label for="extraBill">Extra Bill:</label>
                <input type="text" name="extraBill" id="extraBill" placeholder="Enter extra bill amount">
                <button type="submit">Generate Bill</button>
            </form>
            <hr>
        `;
        residentDetails.appendChild(residentDiv);
    });
}

// Event listener for search input
searchInput.addEventListener('input', function() {
    const searchTerm = this.value.trim();
    const filteredResidents = filterResidents(searchTerm);
    displayResidentDetails(filteredResidents);
});

// Initial display of resident details
displayResidentDetails(residents);

// Function to generate bill
function generateBill(userId) {
    // You can implement the logic to generate a bill for the given user ID here
    alert("Bill generated for user ID: " + userId);
}
