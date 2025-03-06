<?php
include_once 'core/db_connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); //intval() is een ingebouwde PHP-functie 
    // die een waarde naar een geheel getal converteert en het gebruikt om te voorkomen dat SQL-injectie-aan
    $result = $conn->query("SELECT * FROM user_empl WHERE id=$id");
    $emp = $result->fetch_assoc();

    if ($emp) {
        echo "<h2>Employee Details</h2>";
        echo "<p>Name: " . $emp['Voornaam'] . " " . $emp['Achternaam'] . "</p>";
        echo "<p>City: " . $emp['Woonplaats'] . "</p>";
        echo "<p>Date of Birth: " . $emp['Geboortedatum'] . "</p>";
        echo "<p>Gender: " . ($emp['Geslacht'] == 'manneljk' ? 'Male' : ($emp['Geslacht'] == 'vrouwelijk' ? 'Female' : 'Unknown')) . "</p>";
    } else {
        echo "Employee not found!";
    }
} else {
    echo "No employee selected!";
}
?>
