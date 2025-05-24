<?php
session_start();
include 'db.php';

$_SESSION['redirect_after_login'] = 'create_event.php';
include 'header.php';

if (!isset($_SESSION['user_id'])) {
    echo '<h2>Please login or register to create an event</h2>';
    include 'auth.php';
    include 'footer.php';
    exit;
}

// Handle event submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = $_POST['name'];
    $datetime = $_POST['time'];
    $event_date = date('Y-m-d', strtotime($datetime));
    $event_time = date('H:i:s', strtotime($datetime));
    $location = $_POST['location'];
    $description = $_POST['description'];
    $join_link = $_POST['join_link'];
    $category_id = $_POST['category_id'];
    $user_id = $_SESSION['user_id'];

    $photo = $_FILES['photo']['name'];
    $temp = $_FILES['photo']['tmp_name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($photo);

    if (move_uploaded_file($temp, $target_file)) {
        $query = "INSERT INTO events (event_name, event_date, event_time, location, description, join_link, photo, is_approved, category_id, user_id)
                  VALUES ('$event_name', '$event_date', '$event_time', '$location', '$description', '$join_link', '$target_file', 0, '$category_id', '$user_id')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Event created successfully! Waiting for admin approval.');</script>";
        } else {
            echo "<script>alert('Database error: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Failed to upload image.');</script>";
    }
}

// Fetch categories
$cat_result = mysqli_query($conn, "SELECT * FROM categories");
?>

<h2>Create a New Event</h2>
<form method="POST" enctype="multipart/form-data">
    <label>Event Name:</label>
    <input type="text" name="name" required>

    <label>Date & Time:</label>
    <input type="datetime-local" name="time" required>

    <label>Location:</label>
    <input type="text" name="location" required>

    <label>Description:</label>
    <textarea name="description" required></textarea>

    <label>Join Link:</label>
    <input type="url" name="join_link" required>

    <label>Category:</label>
    <select name="category_id" required>
        <option value="">-- Select Category --</option>
        <?php while ($cat = mysqli_fetch_assoc($cat_result)) : ?>
            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
        <?php endwhile; ?>
    </select>

    <label>Template Photo:</label>
    <input type="file" name="photo" required>

    <button type="submit" class="confirm-btn">Submit</button>
</form>

<?php include 'footer.php'; ?>
