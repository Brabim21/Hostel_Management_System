<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System - Staff Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        nav {
            background-color: #333;
            color: #fff;
            width: 200px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: left;
        }
        nav ul li {
            margin-bottom: 10px;
        }
        nav ul li a {
            display: block;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            transition: background-color 0.3s;
        }
        nav ul li a:hover {
            background-color: #555;
        }
        .logo {
            width: 100px;
            margin-bottom: 20px;
            transition: transform 0.3s;
        }
        .container {
            margin-left: 220px;
            padding: 20px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .search-container {
            text-align: right;
            margin-bottom: 20px;
        }
        .search-container input[type=text] {
            padding: 10px;
            margin-top: 8px;
            font-size: 17px;
            border: none;
            border-radius: 5px;
            width: 300px; /* Adjusted width */
        }
        .search-container button {
            padding: 10px;
            margin-top: 8px;
            margin-right: 16px;
            background: #333;
            color: white;
            font-size: 17px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .search-container button:hover {
            background: #555;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li>
                <a href="#">
                    <img src="Hostel.avif" alt="Hostel Logo" class="logo">
                    <li><a href="home.php">Dashboard</a></li>
                </a>
            </li>
            <li><a href="residentInfo.php">Resident Info</a></li>
            <li><a href="maintenance.php">Maintenance</a></li>
            <li><a href="eventCalendar.php">Event Calendar</a></li>
            <li><a href="logout.php?logout=true">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>Maintenance Activities</h1>
        <div class="search-container">
            <form action="#">
                <input type="text" placeholder="Search for maintenance activity..." name="search">
                <button type="submit">Search</button>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Activity</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Fix leaking faucet</td>
                    <td>Pending</td>
                </tr>
                <tr>
                    <td>Repair broken window</td>
                    <td>Completed</td>
                </tr>
                <tr>
                    <td>Paint walls</td>
                    <td>Current</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
