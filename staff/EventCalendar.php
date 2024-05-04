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
        nav ul li a:hover .logo {
            transform: scale(1.1); /* Example hover effect */
        }
        .logo {
            width: 100px; /* Adjust as needed */
            margin-bottom: 20px; /* Spacing between logo and links */
            transition: transform 0.3s; /* Transition effect */
        }
        .content {
            margin-left: 220px; /* Adjust based on nav width */
            padding: 20px;
            text-align: center;
        }
        .admin-profile {
            position: fixed;
            top: 10px;
            right: 20px;
            text-align: center;
            color: #333;
        }
        .admin-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #fff;
        }
        .event-calendar {
            margin-bottom: 20px;
            max-width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-left: auto;
        }
        .event {
            margin-bottom: 20px;
        }
        .event h3 {
            margin-top: 0;
        }
        .event p {
            margin-bottom: 5px;
        }
        .calendar {
            max-width: 800px; /* Increased width */
            margin: 0 auto;
            overflow: hidden;
            margin-left: 20px; /* Adjusted left margin */
        }
        .calendar-header {
            background-color: #f0f0f0;
            text-align: center;
            padding: 15px; /* Increased padding */
            font-weight: bold;
            display: flex;
            justify-content: space-around;
            font-size: 1.2em; /* Increased font size */
            border-collapse: collapse; /* Added border-collapse */
        }
        .calendar-header div {
            flex: 1; /* Equal spacing */
        }
        .calendar-body {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            border-collapse: collapse;
        }
        .calendar-cell {
            border: 1px solid #ccc;
            padding: 50px; /* Increased padding */
            text-align: center;
            font-size: 1.5em; /* Increased font size */
            position: relative; /* Added */
        }
        .calendar-cell.highlight {
            background-color: red; /* Added */
        }
        .calendar-cell.highlight::before {
            content: ''; /* Added */
            position: absolute; /* Added */
            top: 0; /* Added */
            left: 0; /* Added */
            right: 0; /* Added */
            bottom: 0; /* Added */
            border: 2px solid red; /* Added */
            border-radius: 5px; /* Added */
        }
        .calendar-month-year {
            font-size: 1.5em; /* Adjust font size */
            margin-bottom: 20px; /* Add spacing between month-year and calendar */
        }
    </style>
</head>
<body>
    <div class="event-calendar">
        <div class="event">
            <h3>Hostel Movie Night</h3>
            <p>Date: May 20, 2024</p>
            <p>Time: 7:00 PM - 9:00 PM</p>
            <p>Description: Join us for a movie night in the hostel lounge. Popcorn and drinks will be provided!</p>
        </div>
        <div class="event">
            <h3>Hostel BBQ Party</h3>
            <p>Date: May 5, 2024</p>
            <p>Time: 6:00 PM - 10:00 PM</p>
            <p>Description: Don't miss our annual BBQ party at the hostel backyard. Bring your appetite!</p>
        </div>
        <!-- Add more events as needed -->
    </div>
    <nav>
        <ul>
            <li>
                <a href="#">
                    <img src="Hostel.avif" alt="Hostel Logo" class="logo">
                    Dashboard
                </a>
            </li>
            <li><a href="#">Resident Info</a></li>
            <li><a href="#">Rooms</a></li>
            <li><a href="#">Tasks</a></li>
            <li><a href="#">Event Calendar</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
    </nav>
    <div class="content">
        <div class="calendar">
            <div class="calendar-month-year">Calendar - May, 2024</div> <!-- Added text "Calendar" -->
            <div class="calendar-header">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
            </div>
            <div class="calendar-body">
                <div class="calendar-cell"></div>
                <div class="calendar-cell"></div>
                <div class="calendar-cell"></div>
                <div class="calendar-cell">1</div>
                <div class="calendar-cell">2</div>
                <div class="calendar-cell">3</div>
                <div class="calendar-cell">4</div>
                <div class="calendar-cell highlight">5</div> <!-- Added class for highlighting -->
                <div class="calendar-cell">6</div>
                <div class="calendar-cell">7</div>
                <div class="calendar-cell">8</div>
                <div class="calendar-cell">9</div>
                <div class="calendar-cell">10</div>
                <div class="calendar-cell">11</div>
                <div class="calendar-cell">12</div>
                <div class="calendar-cell">13</div>
                <div class="calendar-cell">14</div>
                <div class="calendar-cell">15</div>
                <div class="calendar-cell">16</div>
                <div class="calendar-cell">17</div>
                <div class="calendar-cell">18</div>
                <div class="calendar-cell">19</div>
                <div class="calendar-cell highlight">20</div> <!-- Added class for highlighting -->
                <div class="calendar-cell">21</div>
                <div class="calendar-cell">22</div>
                <div class="calendar-cell">23</div>
                <div class="calendar-cell">24</div>
                <div class="calendar-cell">25</div>
                <div class="calendar-cell">26</div>
                <div class="calendar-cell">27</div>
                <div class="calendar-cell">28</div>
                <div class="calendar-cell">29</div>
                <div class="calendar-cell">30</div>
            </div>
        </div>
    </div>
    
</body>
</html>
