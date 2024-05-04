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
            padding: 20px; /* Adjusted padding */
            text-align: center;
            font-size: 1em; /* Adjusted font size */
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
        .button {
            background-color: #ccc; /* Grey color */
            color: #000; /* Black text */
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }
        .button:hover {
            background-color: #bbb; /* Darker grey on hover */
        }
    </style>
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
            <li><a href="#">Resident Info</a></li>
            <li><a href="#">Rooms</a></li>
            <li><a href="#">Tasks</a></li>
            <li><a href="#">Event Calendar</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
    </nav>
    <div class="content">
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
        <div class="calendar">
            <div class="calendar-month-year">Calendar - <span id="current-month"></span></div>
            <div class="calendar-header">
                <button onclick="previousMonth()">&#10094;</button>
                <span id="current-month"></span>
                <button onclick="nextMonth()">&#10095;</button>
            </div>
            <div class="calendar-body" id="calendar-body"></div>
        </div>
        <button class="button" onclick="openAddEventForm()">Add Event</button>
        <button class="button" onclick="deleteEvent()">Delete Event</button>
    </div>

    <script>
        const currentDate = new Date();
        let currentMonth = currentDate.getMonth();
        let currentYear = currentDate.getFullYear();

        function renderCalendar() {
            const firstDayOfMonth = new Date(currentYear, currentMonth, 1);
            const lastDayOfMonth = new Date(currentYear, currentMonth + 1, 0);
            const daysInMonth = lastDayOfMonth.getDate();
            const startingDay = firstDayOfMonth.getDay();

            const monthNames = ["January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];

            document.getElementById("current-month").textContent = monthNames[currentMonth] + " " + currentYear;

            const calendarBody = document.getElementById("calendar-body");
            calendarBody.innerHTML = "";

            // Create blank spaces for days before the first day of the month
            for (let i = 0; i < startingDay; i++) {
                const day = document.createElement("div");
                day.classList.add("calendar-cell");
                calendarBody.appendChild(day);
            }

            // Create days of the month
            for (let i = 1; i <= daysInMonth; i++) {
                const day = document.createElement("div");
                day.classList.add("calendar-cell");
                day.textContent = i;
                if (currentMonth === currentDate.getMonth() && currentYear === currentDate.getFullYear() && i === currentDate.getDate()) {
                    day.classList.add("today");
                }
                calendarBody.appendChild(day);
            }
        }

        function nextMonth() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            renderCalendar();
        }

        function previousMonth() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            renderCalendar();
        }

        function openAddEventForm() {
            // Your logic to open the add event form goes here
            alert("Add Event Form will be opened.");
        }

        function deleteEvent() {
            // Your logic to delete an event goes here
            alert("Event will be deleted.");
        }

        renderCalendar();
    </script>
</body>
</html>

