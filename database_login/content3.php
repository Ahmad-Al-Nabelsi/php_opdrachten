<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Content 3</title>
</head>
<body>
    <h2>Welkom bij Content 3, <?php echo $_SESSION['user']; ?>!</h2>
    <p>Dit is beveiligde content.</p>
    <a href="index.php">Terug naar Home</a>
</body>
</html>
