<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Welkom</title>
</head>
<body>
    <h2>Hey, welkom in onze app</h2>
    <a href="logout.php">Uitloggen</a>
</body>
</html>

