<?php
session_start();
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit;
}

?>


<?php
include 'header.php';
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

