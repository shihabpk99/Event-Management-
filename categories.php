<?php
include 'header.php';
include 'db.php';

// Handle category form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['category_name']);
    if (!empty($name)) {
        mysqli_query($conn, "INSERT INTO categories (name) VALUES ('$name')");
    }
}

// Get existing categories
$categories = mysqli_query($conn, "SELECT * FROM categories");
?>

<h2 style="text-align:center; margin-top: 20px;">📁 Manage Categories</h2>

<div style="max-width: 400px; margin: auto;">
    <form method="POST" style="margin-bottom: 30px;">
        <input type="text" name="category_name" placeholder="Enter category name" required style="width: 100%; padding: 10px; margin-bottom: 10px;">
        <button type="submit" class="confirm-btn" style="width: 100%;">➕ Add Category</button>
    </form>

    <h3>📂 Available Categories:</h3>
    <ul>
        <?php while ($cat = mysqli_fetch_assoc($categories)) : ?>
            <li><?= htmlspecialchars($cat['name']) ?></li>
        <?php endwhile; ?>
    </ul>
</div>
                        
<?php include 'footer.php'; ?>
