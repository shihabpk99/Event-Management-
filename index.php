<?php include 'db.php'; include 'header.php';

$today = date('Y-m-d');
$upcoming = $conn->query("SELECT * FROM events WHERE is_approved = 1 AND event_date >= '$today'");
$past = $conn->query("SELECT * FROM events WHERE is_approved = 1 AND event_date < '$today'");
?>

<section class="home-section">
    <h2 class="section-title">📅 Upcoming Events</h2>
    <div class="slideshow-container">
        <?php while($event = $upcoming->fetch_assoc()): ?>
            <div class="event-slide">
            <img src="<?= $event['photo'] ?>" alt="Event Photo" class="clickable-image">
                <div class="slide-details">
                    <h3><?= $event['event_name'] ?></h3>
                    <p><strong>Date:</strong> <?= $event['event_date'] ?> <br> <strong>Time:</strong> <?= $event['event_time'] ?></p>
                    <p><?= $event['description'] ?></p>
                    <a class="join-btn" href="<?= $event['join_link'] ?>" target="_blank">Join Event</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <h2 class="section-title">🕰️ Past Events</h2>
    <div class="past-events">
        <?php while($event = $past->fetch_assoc()): ?>
            <div class="event-card">
            <img src="<?= $event['photo'] ?>" alt="Event Photo" class="clickable-image">
                <div class="event-info">
                    <h3><?= $event['event_name'] ?></h3>
                    <p><strong>Date:</strong> <?= $event['event_date'] ?> | <strong>Time:</strong> <?= $event['event_time'] ?></p>
                    <p><strong>Location:</strong> <?= $event['location'] ?></p>
                    <p><?= $event['description'] ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</section>

<?php include 'footer.php'; ?>
