<?php
include '../core/db_connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    // Het verwijderingsproces uitvoeren
    $conn->query("DELETE FROM user_empl WHERE id=$id");
    header("Location: index.php?action=select");
    exit();
} else {
    echo "ID not found!";
    exit();
}
?>
