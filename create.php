<?php
$servername = "localhost";
$username = "root"; // Update if needed
$password = ""; // Update if needed
$dbname = "events_management";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = $_POST["event_name"];
    $event_date = $_POST["event_date"];
    $event_time = $_POST["event_time"];
    $location = $_POST["location"];
    $description = $_POST["description"];

    $sql = "INSERT INTO events (event_name, event_date, event_time, location, description) 
            VALUES ('$event_name', '$event_date', '$event_time', '$location', '$description')";

    if ($conn->query($sql) === TRUE) {
        $message = "<p class='success'>Event created successfully!</p>";
    } else {
        $message = "<p class='error'>Error: " . $conn->error . "</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <link rel="stylesheet" href="create.css">
</head>
<body>
<header class="header">
        <h1>VU Events Management</h1>
    </header>

    <nav class="navbar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="create.php">Create</a></li>
        </ul>
    </nav>
    <div class="containerC">
        <h2>Create an Event</h2>
        <?php if(isset($message)) echo $message; ?>
        <form method="POST" action="">
            <label for="event_name">Event Name:</label>
            <input type="text" name="event_name" id="event_name" required>

            <label for="event_date">Date:</label>
            <input type="date" name="event_date" id="event_date" required>

            <label for="event_time">Time:</label>
            <input type="time" name="event_time" id="event_time" required>

            <label for="location">Location:</label>
            <input type="text" name="location" id="location" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea>

            <button type="submit">Create Event</button>
        </form>
    </div>
</body>
</html>
