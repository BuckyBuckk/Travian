<?php
session_start();
if (!isset($_SESSION['username'])){
    header('location: /login');
}

require_once($_SERVER['DOCUMENT_ROOT'].'/connect.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/troopInfoLookup.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/getCurrentResources.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/getCurrentTroops.php');


if(isset($_GET['vbid'])){
    $vbid=(int)mysqli_real_escape_string($connection, $_GET['vbid']);
}
else{
    header('location: /village');
}


$currentTime = time();
$villageID = $_SESSION['idPlayer'];

$troopsToTrainNum = array();
$troopsToTrainID = array();
if(isset($_GET['unit1'])){
    array_push($troopsToTrainNum, (int)mysqli_real_escape_string($connection, $_GET['unit1']));
    array_push($troopsToTrainID, 1);
}
if(isset($_GET['unit2'])){
    array_push($troopsToTrainNum, (int)mysqli_real_escape_string($connection, $_GET['unit2']));
    array_push($troopsToTrainID, 2);
}
if(isset($_GET['unit3'])){
    array_push($troopsToTrainNum, (int)mysqli_real_escape_string($connection, $_GET['unit3']));
    array_push($troopsToTrainID, 3);
}

for($i = 0; $i < count($troopsToTrainID); $i++){
    $trainTime[$i] = TroopInfo::getTrainTime("teuton",$troopsToTrainID[$i]);
    $trainCost = TroopInfo::getTrainCost("teuton",$troopsToTrainID[$i]);
    $troopName[$i] = TroopInfo::getTroopName("teuton",$troopsToTrainID[$i]);

    $combinedTrainTime[$i] = $trainTime[$i] * $troopsToTrainNum[$i];
    $combinedTrainCost = [];
    foreach ($trainCost as $cost) {
        $combinedTrainCost[] = $cost * $troopsToTrainNum[$i];
    }
    
    //Subtract the resources that are needed to train
    $newWood -= $combinedTrainCost[0];
    $newClay -= $combinedTrainCost[1];
    $newIron -= $combinedTrainCost[2];
    $newCrop -= $combinedTrainCost[3];
    
    
}

$timeStarted = $currentTime;
$timeCompleted = $currentTime;
$combinedTrainTimeAll = 0;

if($troopProduction){
    //Queue after the last troop production time
    $getAllTroopProduction = $connection->prepare('SELECT * FROM barracksproduction WHERE idVillage= ?');
    $getAllTroopProduction->bind_param('i', $villageID);
    $getAllTroopProduction->execute();    
    $resultAllTroopProduction = $getAllTroopProduction->get_result()->fetch_all(MYSQLI_NUM);
    $getAllTroopProduction->close();

    $lastTroopProduction = $resultAllTroopProduction[count($resultAllTroopProduction)-1];

    $timeStarted = $lastTroopProduction[6];
    $timeCompleted = $lastTroopProduction[6];
}

if($newWood>=0 && $newClay>=0 && $newIron>=0 && $newCrop>=0){
    for($i = 0; $i < count($troopsToTrainID); $i++){
        $timeStarted = $timeCompleted;
        $timeCompleted = $timeStarted + (int)$combinedTrainTime[$i];
        $combinedTrainTimeAll += (int)$combinedTrainTime[$i];

        //Insert into barracks production
        
        $barracksProduction = $connection->prepare("INSERT INTO barracksproduction (idvillage,unitname,unitid,unitcount,unitprodtime,timestarted,timecompleted,lastupdate) VALUES (?,?,?,?,?,?,?,?)");
        $barracksProduction->bind_param("isiidiii", $villageID, $troopName[$i], $troopsToTrainID[$i], $troopsToTrainNum[$i], $trainTime[$i], $timeStarted, $timeCompleted, $timeStarted);
        $barracksProduction->execute();
        $barracksProduction->close();
        
        $updateCurrentRes = $connection->prepare("UPDATE villageresources SET currentWood=?,currentClay=?,currentIron=?,currentCrop=?,lastUpdate=? WHERE idVillage = ?");
        $updateCurrentRes->bind_param("ddddii", $newWood,$newClay,$newIron,$newCrop,$currentTime,$villageID);
        $updateCurrentRes->execute();
        $updateCurrentRes->close();        
        
    }
    header('location: /village/villageBuilding/?vbid='.$vbid);
    //header('location: /resources');
}
//If there arent enough resources redirect to barracks
else{
    header('location: /village/villageBuilding/?vbid='.$vbid);
}
?>