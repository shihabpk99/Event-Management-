<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "events_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Management</title>
    <link rel="stylesheet" href="style.css">
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

    <section class="events-section">
        <h2>Upcoming Events</h2>
        <div class="events-container">
            <div class="event-card">
                <h3>Event Title 1</h3>
                <p>Date: yyyy-mm-dd</p>
                <p>Location: Event Location 1</p>
                <p>Description of the event. Details about the event go here.</p>
            </div>
            <div class="event-card">
                <h3>Event Title 2</h3>
                <p>Date: yyyy-mm-dd</p>
                <p>Location: Event Location 2</p>
                <p>Description of the event. Details about the event go here.</p>
            </div>
            <!-- Add more event cards as needed -->
        </div>
    </section>

    <section class="past-events-section">
        <h2>Past Events</h2>
        <div class="events-container">
            <div class="event-card">
                <h3>Event Title 1</h3>
                <p>Date: yyyy-mm-dd</p>
                <p>Location: Event Location 1</p>
                <p>Description of the past event. Details about the event go here.</p>
            </div>
            <div class="event-card">
                <h3>Event Title 2</h3>
                <p>Date: yyyy-mm-dd</p>
                <p>Location: Event Location 2</p>
                <p>Description of the past event. Details about the event go here.</p>
            </div>
            <!-- Add more event cards as needed -->
        </div>
    </section>

    <footer class="footer">
        <p>&copy; 2025 Events Management. All rights reserved.</p>
    </footer>
</body>
</html>
