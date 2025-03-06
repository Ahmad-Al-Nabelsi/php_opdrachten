<?php
session_start();

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
    <h2>Welkom <?php echo $_SESSION['user']; ?>!</h2>
    <p>Je bent ingelogd en hebt toegang tot de inhoud van de website.</p>
    <ul>
        <li><a href="content1.php">Content 1</a></li>
        <li><a href="content2.php">Content 2</a></li>
        <li><a href="content3.php">Content 3</a></li>
        <li><a href="logout.php">Uitloggen</a></li>
    </ul>
</body>
</html>
