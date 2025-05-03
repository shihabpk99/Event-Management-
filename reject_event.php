<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = $_POST['event_id'];

    $delete = "DELETE FROM events WHERE id = $event_id";
    mysqli_query($conn, $delete);

    header("Location: admin_approval.php");
    exit;
}
?>
