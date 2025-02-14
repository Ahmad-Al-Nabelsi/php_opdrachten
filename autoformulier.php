<?php
// Beschikbare automerken en bijbehorende afbeeldingen
$autos = [
    "audi" => ["audi1.jpg", "audi2.jpg"],
    "mercedes" => ["mercedes1.jpg", "mercedes2.jpg"],
    "ford" => ["ford1.jpg", "ford2.jpg"],
    "bmw" => ["bmw1.jpg", "bmw2.jpg"],
    "volkswagen" => ["vw1.jpg", "vw2.jpg"]
];

// Controleer welke merken geselecteerd zijn
$gekozenAutos = $_POST['autos'] ?? [];
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kleurkiezer - Auto's</title>
    <style>
        .container { width: 50%; margin: auto; padding: 20px; text-align: center; }
        .result { margin-top: 20px; }
        img { width: 200px; height: auto; margin: 10px; }
    </style>
</head>
<body>

<div class="container">
    <h1>Kies je favoriete automerken</h1>
    
    <form action="" method="POST">
        <?php foreach ($autos as $merk => $afbeeldingen): ?>
            <label>
                <input type="checkbox" name="autos[]" value="<?= $merk ?>" 
                    <?= in_array($merk, $gekozenAutos) ? 'checked' : '' ?>>
                <?= ucfirst($merk) ?>
            </label><br>
        <?php endforeach; ?>
        <button type="submit">Toon afbeeldingen</button>
    </form>

    <?php if (!empty($gekozenAutos)): ?>
        <div class="result">
            <h2>Gekozen automerken:</h2>
            <?php foreach ($gekozenAutos as $merk): ?>
                <?php if (isset($autos[$merk])): ?>
                    <h3><?= ucfirst($merk) ?></h3>
                    <img src="images/<?= $autos[$merk][0] ?>" alt="<?= $merk ?>">
                    <img src="images/<?= $autos[$merk][1] ?>" alt="<?= $merk ?>">
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
