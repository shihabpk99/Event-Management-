<?php
session_start();
$admin_user = "admin";
$admin_pass = "12345";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["username"] === $admin_user && $_POST["password"] === $admin_pass) {
        $_SESSION["admin_logged_in"] = true;
        header("Location: admin_approval.php");
        exit;
    } else {
        $error = "Invalid credentials!";
    }
}
?>
<?php include 'header.php';?>


        <h2>Admin Login</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Admin Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
