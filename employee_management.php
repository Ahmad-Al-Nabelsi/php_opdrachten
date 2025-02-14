<?php
// ===== Databaseverbinding =====
$conn = mysqli_connect("localhost", "root", "", "empl");
if (!$conn) {
    die('<p style="color: red; font-weight: bold;">Kan geen verbinding maken met MySQL: ' . mysqli_connect_error() . '</p>');
}

// ===== Omgaan met het verwijderen van werknemers =====
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_employee'])) {
    $id = $_POST['delete_id'];
    mysqli_query($conn, "DELETE FROM user_empl WHERE id='$id'");
    header("Location: employee_management.php");
    exit();
}

// ===== Voeg een nieuwe werknemer toe =====
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_employee'])) {
    $Voornaam = $_POST['Voornaam'];
    $Achternaam = $_POST['Achternaam'];
    $Woonplaats = $_POST['Woonplaats'];
    $Geboortedatum = $_POST['Geboortedatum'];
    $Geslacht = $_POST['Geslacht'];

    $sql = "INSERT INTO user_empl (Voornaam, Achternaam, Woonplaats, Geboortedatum, Geslacht) 
            VALUES ('$Voornaam', '$Achternaam', '$Woonplaats', '$Geboortedatum', '$Geslacht')";
    mysqli_query($conn, $sql);
    header("Location: employee_management.php");
    exit();
}

// ===== Werknemersgegevens bewerken =====
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_employee'])) {
    $id = $_POST['id_edit'];
    $Voornaam = $_POST['Voornaam'];
    $Achternaam = $_POST['Achternaam'];
    $Woonplaats = $_POST['Woonplaats'];
    $Geboortedatum = $_POST['Geboortedatum'];
    $Geslacht = $_POST['Geslacht'];

    $sql = "UPDATE user_empl SET Voornaam='$Voornaam', Achternaam='$Achternaam', 
            Woonplaats='$Woonplaats', Geboortedatum='$Geboortedatum', Geslacht='$Geslacht' WHERE id='$id'";
    mysqli_query($conn, $sql);
    header("Location: employee_management.php");
    exit();
}

// ===== Alle werknemers terughalen =====
// Deze query haalt alle medewerkers op uit de database en slaat ze op in de $employees array
$query = mysqli_query($conn, "SELECT * FROM user_empl");
$employees = mysqli_fetch_all($query, MYSQLI_ASSOC);

// ===== Controleer of er een wijziging is =====
$edit_employee = null;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['start_edit'])) {
    $id = $_POST['id_edit'];
    $result = mysqli_query($conn, "SELECT * FROM user_empl WHERE id='$id'");
    $edit_employee = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beheer Medewerkers</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <!-- Formulier om een ​​nieuwe werknemer in te voeren-->
        <div class="form-container">
            <h2><?= $edit_employee ? '<span style="color:green;"> Wijzig Medewerker</span>' : 'Voeg een medewerker toe' ?></h2>
            <form method="POST" action="">
                <?php if ($edit_employee): ?>
                    <input type="hidden" name="id_edit" value="<?= $edit_employee['id'] ?>">
                <?php endif; ?>

                <label>Voornaam</label>
                <input type="text" name="Voornaam" value="<?= $edit_employee['Voornaam'] ?? '' ?>" required><br><br>

                <label>Achternaam</label>
                <input type="text" name="Achternaam" value="<?= $edit_employee['Achternaam'] ?? '' ?>" required><br><br>

                <label>Woonplaats</label>
                <input type="text" name="Woonplaats" value="<?= $edit_employee['Woonplaats'] ?? '' ?>" required><br><br>

                <label>Geboortedatum</label>
                <input type="date" name="Geboortedatum" value="<?= $edit_employee['Geboortedatum'] ?? '' ?>" required><br><br>

                <label>Geslacht</label>
                <select name="Geslacht">
                    <option value="manneljk" <?= isset($edit_employee) && $edit_employee['Geslacht'] == 'manneljk' ? 'selected' : '' ?>>Manneljk</option>
                    <option value="vrouwelijk" <?= isset($edit_employee) && $edit_employee['Geslacht'] == 'vrouwelijk' ? 'selected' : '' ?>>Vrouwelijk</option>
                    <option value="onbekend" <?= isset($edit_employee) && $edit_employee['Geslacht'] == 'onbekend' ? 'selected' : '' ?>>Onbekend</option>
                </select>
                <br><br><br>
                <input type="submit" name="<?= $edit_employee ? "edit_employee" : "add_employee" ?>" value="<?= $edit_employee ? "Wijzigen" : "Toevoegen" ?>">
            </form>
        </div>

        <!-- Tabel om werknemersgegevens weer te geven -->
        <div class="table-container">
            <h2>Medewerkerslijst</h2>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Voornaam</th>
                        <th>Achternaam</th>
                        <th>Woonplaats</th>
                        <th>Geboortedatum</th>
                        <th>Geslacht</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees as $emp): ?>
                        <tr>
                            <td><?= $emp['id'] ?></td>
                            <td><?= $emp['Voornaam'] ?></td>
                            <td><?= $emp['Achternaam'] ?></td>
                            <td><?= $emp['Woonplaats'] ?></td>
                            <td><?= $emp['Geboortedatum'] ?></td>
                            <td><?= $emp['Geslacht'] ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="id_edit" value="<?= $emp['id'] ?>">
                                    <button type="submit" name="start_edit">Wijzigen</button>
                                </form>

                                <form method="POST" action="" style="display:inline;">
                                    <input type="hidden" name="delete_id" value="<?= $emp['id'] ?>">
                                    <button type="submit" name="delete_employee" onclick="return confirm('Wilt u zeker verwijderen?')">
                                        Verwijderen
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
