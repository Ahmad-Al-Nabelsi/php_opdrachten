
<!-- Opdracht
Maak een formulier met een selectbox. 
In de selectbox kun je een kleur kiezen. 
Als je het formulier hebt verstuurd zie je een pagina waarvan de achtergrondkleur 
overeenkomt met de kleur die je had gekozen.
--------------------------------------------------------------------------------------- -->

 <!-- Controleer of er een kleur is geselecteerd, anders gebruik standaard 'white' -->
<?php
$backgroundColor = isset($_POST['color']) ? $_POST['color'] : 'white';
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kleurkeuze Formulier</title>
    <style>
        body {
            /* htmlspecialchars(): Het is een beveiligingsfunctie in PHP die speciale HTML-tekens omzet in beveiligde tekstcodes, 
            waardoor wordt voorkomen dat schadelijke code op de pagina wordt uitgevoerd. */
            background-color: <?php echo htmlspecialchars($backgroundColor); ?>;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
        form { 
             background: red;
            padding: 20px;
            display: inline-block;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); 
        }
    </style>
</head>
<body>

    <h2>Kies een achtergrondkleur</h2>
    <form method="post">
        <label for="color">Selecteer een kleur:</label>
        <select name="color" id="color">
            <option value="red">Rood</option>
            <option value="blue">Blauw</option>
            <option value="green">Groen</option>
            <option value="purple">Paars</option>
        </select>
        <br><br>
        <button type="submit">Verstuur</button>
    </form>

</body>
</html>