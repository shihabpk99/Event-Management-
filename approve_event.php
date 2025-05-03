<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = $_POST['event_id'];

    $update = "UPDATE events SET is_approved = 1 WHERE id = $event_id";
    mysqli_query($conn, $update);

    header("Location: admin_approval.php");
    exit;
}
?>
