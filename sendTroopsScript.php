<?php 
session_start();
if (!isset($_SESSION['username'])){
    header('location: /login');
}

require_once($_SERVER['DOCUMENT_ROOT'].'/connect.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/troopInfoLookup.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/getCurrentTroops.php');

$currentTime = time();
$villageID = $_SESSION['idPlayer'];
$userTribe = "teuton";
$valid = true;

if(isset($_GET['sendType']) && isset($_GET['toVillageID'])){
    $sendType = mysqli_real_escape_string($connection, $_GET['sendType']);
    $toVillageID = mysqli_real_escape_string($connection, $_GET['toVillageID']);
}
else{
    $valid = false;
}

if(isset($_GET['sendType'])){
    $sendType = mysqli_real_escape_string($connection, $_GET['sendType']);
}

$troopsToSend = array();
for($i = 1; $i < 11; $i++){
    if(isset($_GET['unit'.$i])){
        $troopsToSend[$i] = (int)mysqli_real_escape_string($connection, $_GET['unit'.$i]);
    }
    else{
        $troopsToSend[$i] = 0;
    }
}

$anyUnits = false;
for($i = 1; $i < 11; $i++){
    if((int)$troopsToSend[$i] > (int)$currentTroops[$i]){
        $valid = false;
    }
}

if($valid){
    //TODO Calculate travel time
    $travelTime = 10;
    $arrivalTime = $currentTime + $travelTime;

    $sendTroops = $connection->prepare("INSERT INTO sendtroops (sendType, idvillagefrom, idvillageto, timesent, timearrived, troopTribe, troop1num, troop2num, troop3num, troop4num, troop5num, troop6num, troop7num, troop8num, troop9num, troop10num) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $sendTroops->bind_param("siiiisiiiiiiiiii", $sendType, $villageID, $toVillageID, $currentTime, $arrivalTime, $userTribe, $troopsToSend[1], $troopsToSend[2], $troopsToSend[3], $troopsToSend[4], $troopsToSend[5], $troopsToSend[6], $troopsToSend[7], $troopsToSend[8], $troopsToSend[9], $troopsToSend[10]);
    $sendTroops->execute();
    $sendTroops->close();

    header('location: /resources');
}
else{
    header('location: /sendTroops.php');
}


?>