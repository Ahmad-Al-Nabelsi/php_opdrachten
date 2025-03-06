<?php
include_once 'core/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO user_empl (Voornaam, Achternaam, Woonplaats, Geboortedatum, Geslacht) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $_POST['Voornaam'], $_POST['Achternaam'], $_POST['Woonplaats'], $_POST['Geboortedatum'], $_POST['Geslacht']);
    
    if ($stmt->execute()) {
        header("Location: index.php?action=select");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<h2>Add Employee</h2>
<form method="POST">
    <input type="text" name="Voornaam" placeholder="First Name" required>
    <input type="text" name="Achternaam" placeholder="Last Name" required>
    <input type="text" name="Woonplaats" placeholder="City" required>
    <input type="date" name="Geboortedatum" required>
    <select name="Geslacht">
        <option value="manneljk">Male</option>
        <option value="vrouwelijk">Female</option>
        <option value="onbekend">Unknown</option>
    </select>
    <button type="submit">Add</button>
</form>
