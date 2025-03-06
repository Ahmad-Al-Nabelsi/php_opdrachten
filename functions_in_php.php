<?php
//====================opdracht 1==============
echo "<h1> opdracht 1: </h1><br>";
function berekenCijfer($maxPunten, $behaaldePunten) {
    // Controleer of de invoer numeriek is
    if (!is_numeric($maxPunten) || !is_numeric($behaaldePunten)) {
        return false;
    }

    // Bereken het eindresultaat
    $cijfer = ($behaaldePunten / $maxPunten) * 10;

    // Rond het resultaat af op twee decimalen en geef het terug.
    return number_format($cijfer, 2);
}

// Functietest
echo berekenCijfer(45, 29); // Output: 6.44
echo "<br>";
echo berekenCijfer(34, 31); // Output: 9.12


//=================opdracht 2 =================
echo "<h1> opdracht 2: </h1><br>";
function checkDeelbaar($getal) {
    // Controleer of de invoer alleen uit getallen bestaat.
    if (!is_numeric($getal)) {
        return ["error" => "Dit is geen nummer"];
    }

    // Deelbaarheidscontrole
    if ($getal % 3 == 0 && $getal % 5 == 0) {
        $resultaat = "Deelbaar door 3 en door 5";
    } elseif ($getal % 3 == 0) {
        $resultaat = "Deelbaar door 3 maar niet door 5";
    } elseif ($getal % 5 == 0) {
        $resultaat = "Deelbaar door 5 maar niet door 3";
    } else {
        $resultaat = "Niet deelbaar door 3 of 5";
    }

    // Resultaat retourneren als array
    return ["bericht" => $resultaat];
}

// Functietest
print_r(checkDeelbaar(15)); // Output: Deelbaar door 3 en door 5
echo "<br>";
print_r(checkDeelbaar(9));  // Output: Deelbaar door 3 maar niet door 5
echo "<br>";
print_r(checkDeelbaar(10)); // Output: Deelbaar door 5 maar niet door 3
echo "<br>";
print_r(checkDeelbaar(17)); // Output: Niet deelbaar door 3 of 5
?>
