<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="staffDashboard.css">
</head>
<body>
    <header>
        <h1>Staff Dashboard</h1>
        <p id="account">Account</p>
    </header>
    <main>
        <nav id="sidebar">
            <h2>Dashboard</h2>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Resident Details</a></li>
                <li><a href="#">Event Calendar</a></li>

            </ul>
        </nav>
        <section class="content">
            <h2>Dashboard</h2>
            <div class="card" id="total-residents">
                <h3>Total Residents: 100</h3>
            </div>
            <div class="card" id="upcoming-events">
                <h3>Upcoming Events</h3>
                <p>Event 1</p>
                <p>Event 2</p>
                <p>Event 3</p>
            </div>
        </section>
    </main>
    <script src="script.js"></script>
</body>
</html>
