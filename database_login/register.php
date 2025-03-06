<?php
$conn = new mysqli('localhost', 'root', '', 'login_system');
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? "";
    $password = sha1($_POST['password'] ?? "");

    // Controleer of de gebruikersnaam niet dubbel voorkomt.
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $message = "Account succesvol aangemaakt!";
    } else {
        $message = "Deze gebruikersnaam is al in gebruik.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Registreren</title>
</head>
<body>
    <h2>Registreren</h2>
    <form method="post">
        <label>Gebruikersnaam:</label>
        <input type="text" name="username" required><br>
        <label>Wachtwoord:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Registreren">
    </form>
    <p><?php echo $message; ?></p>
</body>
</html>
