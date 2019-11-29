<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/troopInfoLookup.php');


$attackersTroops = array(0,0,0,100,0,0,0,0,0,0,0);
$defenderTroops = array(0,0,100,0,0,0,0,0,0,0,0);
$totalAttPoints = 0;
$totalDefPoints = 0;
$K = 1.5;
$winner = "";
$type = "raid";

for($i = 1; $i < 11; $i++){
    $totalAttPoints += TroopInfo::getTroopAttPoins("roman",$i) * $attackersTroops[$i];
}
for($i = 1; $i < 11; $i++){
    $totalDefPoints += TroopInfo::getTroopDefPoins("roman",$i)[0] * $defenderTroops[$i];
}

if($totalAttPoints > $totalDefPoints && $type == "full"){
    $winner = "attacker";
    $casualtiesPercentWinner = number_format(1*pow(($totalDefPoints/$totalAttPoints),$K),4);
    $casualtiesPercentLoser = 1;    
}

if($totalAttPoints > $totalDefPoints && $type == "raid"){
    $winner = "attacker";
    $x = number_format(1*pow(($totalDefPoints/$totalAttPoints),$K),4);
    echo $x."<br>";
    $casualtiesPercentWinner = number_format( ($x/(1+$x)), 4);
    $casualtiesPercentLoser = 1 - $casualtiesPercentWinner;
    
}

echo $totalAttPoints."<br>";
echo $totalDefPoints."<br>";
echo "winner: ".$winner."<br>";
echo $casualtiesPercentWinner."<br>";
echo $casualtiesPercentLoser."<br>";

?>