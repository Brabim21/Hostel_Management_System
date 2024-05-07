<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event Form</title>
   
</head>
<body>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
    }
   
    .popup-form {
        background-color: #fff;
        width: 300px;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Drop shadow effect */
    }
   
    .popup-form h2 {
        margin-bottom: 10px;
    }
   
    .popup-form input,
    .popup-form textarea {
        display: block;
        margin-bottom: 10px;
        width: calc(100% - 20px); /* Width minus padding */
        padding: 5px;
        font-size: 16px;
    }
   
    .popup-form input[type="submit"] {
        background-color: #ccc; /* Grey color */
        color: white;
        border: none;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-top: 10px;
        cursor: pointer;
        border-radius: 5px;
    }
   
    .popup-form input[type="submit"]:hover {
        background-color: #999; /* Darker grey on hover */
    }
</style>
    <div class="popup-form">
        <h2>Add Event</h2>
        <form id="addEventForm" action="addEvent.php" method="post">
            <input type="text" id="title" placeholder="Title" name="title" required><br>
            <input type="date" id="date" name="event_date" required><br>
            <input type="time" id="time" name="event_time" required><br>
            <textarea id="description" placeholder="Description" name="description" required></textarea><br>
            <input type="submit" value="Add Event">
        </form>
    </div>
</body>
</html>
