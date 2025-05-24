<?php
include 'header.php';
include 'db.php';

// Fetch all categories for the dropdown
$cat_result = mysqli_query($conn, "SELECT * FROM categories");

// Get selected category from dropdown (if any)
$category_filter = isset($_GET['category']) ? (int)$_GET['category'] : 0;

$today = date('Y-m-d');

// Base queries
$upcoming_sql = "SELECT events.*, categories.name AS category_name
                 FROM events
                 LEFT JOIN categories ON events.category_id = categories.id
                 WHERE events.is_approved = 1 AND event_date >= '$today'";

$past_sql = "SELECT events.*, categories.name AS category_name
             FROM events
             LEFT JOIN categories ON events.category_id = categories.id
             WHERE events.is_approved = 1 AND event_date < '$today'";

// If category filter is applied
if ($category_filter > 0) {
    $upcoming_sql .= " AND events.category_id = $category_filter";
    $past_sql .= " AND events.category_id = $category_filter";
}

$upcoming = mysqli_query($conn, $upcoming_sql);
$past = mysqli_query($conn, $past_sql);
?>

<section class="home-section">
    <h2 class="section-title">📂 Select Category</h2>
    <form method="GET" style="margin: 20px;">
        <label for="category">Category:</label>
        <select name="category" id="category" onchange="this.form.submit()">
            <option value="0">-- All Categories --</option>
            <?php while ($cat = mysqli_fetch_assoc($cat_result)) : ?>
                <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $category_filter ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['name']) ?>
                </option>
            <?php endwhile; ?>
        </select>
    </form>

    <h2 class="section-title"></h2>
    <div class="slideshow-container">
        <?php while($event = mysqli_fetch_assoc($upcoming)): ?>
            <div class="event-slide">
                <img src="<?= $event['photo'] ?>" alt="Event Photo" class="clickable-image">
                <div class="slide-details">
                    <h3><?= $event['event_name'] ?></h3>
                    <p><strong>Date:</strong> <?= $event['event_date'] ?> <br> <strong>Time:</strong> <?= $event['event_time'] ?></p>
                    <p><?= $event['description'] ?></p>
                    <a class="join-btn" href="<?= $event['join_link'] ?>" target="_blank">Join Event</a>
                    <p><strong>Category:</strong> <?= htmlspecialchars($event['category_name']) ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

<?php include 'footer.php'; ?>
