<?php
include_once 'core/db_connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM user_empl WHERE id=$id");
    $emp = $result->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $stmt = $conn->prepare("UPDATE user_empl SET Voornaam=?, Achternaam=?, Woonplaats=?, Geboortedatum=?, Geslacht=? WHERE id=?");
        $stmt->bind_param("sssssi", $_POST['Voornaam'], $_POST['Achternaam'], $_POST['Woonplaats'], $_POST['Geboortedatum'], $_POST['Geslacht'], $id);
        $stmt->execute();
        header("Location: index.php?action=select");
        exit();
    }
} else {
    echo "Employee ID not found!";
    exit();
}
?>

<h2>Edit Employee</h2>
<form method="POST">
    <input type="text" name="Voornaam" value="<?= $emp['Voornaam'] ?>" required>
    <input type="text" name="Achternaam" value="<?= $emp['Achternaam'] ?>" required>
    <input type="text" name="Woonplaats" value="<?= $emp['Woonplaats'] ?>" required>
    <input type="date" name="Geboortedatum" value="<?= $emp['Geboortedatum'] ?>" required>
    <select name="Geslacht">
        <option value="manneljk" <?= $emp['Geslacht'] == 'manneljk' ? 'selected' : '' ?>>Male</option>
        <option value="vrouwelijk" <?= $emp['Geslacht'] == 'vrouwelijk' ? 'selected' : '' ?>>Female</option>
        <option value="onbekend" <?= $emp['Geslacht'] == 'onbekend' ? 'selected' : '' ?>>Unknown</option>
    </select>
    <button type="submit">Update</button>
</form>
