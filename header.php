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

