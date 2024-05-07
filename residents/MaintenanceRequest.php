<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System - Maintenance Request</title>
    <link rel="stylesheet" href="maintenanceRequest.css">
</head>
<body>
    <nav>
        <ul>
            <li>
                <a href="#">
                    <img src="Hostel.avif" alt="Hostel Logo" class="logo">
                    Dashboard
                </a>
            </li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Book Facilities</a></li>
            <li><a href="#">My Payments</a></li>
            <li><a href="#">Maintenance Requests</a></li>
            <li><a href="#">Notifications</a></li>
            <li><a href="#">Chats</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>Maintenance Request</h1>
        <div class="form-box">
            <form>
                <input type="text" placeholder="Description of the issue" required>
                <input type="text" placeholder="Preferred repair dates">
                <textarea placeholder="Additional details (if any)"></textarea>
                <input type="file" accept="image/*" multiple>
                <button type="submit">Submit Request</button>
            </form>
        </div>
    </div>
</body>
</html>
