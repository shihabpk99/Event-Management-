<?php
session_start();
include 'header.php';
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<p style='text-align:center;'>Please <a href='create_event.php'>login</a> to view your events.</p>";
    include 'footer.php';
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle event deletion
if (isset($_GET['delete'])) {
    $event_id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM events WHERE id = $event_id AND user_id = $user_id");
    echo "<script>alert('Event deleted'); window.location='user_page.php';</script>";
}

// Fetch events
$events = mysqli_query($conn, "SELECT * FROM events WHERE user_id = $user_id ORDER BY event_date DESC");
?>

<div class="user-events-container">
    <h2 style="text-align:center; margin-bottom: 20px;">My Created Events</h2>

    <?php if (mysqli_num_rows($events) > 0): ?>
        <?php while ($event = mysqli_fetch_assoc($events)): ?>
            <div class="event-card" style="display:flex; align-items:center; gap:20px; padding:15px; border:1px solid #ccc; border-radius:8px; margin:10px auto; max-width:800px; box-shadow:0 2px 5px rgba(0,0,0,0.1);">
                
           <div class="event-photo">
    <a href="<?= htmlspecialchars($event['photo']) ?>" target="_blank" rel="noopener noreferrer">
        <img src="<?= htmlspecialchars($event['photo']) ?>" alt="Event Photo" style="width:150px; height:auto; border-radius:8px; cursor:pointer;">
    </a>
</div>


                <div class="event-details" style="flex:1;">
                    <h3><?= htmlspecialchars($event['event_name']) ?></h3>
                    <p><strong>Date:</strong> <?= $event['event_date'] ?> <?= $event['event_time'] ?></p>
                    <p><strong>Location:</strong> <?= htmlspecialchars($event['location']) ?></p>
                    <p><strong>Status:</strong> <?= $event['is_approved'] ? '✅ Approved' : '⏳ Pending' ?></p>
                </div>

                <form method="GET" style="margin-left: 20px;">
                    <input type="hidden" name="delete" value="<?= $event['id'] ?>">
                    <button type="submit" class="delete-btn" style="background:#e74c3c; color:#fff; border:none; padding:8px 12px; border-radius:5px; cursor:pointer;">Delete</button>
                </form>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align:center;">You haven't created any events yet.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
