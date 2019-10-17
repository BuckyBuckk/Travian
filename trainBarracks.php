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

$unitsToTrain=[];
if(isset($_GET['unit1'])){
    $unitsToTrain[1]=(int)mysqli_real_escape_string($connection, $_GET['unit1']);
}
if(isset($_GET['unit2'])){
    $unitsToTrain[2]=(int)mysqli_real_escape_string($connection, $_GET['unit2']);
}

$combinedTrainTime = 0;
for($i = 1; $i < count($unitsToTrain)+1; $i++){
    $trainTime = TroopInfo::getTrainTime("teuton",$i);
    $trainCost = TroopInfo::getTrainCost("teuton",$i);

    $combinedTrainTime += $trainTime * $unitsToTrain[$i];
    $combinedTrainCost = [];
    foreach ($trainCost as $cost) {
        $combinedTrainCost[] = $cost * $unitsToTrain[$i];
    }

    if($newWood>=$combinedTrainCost[0] && $newClay>=$combinedTrainCost[1] && $newIron>=$combinedTrainCost[2] && $newCrop>=$combinedTrainCost[3]){
        //Subtract the resources that are needed to train
        $newWood -= $combinedTrainCost[0];
        $newClay -= $combinedTrainCost[1];
        $newIron -= $combinedTrainCost[2];
        $newCrop -= $combinedTrainCost[3];
    }
    else{
        header('location: /village/villageBuilding/?vbid='.$vbid);
    }
}


var_dump($combinedTrainTime);

if(0){
    $timeCompleted=$currentTime+$upgradeReqs[5];
    
    //Inserts into pending upgrades
    $logResFieldUpgrade = $connection->prepare("INSERT INTO resfieldupgradetimes (idvillage,rfid,fieldtype,fieldlevel,timestarted,timecompleted) VALUES (?,?,?,?,?,?)");
    $logResFieldUpgrade->bind_param("iisiii", $villageID, $rfid, $resFieldTypeLong, $resFieldLevelNew, $currentTime, $timeCompleted);
    $logResFieldUpgrade->execute();
    $logResFieldUpgrade->close();

    

    $updateCurrentRes = $connection->prepare("UPDATE villageresources SET currentWood=?,currentClay=?,currentIron=?,currentCrop=?,lastUpdate=? WHERE idVillage = ?");
    $updateCurrentRes->bind_param("ddddii", $newWood,$newClay,$newIron,$newCrop,$currentTime,$villageID);
    $updateCurrentRes->execute();
    $updateCurrentRes->close();

    //Create upgrade and delete event
    $upgradeEventQuery = "
            CREATE EVENT IF NOT EXISTS upgradeResField".$rfid."_".$villageID."
            ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL ".$upgradeReqs[5]." SECOND
            DO
            BEGIN
            UPDATE villagefieldlevels SET ".$columnName." = ".$resFieldLevelNew." WHERE idvillage = ".$villageID.";
            DELETE FROM resfieldupgradetimes WHERE idvillage = ".$villageID." AND rfid = ".$rfid.";
            END"
            ;

    if($connection->query($upgradeEventQuery)){
        header('location: /resources');
    }
    else{
        echo "query error";
    }
}
else{
}



?>