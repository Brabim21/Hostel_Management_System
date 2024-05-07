<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Hostel Management System</title>
    <link rel="stylesheet" href="profile.css">
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
    <div class="content">
        <h1>User Profile</h1>
        <div class="profile">
            <div class="profile-picture">
                <!-- User's profile picture or avatar -->
                <img src="user.png" alt="Profile Picture">
            </div>
            <div class="profile-details">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="John Doe">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="johndoe@example.com">
                </div>
                <div class="form-group">
                    <label for="contact">Contact Number:</label>
                    <input type="tel" id="contact" name="contact" value="+1234567890">
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="text" id="dob" name="dob" value="January 1, 1990">
                </div>
                <div class="form-group">
                    <label for="temp-address">Temporary Address:</label>
                    <input type="text" id="temp-address" name="temp-address">
                </div>
                <div class="form-group">
                    <label for="perm-address">Permanent Address:</label>
                    <input type="text" id="perm-address" name="perm-address">
                </div>
                <div class="form-group">
                    <label for="father-name">Father's Name:</label>
                    <input type="text" id="father-name" name="father-name">
                </div>
                <div class="form-group">
                    <label for="mother-name">Mother's Name:</label>
                    <input type="text" id="mother-name" name="mother-name">
                </div>
                <div class="form-group">
                    <label for="guardian-name">Guardian's Name:</label>
                    <input type="text" id="guardian-name" name="guardian-name">
                </div>
                <div class="form-group">
                    <label for="guardian-number">Guardian's Contact Number:</label>
                    <input type="tel" id="guardian-number" name="guardian-number">
                </div>
                <div class="form-group">
                    <label for="id-number">ID Number:</label>
                    <input type="text" id="id-number" name="id-number">
                </div>
                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="number" id="age" name="age">
                </div>
                <div class="form-group">
                    <label for="occupation">Occupation:</label>
                    <input type="text" id="occupation" name="occupation">
                </div>
                <div class="form-group">
                    <label for="room-type">Room Type:</label>
                    <select id="room-type" name="room-type">
                        <option value="single">Single</option>
                        <option value="double">Double</option>
                        <option value="triple">Triple</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="food-type">Food Type:</label>
                    <select id="food-type" name="food-type">
                        <option value="vegetarian">Vegetarian</option>
                        <option value="non-vegetarian">Non-Vegetarian</option>
                    </select>
                </div>
                <button type="submit" class="submit-button">Save Changes</button>
            </div>
        </div>
        <div class="info-box-container">
            <div class="info-box">
                <h2>Booking History</h2>
                <p>Total Bookings: 10</p>
            </div>
            <div class="info-box">
                <h2>Current Bookings</h2>
                <p>Number of Current Bookings: 2</p>
            </div>
            <div class="info-box">
                <h2>Payment History</h2>
                <p>Total Payments: $1000</p>
            </div>
        </div>
    </div>
    <div class="admin-profile">
        <img src="Residents.jpg" alt="Admin Profile">
        <p>RESIDENT</p>
    </div>
</body>
</html>

