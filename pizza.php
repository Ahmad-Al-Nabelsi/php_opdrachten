<?php

// Pizza- en extra's prijzen instellen -----------------------------------------
$spianata_naam = "Spianata Piccante";
$spianata_prijs = 12.50;

$seppi_naam = "Seppi";
$seppi_prijs = 11.50;

$tirato_naam = "Tirato";
$tirato_prijs = 10.50;

$extra_olijven_naam = "Olijven";
$extra_olijven_prijs = 2.50;

$extra_kaas_naam = "Kaas";
$extra_kaas_prijs = 1.50;

$bezorgkosten = 3.50;


// Variabelen om de bestelling op te slaan ----------------------------------------
$bestelling = "";
$totaalPrijs = 0;
$bezorging = "afhalen";
$resultaat = "";


// Verwerken van de bestelling na verzending ---------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["spianata_naam"])) {
        $aantal1 = intval($_POST["spianata_naam"]);
        if ($aantal1 > 0) {
            $bestelling .= "$aantal1 x $spianata_naam - €" . number_format($spianata_prijs * $aantal1, 2) . "<br>";
            $totaalPrijs += $spianata_prijs * $aantal1;
        }
    }

    if (!empty($_POST["seppi_naam"])) {
        $aantal2 = intval($_POST["seppi_naam"]);
        if ($aantal2 > 0) {
            $bestelling .= "$aantal2 x $seppi_naam - €" . number_format($seppi_prijs * $aantal2, 2) . "<br>";
            $totaalPrijs += $seppi_prijs * $aantal2;
        }
    }

    if (!empty($_POST["tirato_naam"])) {
        $aantal3 = intval($_POST["tirato_naam"]);
        if ($aantal3 > 0) {
            $bestelling .= "$aantal3 x $tirato_naam - €" . number_format($tirato_prijs * $aantal3, 2) . "<br>";
            $totaalPrijs += $tirato_prijs * $aantal3;
        }
    }



    // Controleer extra's -----------------------------------------------------
    if (!empty($_POST["extra_olijven_naam"])) {
        $bestelling .= "Extra $extra_olijven_naam - €" . number_format($extra_olijven_prijs, 2) . "<br>";
        $totaalPrijs += $extra_olijven_prijs;
    }

    if (!empty($_POST["extra_kaas_naam"])) {
        $bestelling .= "Extra $extra_kaas_naam - €" . number_format($extra_kaas_prijs, 2) . "<br>";
        $totaalPrijs += $extra_kaas_prijs;
    }

    // Controleer de bezorgoptie 
    if (!empty($_POST["bezorgen"])) {
        $bezorging = "bezorgen";
        $bestelling .= "Bezorgkosten - €" . number_format($bezorgkosten, 2) . "<br>";
        $totaalPrijs += $bezorgkosten;
    }

    // Resultaat weergeven -----------------------------------------------------
    if ($bestelling == "") {
        $resultaat = "<p>U heeft geen pizza's besteld.</p>";
    } else {
        $resultaat = "<h2>Bedankt voor uw bestelling!</h2>" . $bestelling;
        $resultaat .= "<p><strong>Te betalen: €" . number_format($totaalPrijs, 2) . "</strong></p>";
        if ($bezorging == "bezorgen") {
            $resultaat .= "<p>U heeft gekozen voor bezorging.</p>";
        } else {
            $resultaat .= "<p>U komt de pizza zelf afhalen.</p>";
        }
    }
}
?>

<!-- HTML-code om het formulier weer te geven ------------------------------------- -->
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzeria Eenvoudig</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
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

    <div class="container">
        <h1>Bestel uw pizza</h1>

        <form action="" method="POST">

            <h2>Kies uw pizza's:</h2>

            <label style="display: flex; align-items: center; gap: 10px;">
                <img src="images/spianata.jpg" alt="" width="80">
                <input type="number" name="spianata_naam" min="0" value="0">
                <?= $spianata_naam ?> - €<?= number_format($spianata_prijs, 2) ?>
            </label><br>

            <label style="display: flex; align-items: center; gap: 10px;">
                <img src="images/seppi.jpg" alt="" width="80">
                <input type="number" name="seppi_naam" min="0" value="0">
                <?= $seppi_naam ?> - €<?= number_format($seppi_prijs, 2) ?>
            </label><br>

            <label style="display: flex; align-items: center; gap: 10px;">
                <img src="images/tirato.jpg" alt="" width="80">
                <input type="number" name="tirato_naam" min="0" value="0">
                <?= $tirato_naam ?> - €<?= number_format($tirato_prijs, 2) ?>
            </label><br>

            <h2>Extra's:</h2>

            <label>
                <input type="checkbox" name="extra_olijven_naam" value="1">
                Extra <?= $extra_olijven_naam ?> - €<?= number_format($extra_olijven_prijs, 2) ?>
            </label><br>

            <label>
                <input type="checkbox" name="extra_kaas_naam" value="1">
                Extra <?= $extra_kaas_naam ?> - €<?= number_format($extra_kaas_prijs, 2) ?>
            </label><br>

            <h2>Bezorging:</h2>
            <label>
                <input type="checkbox" name="bezorgen" value="1">
                Ik wil de pizza laten bezorgen (€<?= number_format($bezorgkosten, 2) ?>)
            </label><br>

            <button type="submit">Bestellen</button>
        </form>

        <!-- Resultaat weergeven ----------------------------------------------------- -->
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <div class="result"><?= $resultaat ?></div>
        <?php endif; ?>
    </div>

</body>

</html>