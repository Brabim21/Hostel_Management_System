<?php
$events = [];
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    include '../configuration.php';
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql_select = "SELECT * FROM events";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }
    $conn->close();
}
?>

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

.content {
    display: flex; /* Use flexbox */
    margin-left: 220px; /* Adjust based on nav width */
    padding: 20px;
    text-align: center;
}

.event-calendar,
.calendar {
    flex: 1; /* Allow both sections to grow equally within the flex container */
    margin-right: 20px; /* Add space between sections */
}

.event-calendar {
    max-width: 300px;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
    margin-left: auto; /* Align to the right within the flex container */
}

.calendar {
    max-width: 800px;
    overflow: hidden;
}

.calendar-header {
    background-color: #f0f0f0;
    text-align: center;
    padding: 15px;
    font-weight: bold;
    display: flex;
    justify-content: space-around;
    font-size: 1.2em;
    border-collapse: collapse;
}

.calendar-header div {
    flex: 1;
}

.calendar-body {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    border-collapse: collapse;
}

.calendar-cell {
    border: 1px solid #ccc;
    padding: 20px;
    text-align: center;
    font-size: 1em;
    position: relative;
}

.calendar-cell.highlight {
    background-color: red;
}

.calendar-cell.highlight::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    border: 2px solid red;
    border-radius: 5px;
}

.calendar-month-year {
    font-size: 1.5em;
    margin-bottom: 20px;
}

.buttons {
    margin-top: 20px; /* Add space between calendar and buttons */
    display: flex;
    justify-content: center; /* Center the buttons horizontally */
}

.buttons .button {
    margin: 0 10px; /* Add spacing between buttons */
}

.button {
    background-color: #ccc;
    color: #000;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin: 5px;
}

.button:hover {
    background-color: #bbb;
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
    <div class="content">
        <div class="event-calendar">
            <?php if (!empty($events)) : ?>
                <?php foreach ($events as $event) : ?>
                    <div class="event">
                        <h3><?php echo $event["title"]; ?></h3>
                        <p>Date: <?php echo date("F j, Y", strtotime($event["event_date"])); ?></p>
                        <p>Time: <?php echo date("g:i A", strtotime($event["event_time"])); ?></p>
                        <p>Description: <?php echo $event["description"]; ?></p>
                        <form method="post" action="deleteEvent.php">
                            <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                            <button type="submit" class="button">Delete Event</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No events found.</p>
            <?php endif; ?>
            <!-- <div class="event">
                <h3>Hostel BBQ Party</h3>
                <p>Date: May 5, 2024</p>
                <p>Time: 6:00 PM - 10:00 PM</p>
                <p>Description: Don't miss our annual BBQ party at the hostel backyard. Bring your appetite!</p>
            </div> -->
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
            window.location.href = "eventForm.php";
        }

        function deleteEvent() {
            // Your logic to delete an event goes here
            alert("Event will be deleted.");
        }

        renderCalendar();
    </script>
</body>

</html>
