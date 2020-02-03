<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/troopInfoLookup.php');

/*
$attackersTroops = array(0,100,0,0,0,0,0,0,0,0,0);
$defendersTroops = array(0,100,0,0,0,0,0,0,0,0,0);
$attackerTribe = "teuton";
$defenderTribe = "teuton";
$type = "full";
*/

$palaceLevel = 0;
$wallLevel = 0;

/*
var_dump($attackersTroops);
echo "<br>";
var_dump($defendersTroops);
echo "<br>";
*/


$basicDefense = 10;
$troopsNumCoef = 1.5;
$totalInfAttPoints = 0;
$totalCalAttPoints = 0;
$totalInfDefPoints = 0;
$totalCalDefPoints = 0;
$totalAttPoints = 0;
$totalDefPoints = 0;
$totalAttTroops = 0;
$totalDefTroops = 0;
$totalTroopsNum = 0;
$winner = "";
$attackersTroopsAfter = [];
$defendersTroopsAfter = [];

// Get all troops into the arrays
for($i = 1; $i < 11; $i++){
    $totalAttTroops += $attackersTroops[$i];
}

for($i = 1; $i < 11; $i++){
    $totalDefTroops += $defendersTroops[$i];
}

// Add up all the troops
$totalTroopsNum = $totalAttTroops + $totalDefTroops;


// Set troopsNumCoef to the correct value
if($totalTroopsNum > 1000 && $totalTroopsNum < 1000000000){
    $troopsNumCoef = number_format(2 * (1.8592 - pow($totalTroopsNum,0.015)));
}
else if($totalTroopsNum > 1000000000){
    $troopsNumCoef = 1.2578;
}

// Calculate Attack Points
for($i = 1; $i < 11; $i++){
    if($attackerTribe == "teuton"){
        // The next if separates Calvary from Infrantry
        if($i >= 5 && $i <= 6){
            $totalCalAttPoints += TroopInfo::getTroopAttPoins($attackerTribe,$i) * $attackersTroops[$i];
        }
        else{
            $totalInfAttPoints += TroopInfo::getTroopAttPoins($attackerTribe,$i) * $attackersTroops[$i];
        }
    }
    else if($attackerTribe == "roman"){
        if($i >= 4 && $i <= 6){
            $totalCalAttPoints += TroopInfo::getTroopAttPoins($attackerTribe,$i) * $attackersTroops[$i];
        }
        else{
            $totalInfAttPoints += TroopInfo::getTroopAttPoins($attackerTribe,$i) * $attackersTroops[$i];
        }
    }
    else if($attackerTribe == "gaul"){
        if($i >= 3 && $i <= 6){
            $totalCalAttPoints += TroopInfo::getTroopAttPoins($attackerTribe,$i) * $attackersTroops[$i];
        }
        else{
            $totalInfAttPoints += TroopInfo::getTroopAttPoins($attackerTribe,$i) * $attackersTroops[$i];
        }
    }
    else if($attackerTribe == "natar"){
        if($i >= 4 && $i <= 7   ){
            $totalCalAttPoints += TroopInfo::getTroopAttPoins($attackerTribe,$i) * $attackersTroops[$i];
        }
        else{
            $totalInfAttPoints += TroopInfo::getTroopAttPoins($attackerTribe,$i) * $attackersTroops[$i];
        }
    }
}

// Calculate Defence Points
for($i = 1; $i < 11; $i++){
    $totalInfDefPoints += TroopInfo::getTroopDefPoins($defenderTribe,$i)[0] * $defendersTroops[$i];
    $totalCalDefPoints += TroopInfo::getTroopDefPoins($defenderTribe,$i)[1] * $defendersTroops[$i];
}

// Add up all the points from each side
$totalAttPoints = $totalInfAttPoints + $totalCalAttPoints;
$totalDefPoints = $totalInfDefPoints + $totalCalDefPoints;

// Calculate the real Defence Points based on the att/def ratio
$attInfRatio = number_format($totalInfAttPoints/$totalAttPoints,4);
$realDefPoints = (int)($attInfRatio*$totalInfDefPoints + (1-$attInfRatio)*$totalCalDefPoints);

// Add the Basic Defence and Palace Defensive bonuses
$realDefPoints += $basicDefense;
$realDefPoints += 2*pow($palaceLevel,2);

// Add the Wall Defensive bonus
if($defenderTribe == "teuton"){
    $realDefPoints *= pow(1.020,$wallLevel);
}
else if($defenderTribe == "roman"){
    $realDefPoints *= pow(1.030,$wallLevel);
}
else if($defenderTribe == "gaul"){
    $realDefPoints *= pow(1.025,$wallLevel);
}
$realDefPoints = (int)($realDefPoints);

// Calculate the casualties
if($totalAttPoints > $realDefPoints && $type == "full"){
    $winner = "attacker";
    $casualtiesPercentWinner = number_format(1*pow(($realDefPoints/$totalAttPoints),$troopsNumCoef),4);
    $casualtiesPercentLoser = 1;    
}
else if($totalAttPoints <= $realDefPoints && $type == "full"){
    $winner = "defender";
    $casualtiesPercentWinner = number_format(1*pow(($totalAttPoints/$realDefPoints),$troopsNumCoef),4);
    $casualtiesPercentLoser = 1;
}

if($totalAttPoints > $realDefPoints && $type == "raid"){
    $winner = "attacker";
    $x = number_format(1*pow(($realDefPoints/$totalAttPoints),$troopsNumCoef),4);
    $casualtiesPercentWinner = number_format( ($x/(1+$x)), 4);
    $casualtiesPercentLoser = 1 - $casualtiesPercentWinner;    
}
else if($totalAttPoints <= $realDefPoints && $type == "raid"){
    $winner = "defender";
    $x = number_format(1*pow(($totalAttPoints/$realDefPoints),$troopsNumCoef),4);
    $casualtiesPercentWinner = number_format( ($x/(1+$x)), 4);
    $casualtiesPercentLoser = 1 - $casualtiesPercentWinner;
}

echo $totalAttPoints."<br>";
echo $totalDefPoints."<br>";
echo $realDefPoints."<br>";
echo "winner: ".$winner."<br>";
echo $casualtiesPercentWinner."<br>";
echo $casualtiesPercentLoser."<br>";
echo $totalInfAttPoints."<br>";
echo $totalCalAttPoints."<br>";
echo $totalInfDefPoints."<br>";
echo $totalCalDefPoints."<br>";

// Remove the killed units
if($winner == "attacker"){
    for($i = 1; $i < 11; $i++){
        $attackersTroopsAfter[$i] =  (int)round(($attackersTroops[$i]*(1-$casualtiesPercentWinner)));
    }
    for($i = 1; $i < 11; $i++){
        $defendersTroopsAfter[$i] =  (int)round(($defendersTroops[$i]*(1-$casualtiesPercentLoser)));
    }
}
else if($winner == "defender"){
    for($i = 1; $i < 11; $i++){
        $attackersTroopsAfter[$i] =  (int)round(($attackersTroops[$i]*(1-$casualtiesPercentLoser)));
    }
    for($i = 1; $i < 11; $i++){
        $defendersTroopsAfter[$i] =  (int)round(($defendersTroops[$i]*(1-$casualtiesPercentWinner)));
    }
}

var_dump($attackersTroopsAfter);
echo "<br>";
var_dump($defendersTroopsAfter);
echo "<br>";


?>