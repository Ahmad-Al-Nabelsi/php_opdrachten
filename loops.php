<?php
/*Opdracht 1
Maak gebruik van een for- of while-loop om de tafel van 1247 weer te geven.
Dus:

1 * 1247 = 1247  
2 * 1247 = 2494  
etc. etc. tot  
1247 * 1247 = 1555009 
Opdracht 2
Download minimaal 5 afbeeldingen naar keuze. Bewerk de afbeeldingen 
zodat ze netjes in dezelfde verhouding zijn uitgesneden en bewaar ze op een maximaal 
formaat van 500 x 500 pixels.
Geef de afbeeldingen de volgende namen: afb1.jpg, afb2.jpb, afb3.jpg etc.
Gebruik nu een for-loop om alle plaatjes weer te geven in de browser.

Op te leveren
Je kunt de tafel van 1247 en een reeks afbeeldingen tonen in je browser.
---------------------------------------------------------------------------------------*/


// Deel 1: De tafel van 1247 tonen
echo "<h2>Tafel van 1247</h2>";
$number = 1247;

echo "<ul>";
for ($i = 1; $i <= $number; $i++) {
    echo "<li>$i * $number = " . ($i * $number) . "</li>";
}
echo "</ul>";

// Deel 2: Afbeeldingen weergeven
echo "<h2>Afbeeldingen</h2>";

$imagePath = "images/";

echo "<div style='display: flex; gap: 10px;'>";
for ($i = 1; $i <= 5; $i++) {
    $imageFile = $imagePath . "afb" . $i . ".jpg";

    if (file_exists($imageFile)) {
        echo "<img src='$imageFile' alt='Afbeelding $i' style='width: 150px; height: auto;'>";
    } else {
        echo "<p>Afbeelding $i niet gevonden!</p>";
    }
}
echo "</div>";
?>