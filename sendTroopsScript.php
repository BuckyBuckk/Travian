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
$userTribe = $_SESSION['playerTribe'];
$valid = true;

$getFromCoordinates = $connection->prepare('SELECT * FROM allvillages WHERE idvillage = ?');
$getFromCoordinates->bind_param('i', $villageID);
$getFromCoordinates->execute();
$resultFromCoordinates = $getFromCoordinates->get_result();
$getFromCoordinates->close();

$fromCoordinates = $resultFromCoordinates->fetch_row();

if($fromCoordinates){
    $fromX = (int)$fromCoordinates[2];
    $fromY = (int)$fromCoordinates[3];
}
else{
    $valid = false;
}

if(isset($_GET['sendType']) && isset($_GET['toX']) && isset($_GET['toY'])){
    $sendType = mysqli_real_escape_string($connection, $_GET['sendType']);
    $toX = (int)mysqli_real_escape_string($connection, $_GET['toX']);
    $toY = (int)mysqli_real_escape_string($connection, $_GET['toY']);

    $getToVillageID = $connection->prepare('SELECT * FROM allvillages WHERE Xcoordinate = ? AND Xcoordinate = ?');
    $getToVillageID->bind_param('ii', $toX, $toY);
    $getToVillageID->execute();
    $resultToVillageID = $getToVillageID->get_result();
    $getToVillageID->close();

    $toVillageID = $resultToVillageID->fetch_row();
    if(!$toVillageID){
        $valid = false;
    }
    if(!($sendType == "reinforcement" || $sendType == "fullattack" || $sendType == "raidattack")){
        $valid = false;
    }
}
else{
    $valid = false;
}



$troopsToSend = array();
for($i = 1; $i < 11; $i++){
    if(isset($_GET['unit'.$i])){
        if((int)mysqli_real_escape_string($connection, $_GET['unit'.$i]) > 0){
            $troopsToSend[$i] = (int)mysqli_real_escape_string($connection, $_GET['unit'.$i]);
        }
        else{
            $troopsToSend[$i] = 0;
        }
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

$onlyTroopsToSend = [];
for($i = 1; $i < 11; $i++){
    if($troopsToSend[$i] > 0){
        array_push($onlyTroopsToSend,$i);
    }
}

if(count($onlyTroopsToSend) <= 0){
    $valid = false;
}

if($valid){

    for($i=1;$i<11;$i++){
        $currentTroops[$i] = $currentTroops[$i]-$troopsToSend[$i];
    }
    
    $removeTroopsFromVillage = $connection->prepare("UPDATE villageowntroops SET troop1=?,troop2=?,troop3=?,troop4=?,troop5=?,troop6=?,troop7=?,troop8=?,troop9=?,troop10=? WHERE idVillage = ?");
    $removeTroopsFromVillage->bind_param("iiiiiiiiiii", $currentTroops[1],$currentTroops[2],$currentTroops[3],$currentTroops[4],$currentTroops[5],$currentTroops[6],$currentTroops[7],$currentTroops[8],$currentTroops[9],$currentTroops[10],$villageID);
    $removeTroopsFromVillage->execute();
    $removeTroopsFromVillage->close();

    $travelSpeed = TroopInfo::getSlowestTroopSpeed($userTribe,$onlyTroopsToSend);
    $travelDistance = sqrt(pow(($fromX-$toX),2)  +  pow(($fromY-$toY),2)) * 50;
    $travelTime = (int)($travelDistance/$travelSpeed);
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