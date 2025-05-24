<?php
session_start();
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EventSphere</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1>VU Events Management</h1>

    <nav class="navbar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="create_event.php">Create Event</a></li>
            <li><a href="admin.php">Admin Panel</a></li>
            <li><a href="categories.php">Categories</a></li>
        </ul>
    </nav>

   

    <script>
document.addEventListener("DOMContentLoaded", function () {
    const toggle = document.getElementById("theme-toggle");
    const prefersDark = localStorage.getItem("theme") === "dark";
    if (prefersDark) document.body.classList.add("dark");

    toggle.onclick = () => {
        document.body.classList.toggle("dark");
        localStorage.setItem("theme", document.body.classList.contains("dark") ? "dark" : "light");
    };
});
</script>

</header>
<button id="theme-toggle">🌓</button>
</body>
</html>




<?php

include 'db.php';

$query = "SELECT * FROM events WHERE is_approved = 0";
$result = mysqli_query($conn, $query);
?>

<h2 style="text-align:center; margin-top: 20px;">🛠 Pending Event Approvals</h2>

<div class="event-section">
    <?php while ($event = mysqli_fetch_assoc($result)) : ?>
        <div class="event-card">
            <img src="<?= $event['photo'] ?>" alt="Event Photo" class="clickable-image">
              <h3><?= $event['event_name'] ?></h3>
                    <p><strong>Date:</strong> <?= $event['event_date'] ?> <br> <strong>Time:</strong> <?= $event['event_time'] ?></p>
            <p><strong>Location:</strong> <?= htmlspecialchars($event['location']) ?></p>
            <p><strong>Description:</strong> <?= htmlspecialchars($event['description']) ?></p>
            <p><strong>Join Link:</strong> <a href="<?= $event['join_link'] ?>" target="_blank">Click to Join</a></p>
            
            <form method="POST" action="approve_event.php" style="display:inline;">
    <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
    <button type="submit" class="confirm-btn">✅ Confirm</button>
</form>

<form method="POST" action="reject_event.php" style="display:inline;">
    <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
    <button type="submit" class="reject-btn">❌ Reject</button>
</form>

        </div>
    <?php endwhile; ?>
</div>

<?php include 'footer.php'; ?>

