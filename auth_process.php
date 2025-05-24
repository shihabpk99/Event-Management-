 
 <?php
session_start();
include 'db.php';

$action = $_POST['action'] ?? '';
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$redirect = $_SESSION['redirect_after_login'] ?? 'create_event.php';

if ($action === 'login') {
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if ($password === $user['password']) { // Replace with password_verify if hashed
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            unset($_SESSION['redirect_after_login']);
            header("Location: $redirect");
            exit;
        } else {
            echo "<script>alert('Wrong password'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('User not found'); window.history.back();</script>";
    }

} elseif ($action === 'register') {
    $confirm = trim($_POST['confirm_password']);

    if ($password !== $confirm) {
        echo "<script>alert('Passwords do not match'); window.history.back();</script>";
        exit;
    }

    $check_query = "SELECT * FROM users WHERE username = '$username'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Username already taken'); window.history.back();</script>";
        exit;
    }

    $insert_query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($conn, $insert_query)) {
        $_SESSION['user_id'] = mysqli_insert_id($conn);
        $_SESSION['username'] = $username;
        unset($_SESSION['redirect_after_login']);
        header("Location: $redirect");
        exit;
    } else {
        echo "<script>alert('Error creating user'); window.history.back();</script>";
    }
}
?>
