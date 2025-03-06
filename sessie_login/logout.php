<?php
session_start();
session_destroy(); // Sessie verwijderen
header("Location: login.php"); // Direct naar de inlogpagina
exit();
?>
