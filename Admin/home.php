<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Homepage</title>
<link rel="stylesheet" href="admincss.css">
</head>
<body>
  <nav class="navbar">
    <ul>
      <li><a href="#">Dashboard</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle">Staff <span class="dropdown-icon">&#9662;</span></a>
        <div class="dropdown-content">
          <a href="#">Manage Staff</a>
          <a href="#">Add Staff</a>
        </div>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle">Residents <span class="dropdown-icon">&#9662;</span></a>
        <div class="dropdown-content">
          <a href="#">Manage Residents</a>
          <a href="#">Add Residents</a>
        </div>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle">Room <span class="dropdown-icon">&#9662;</span></a>
        <div class="dropdown-content">
          <a href="#">Manage Room</a>
          <a href="#">Add Room</a>
        </div>
      </li>
      <li><a href="#">Payment and Billing</a></li>
      <li><a href="#">Messages</a></li>
    </ul>
  </nav>
  <div class="dashboard">
    <div class="card">
      <h3>Staff</h3>
      <p id="staff-count">Loading...</p>
    </div>
    <div class="card">
      <h3>Residents</h3>
      <p id="residents-count">Loading...</p>
    </div>
    <div class="card">
      <h3>Rooms</h3>
      <p id="rooms-count">Loading...</p>
    </div>
  </div>
  <script>
    function updateCounts() {
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "update_counts.php", true); // Check this line to ensure the correct path
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          var response = JSON.parse(xhr.responseText);
          document.getElementById("staff-count").innerText = "Staff: " + response.staff;
          document.getElementById("residents-count").innerText = "Residents: " + response.residents;
          document.getElementById("rooms-count").innerText = "Rooms: " + response.rooms;
        }
      };
      xhr.send();
    }

    // Update counts every 5 seconds (for example)
    setInterval(updateCounts, 5000);

    // Initial call to update counts when the page loads
    window.onload = function() {
      updateCounts();
    };
  </script>
</body>
</html>
