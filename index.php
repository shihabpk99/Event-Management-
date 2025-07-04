<?php
include 'header.php';
include 'db.php';

// Fetch all categories for the dropdown
$cat_result = mysqli_query($conn, "SELECT * FROM categories");

// Get selected category from dropdown (if any)
$category_filter = isset($_GET['category']) ? (int)$_GET['category'] : 0;

$today = date('Y-m-d');

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

<h2 class="section-title">📅 Upcoming Events</h2>
<div class="slideshow-container">
    <?php while($event = mysqli_fetch_assoc($upcoming)): ?>
        <div class="event-slide">
            <img src="<?= $event['photo'] ?>" alt="Event Photo" class="clickable-image">
            <div class="slide-details">
                <h3><?= $event['event_name'] ?></h3>
                <p><strong>Date:</strong> <?= $event['event_date'] ?> <br> <strong>Time:</strong> <?= $event['event_time'] ?></p>
                <p><strong>Location:</strong> <?= $event['location'] ?></p>
                <p><?= mb_strimwidth($event['description'], 0, 80, "...") ?></p>
                <button class="view-more-btn" 
                    data-name="<?= htmlspecialchars($event['event_name']) ?>"
                    data-date="<?= $event['event_date'] ?>"
                    data-time="<?= $event['event_time'] ?>"
                    data-location="<?= htmlspecialchars($event['location']) ?>"
                    data-description="<?= htmlspecialchars($event['description']) ?>"
                    data-photo="<?= htmlspecialchars($event['photo']) ?>"
                    data-category="<?= htmlspecialchars($event['category_name']) ?>"
                    data-link="<?= htmlspecialchars($event['join_link']) ?>"
                >View More</button>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<h2 class="section-title">🕰️ Past Events</h2>
<div class="past-events">
    <?php while($event = mysqli_fetch_assoc($past)): ?>
        <div class="event-card">
            <img src="<?= $event['photo'] ?>" alt="Event Photo" class="clickable-image">
            <div class="event-info">
                <h3><?= $event['event_name'] ?></h3>
                <p><strong>Date:</strong> <?= $event['event_date'] ?> | <strong>Time:</strong> <?= $event['event_time'] ?></p>
                <p><strong>Location:</strong> <?= $event['location'] ?></p>
                <p><?= mb_strimwidth($event['description'], 0, 80, "...") ?></p>
                <p><strong>Category:</strong> <?= htmlspecialchars($event['category_name']) ?></p>
                <button class="view-more-btn" 
                    data-name="<?= htmlspecialchars($event['event_name']) ?>"
                    data-date="<?= $event['event_date'] ?>"
                    data-time="<?= $event['event_time'] ?>"
                    data-location="<?= htmlspecialchars($event['location']) ?>"
                    data-description="<?= htmlspecialchars($event['description']) ?>"
                    data-photo="<?= htmlspecialchars($event['photo']) ?>"
                    data-category="<?= htmlspecialchars($event['category_name']) ?>"
                    data-link="<?= htmlspecialchars($event['join_link']) ?>"
                >View More</button>
            </div>
        </div>
    <?php endwhile; ?>
</div>
</section>

<!-- Event Modal -->
<div id="event-modal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <img id="modal-photo" src="" alt="Event Photo" style="width:100%;max-height:200px;object-fit:cover;">
        <h3 id="modal-name"></h3>
        <p id="modal-date"></p>
        <p id="modal-location"></p>
        <p id="modal-description"></p>
        <a id="modal-link" class="join-btn" href="#" target="_blank" style="display:none;">Join Event</a>
        <p id="modal-category"></p>
    </div>
</div>

<!-- Modal Logic Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('event-modal');
    const closeModal = modal.querySelector('.close-modal');
    const viewMoreBtns = document.querySelectorAll('.view-more-btn');

    viewMoreBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('modal-photo').src = this.dataset.photo;
            document.getElementById('modal-name').textContent = this.dataset.name;
            document.getElementById('modal-date').textContent = `Date: ${this.dataset.date} | Time: ${this.dataset.time}`;
            document.getElementById('modal-location').textContent = `Location: ${this.dataset.location}`;
            document.getElementById('modal-description').textContent = this.dataset.description;
            document.getElementById('modal-category').textContent = `Category: ${this.dataset.category}`;
            const link = document.getElementById('modal-link');
            if (this.dataset.link) {
                link.href = this.dataset.link;
                link.style.display = '';
            } else {
                link.style.display = 'none';
            }
            modal.style.display = 'block';
        });
    });

    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
});
</script>

<?php include 'footer.php'; ?>
