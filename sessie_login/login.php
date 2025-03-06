<?php
session_start();

// Inloggegevens (opgeslagen in de code)
$users = [
    "user1" => "pass1",
    "user2" => "pass2",
    "user3" => "pass3"
];

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? "";
    $password = $_POST['password'] ?? "";

    // Controleer inloggegevens
    if (isset($users[$username]) && $users[$username] === $password) {
        $_SESSION['user'] = $username; // Gebruikersnaam opslaan in sessie
        header("Location: index.php"); // Direct naar de startpagina
        exit();
    } else {
        $message = "Foutieve gebruikersnaam of wachtwoord!"; // Foutbericht
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
