<?php

ob_start(); // Oplossing om elke uitvoer vóór header() te voorkomen
session_start(); // Het is beter om sessies te gebruiken om in te loggen

// Lijst met gebruikers en wachtwoorden (gecodeerd met sha1)
$users = [
    "user1" => sha1("pass1"),
    "user2" => sha1("pass2"),
    "user3" => sha1("pass3"),
    "user4" => sha1("pass4"),
    "user5" => sha1("pass5")
];

// Controleer de gegevens nadat het formulier is verzonden
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? "";
    $password = $_POST['password'] ?? "";
    
    // Controleer of de gebruikersnaam bestaat en of het wachtwoord overeenkomt
    if (isset($users[$username]) && $users[$username] === sha1($password)) {
            $_SESSION['username'] = $username; // Gebruikersnaam opslaan in sessie
        header("Location: welcome.php"); // Doorverwijzen naar welkomstpagina
        exit();
    } else {
        $message = "Je hebt geen toegang met deze naam- en wachtwoord-combinatie"; // Foutbericht
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post">
        <label>Gebruikersnaam:</label>
        <input type="text" name="username" required><br><br>
        <label>Wachtwoord:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Inloggen"><br><br>
    </form>
    <p style="color:red;"><?php echo $message; ?></p>
</body>
</html>
