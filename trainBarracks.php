<?php
session_start();
if (!isset($_SESSION['username'])){
    header('location: /login');
}

require_once($_SERVER['DOCUMENT_ROOT'].'/connect.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/troopInfoLookup.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/refreshResources.php');


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
    array_push($troopsToTrainNUM, (int)mysqli_real_escape_string($connection, $_GET['unit2']));
    array_push($troopsToTrainID, 2);
}
if(isset($_GET['unit3'])){
    array_push($troopsToTrainNum, (int)mysqli_real_escape_string($connection, $_GET['unit3']));
    array_push($troopsToTrainID, 3);
}

for($i = 0; $i < count($troopsToTrainID); $i++){
    $trainTime = TroopInfo::getTrainTime("teuton",$troopsToTrainID[$i]);
    $trainCost = TroopInfo::getTrainCost("teuton",$troopsToTrainID[$i]);
    $troopName[$i] = TroopInfo::getTroopName("teuton",$troopsToTrainID[$i]);

    $combinedTrainTime[$i] = $trainTime * $troopsToTrainNum[$i];
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

$timeStarted = 0;
$timeCompleted = $currentTime;
$combinedTrainTimeAll = 0;

if($newWood>=0 && $newClay>=0 && $newIron>=0 && $newCrop>=0){
    for($i = 0; $i < count($troopsToTrainID); $i++){
        $timeStarted = $timeCompleted;
        $timeCompleted = $timeStarted + (int)$combinedTrainTime[$i];
        $combinedTrainTimeAll += (int)$combinedTrainTime[$i];

        //Insert into barracks production
        
        $barracksProduction = $connection->prepare("INSERT INTO barracksproduction (idvillage,unitname,unitcount,unitprodtime,timestarted,timecompleted) VALUES (?,?,?,?,?,?)");
        $barracksProduction->bind_param("isidii", $villageID, $troopName[$i], $troopsToTrainNum[$i], $combinedTrainTime[$i], $timeStarted, $timeCompleted);
        $barracksProduction->execute();
        $barracksProduction->close();


        
        $updateCurrentRes = $connection->prepare("UPDATE villageresources SET currentWood=?,currentClay=?,currentIron=?,currentCrop=?,lastUpdate=? WHERE idVillage = ?");
        $updateCurrentRes->bind_param("ddddii", $newWood,$newClay,$newIron,$newCrop,$currentTime,$villageID);
        $updateCurrentRes->execute();
        $updateCurrentRes->close();

        
        //Create upgrade and delete event
        $trainEventQuery = "
                CREATE EVENT IF NOT EXISTS trainBarracks".$villageID."_".$timeCompleted." 
                ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL ".$combinedTrainTimeAll." SECOND
                DO
                DELETE FROM barracksproduction WHERE idvillage = ".$villageID." AND timecompleted = ".$timeCompleted.";"
                ;

        if($connection->query($trainEventQuery)){
        }
        else{
            echo mysqli_error($connection);
        }
        
    }
    header('location: /village/villageBuilding/?vbid='.$vbid);
}//If there arent enough resources redirect to barracks
else{
    header('location: /village/villageBuilding/?vbid='.$vbid);
}
?>