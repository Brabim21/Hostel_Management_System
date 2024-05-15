<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['event_id']) && !empty($_POST['event_id'])) {
    $event_id = $_POST['event_id'];

    include '../configuration.php';

    $sql = "DELETE FROM events WHERE event_id = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $event_id);

    if ($stmt->execute()) {
        header("Location: eventCalendar.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }

    $stmt->close();
    $link->close();
}
