<?php
/*Opdracht
Maak een calculatieprogramma voor Timmerbedrijf "About Hout".
Het programma kan uitrekenen wat het kost om hout te bestellen om een tafel te maken.
Voor het tafelblad kun je kiezen uit drie verschillende houtsoorten.
Je kunt kiezen voor een rond of voor een rechthoekig blad.
De applicatie toont het aantal m2 uit en het toont de berekende prijs.
Een test voor het programma, zodat je zeker weet dat de juiste bedragen worden gefactureerd.
------------------------------------------------------------------------------------------------*/?>

<?php
// Standaardwaarden instellen

// Hier worden de waarden uit het formulier (POST) gelezen en als er geen gegevens worden verzonden, 
// worden lege standaardwaarden ingesteld.
// Factor ?? Het is een Null Coalescing operator, 
// die wordt gebruikt om een ​​vervangende waarde op te geven als $_POST['key'] niet bestaat.
$tableShape = $_POST['tableShape'] ?? '';
$width = $_POST['width'] ?? '';
$length = $_POST['length'] ?? '';
$diameter = $_POST['diameter'] ?? '';
$woodType = $_POST['woodType'] ?? '';

// Controleer welke optie is geselecteerd

// === betekent "strikte vergelijkingsoperator" , controleert of twee waarden gelijk zijn en van hetzelfde type.
$isRechthoekig = ($tableShape === "rechthoekig");
$isRond = ($tableShape === "rond");

// Berekening initialiseren
$totalPrice = null;
$area = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['calculate'])) {
    // Prijs per m² op basis van houtsoort
    $pricePerM2 = match ($woodType) {
        'berken' => 9.50,
        'grenen' => 8.50,
        'hardhout' => 11.50,
        default => 0,
    };

    // Oppervlakte berekenen op basis van tafelvorm
    if ($isRechthoekig) {
        $area = ($width / 1000) * ($length / 1000);
    } elseif ($isRond) {
        $radius = $diameter / 2;
        $area = pi() * pow($radius / 1000, 2);
    }

    // Totale prijs berekenen
    $totalPrice = $area * $pricePerM2;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Houtcalculator</title>
    <style>
        .wood-option {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .wood-option img {
            width: 50px;
            height: 50px;
            margin-left: 10px;
            border-radius: 5px;
        }
        .result {
            background-color: #f8f8f8;
            padding: 15px;
            margin-top: 20px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>

    <h1>Houtcalculator voor Tafels</h1>
    
    <form action="" method="POST">
        <h2>Kies de vorm van de tafel:</h2>
        <label>
        <!-- Waarom gebruiken we onchange="this.form.submit();"?
        - Vernieuw de pagina automatisch zonder dat er een verzendknop nodig is.
        - Zorg voor een betere gebruikerservaring, omdat velden automatisch worden in-/uitgeschakeld op basis van de selectie.
        - Zorg ervoor dat er geen onjuiste gegevens worden ingevoerd (zoals het opgeven van de lengte en breedte van een ronde tafel). -->
            <input type="radio" name="tableShape" value="rechthoekig" <?= $isRechthoekig ? 'checked' : '' ?> onchange="this.form.submit();">
            Rechthoekige tafel
        </label><br>

        <label>
            <input type="radio" name="tableShape" value="rond" <?= $isRond ? 'checked' : '' ?> onchange="this.form.submit();">
            Ronde tafel
        </label><br>

        <h2>Voer de afmetingen in:</h2>

        <label>Breedte (mm):</label>
        <input style="display: flex; align-items:center; gap:10px;" type="number" name="width" min="100" required value="<?= htmlspecialchars($width) ?>" <?= $isRond ? 'disabled' : '' ?>><br>

        <label>Lengte (mm):</label>
        <input style="display: flex; align-items:center; gap:10px;" type="number" name="length" min="100" required value="<?= htmlspecialchars($length) ?>" <?= $isRond ? 'disabled' : '' ?>><br>

        <label>Diameter (mm):</label>
        <input style="display: flex; align-items:center; gap:10px;" type="number" name="diameter" min="100" required value="<?= htmlspecialchars($diameter) ?>" <?= $isRechthoekig ? 'disabled' : '' ?>><br>

        <h2>Kies het type hout:</h2>

        <div class="wood-option">
            <label>
            <!-- 'checked' Deze zorgt ervoor dat de vooraf gedefinieerde knop 
             actief blijft wanneer de pagina na het verzenden wordt vernieuwd. -->
                <input type="radio" name="woodType" value="berken" <?= ($woodType == 'berken') ? 'checked' : '' ?>> Berken - €9,50 per m²
            </label>
            <img src="images/berken.jpg" alt="Berken Hout">
        </div>

        <div class="wood-option">
            <label>
                <input type="radio" name="woodType" value="grenen" <?= ($woodType == 'grenen') ? 'checked' : '' ?>> Grenen - €8,50 per m²
            </label>
            <img src="images/grenen.jpg" alt="Grenen Hout">
        </div>

        <div class="wood-option">
            <label>
                <input type="radio" name="woodType" value="hardhout" <?= ($woodType == 'hardhout') ? 'checked' : '' ?>> Hardhout - €11,50 per m²
            </label>
            <img src="images/hardhout.jpg" alt="Hardhout">
        </div>

        <button type="submit" name="calculate">Bestellen</button>
    </form>

    <?php if ($totalPrice !== null): ?>
        <div class="result">
            <h2>Resultaat</h2>
            <p>Houtsoort: <strong><?= ucfirst($woodType) ?></strong></p>
            <p>Tafelvorm: <strong><?= ucfirst($tableShape) ?></strong></p>
            <p>Oppervlakte: <strong><?= number_format($area, 2) ?> m²</strong></p>
            <p>Totaalprijs: <strong>€<?= number_format($totalPrice, 2) ?></strong></p>
        </div>
    <?php endif; ?>

</body>
</html>

