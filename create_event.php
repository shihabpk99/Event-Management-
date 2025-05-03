<?php include 'header.php';

// Database connection
$servername ="localhost";
$username = "root";
$password = "";
$dbname = "events_management";


try{
$conn = new mysqli($servername,$username, $password, $dbname);
echo"";
}
catch(mysqli_sql_exception){
    echo"<h1>Faild to connect Database. </h1> ";
}




if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['event_name'];
    $date = $_POST['event_date'];
    $time = $_POST['event_time'];
    $loc = $_POST['location'];
    $desc = $_POST['description'];
    $link = $_POST['join_link'];

    $photo = $_FILES['photo']['name'];
    $path = "uploads/" . basename($photo);
    move_uploaded_file($_FILES['photo']['tmp_name'], $path);

    $conn->query("INSERT INTO events (event_name, event_date, event_time, location, description, join_link, photo)
        VALUES ('$name', '$date', '$time', '$loc', '$desc', '$link', '$path')");

    echo "<p>Event submitted for admin approval.</p>";
}
?>

<h2>Create a New Event</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="event_name" placeholder="Event Name" required>
    <input type="date" name="event_date" required>
    <input type="time" name="event_time" required>
    <input type="text" name="location" placeholder="Location" required>
    <textarea name="description" placeholder="Event Description" required></textarea>
    <input type="url" name="join_link" placeholder="Join Link (optional)">
    <input type="file" name="photo" required>
    <button type="submit">Submit Event</button>
</form>

<?php include 'footer.php'; ?>
