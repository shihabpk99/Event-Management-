<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
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
<header id="header1">
    <h1>VU Events Management</h1>

    <nav class="navbar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="create_event.php">Create Event</a></li>
            <li><a href="categorie_list.php">Categories</a></li>
            <li><a href="admin.php">Admin Panel</a></li>

            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="user_page.php">My Events</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<!--
<button id="theme-toggle">🌓</button>
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
-->
</body>
</html>
