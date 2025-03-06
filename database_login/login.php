<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'login_system');

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? "";
    $password = sha1($_POST['password'] ?? ""); // Gebruik sha1-codering voor wachtwoorden

    // Gebruikersgegevens in database verifiëren
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['user'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $message = "Je hebt geen toegang met deze naam- en wachtwoord-combinatie!";
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
        <input type="text" name="username" required><br>
        <label>Wachtwoord:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Inloggen">
    </form>
    <p style="color:red;"><?php echo $message; ?></p>
</body>
</html>
