<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/troopInfoLookup.php');


$attackersTroops = array(0,0,50,0,100,0,0,0,0,0,0);
$defenderTroops = array(0,0,100,0,0,0,0,0,0,0,0);

var_dump($attackersTroops);
echo "<br>";
var_dump($defenderTroops);
echo "<br>";

$totalInfAttPoints = 0;
$totalCalAttPoints = 0;
$totalInfDefPoints = 0;
$totalCalDefPoints = 0;
$totalAttPoints = 0;
$totalDefPoints = 0;
$attackerTribe = "gaul";
$defenderTribe = "roman";
$basicDefense = 10;
$palaceLevel = 0;
$wallLevel = 0;
$K = 1.5;
$winner = "";
$type = "full";

for($i = 1; $i < 11; $i++){
    if($attackerTribe == "teuton"){
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

for($i = 1; $i < 11; $i++){
    $totalInfDefPoints += TroopInfo::getTroopDefPoins($defenderTribe,$i)[0] * $defenderTroops[$i];
    $totalCalDefPoints += TroopInfo::getTroopDefPoins($defenderTribe,$i)[1] * $defenderTroops[$i];
}

$totalAttPoints = $totalInfAttPoints + $totalCalAttPoints;
$totalDefPoints = $totalInfDefPoints + $totalCalDefPoints;

$attInfRatio = number_format($totalInfAttPoints/$totalAttPoints,4);
$realDefPoints = (int)($attInfRatio*$totalInfDefPoints + (1-$attInfRatio)*$totalCalDefPoints);

$realDefPoints += $basicDefense;
$realDefPoints += 2*pow($palaceLevel,2);

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

if($totalAttPoints > $realDefPoints && $type == "full"){
    $winner = "attacker";
    $casualtiesPercentWinner = number_format(1*pow(($realDefPoints/$totalAttPoints),$K),4);
    $casualtiesPercentLoser = 1;    
}
else if($totalAttPoints <= $realDefPoints && $type == "full"){
    $winner = "defender";
    $casualtiesPercentWinner = number_format(1*pow(($totalAttPoints/$realDefPoints),$K),4);
    $casualtiesPercentLoser = 1;
}

if($totalAttPoints > $realDefPoints && $type == "raid"){
    $winner = "attacker";
    $x = number_format(1*pow(($realDefPoints/$totalAttPoints),$K),4);
    $casualtiesPercentWinner = number_format( ($x/(1+$x)), 4);
    $casualtiesPercentLoser = 1 - $casualtiesPercentWinner;    
}
else if($totalAttPoints <= $realDefPoints && $type == "raid"){
    $winner = "defender";
    $x = number_format(1*pow(($totalAttPoints/$realDefPoints),$K),4);
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

if($winner == "attacker"){
    for($i = 1; $i < 11; $i++){
        $attackersTroops[$i] =  (int)($attackersTroops[$i]*(1-$casualtiesPercentWinner));
    }
    for($i = 1; $i < 11; $i++){
        $defenderTroops[$i] =  (int)($defenderTroops[$i]*(1-$casualtiesPercentLoser));
    }
}
else if($winner == "defender"){
    for($i = 1; $i < 11; $i++){
        $attackersTroops[$i] =  (int)($attackersTroops[$i]*(1-$casualtiesPercentLoser));
    }
    for($i = 1; $i < 11; $i++){
        $defenderTroops[$i] =  (int)($defenderTroops[$i]*(1-$casualtiesPercentWinner));
    }
}

var_dump($attackersTroops);
echo "<br>";
var_dump($defenderTroops);
echo "<br>";


?>