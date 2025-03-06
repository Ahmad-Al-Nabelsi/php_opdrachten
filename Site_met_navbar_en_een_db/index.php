<?php
include 'core/db_connect.php';
$action = isset($_GET['action']) ? $_GET['action'] : 'home';
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My CRUD Site</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>My CRUD site</header>

    <div class="container">
        <!-- Hoofdinhoud -->
        <main class="main-content">
            <?php
            // Controleren of bestand of pagina bestaat
            if ($action == 'edit' && isset($_GET['id'])) {
                include "content/update.php"; // Zorg ervoor dat update.php aanwezig is in de inhoud
            } elseif (file_exists("content/$action.php")) {
                include "content/$action.php";
            } else {
                include "404.php";
            }
            ?>
        </main>

        <!-- Zijmenu (rechts) -->
        <nav class="sidebar">
            <ul>
                <li><a href="index.php?action=home">Home</a></li>
                <li><a href="index.php?action=select">Content</a></li>
                <li><a href="index.php?action=about">About</a></li>
            </ul>
        </nav>
    </div>

    <footer>bla(c)2024</footer>
</body>
</html>
