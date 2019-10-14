<?php
    session_start();

    require_once($_SERVER['DOCUMENT_ROOT'].'/connect.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/resourceInfoLookup.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/refreshResources.php');

    $villageID = $_SESSION['idPlayer'];
    $rfid = (int)mysqli_real_escape_string($connection, $_GET['rfid']);
    $currentTime = time();

    $columnName="resfield".$rfid."level";

    $getResFieldLevel = $connection->prepare('SELECT * FROM villagefieldlevels WHERE idvillage= ?');
    $getResFieldLevel->bind_param('i', $villageID);
    $getResFieldLevel->execute();
    $resultResFieldLevel = $getResFieldLevel->get_result();
    $resFieldLevelRow = $resultResFieldLevel->fetch_row();

    $resFieldLevel = $resFieldLevelRow[$rfid];
    $getResFieldLevel->close();

    $getResFieldType = $connection->prepare('SELECT * FROM villagefieldtypes WHERE idVillage= ?');
    $getResFieldType->bind_param('i', $villageID);
    $getResFieldType->execute();
    $resultResFieldType = $getResFieldType->get_result();
    $resFieldTypeRow = $resultResFieldType->fetch_row();

    $resFieldType = $resFieldTypeRow[$rfid];
    $getResFieldType->close();
    
    $resFieldLevelNew=$resFieldLevel+1;

    $upgradeReqs=ResourceInfo::getUpgradeReq($resFieldType, $resFieldLevelNew);

    $resFieldTypeLong="";
    if($resFieldType=="wood"){
        $resFieldTypeLong="Woodcutter";
    }
    elseif($resFieldType=="clay"){
        $resFieldTypeLong="Claypit";
    }
    elseif($resFieldType=="iron"){
        $resFieldTypeLong="Ironmine";
    }
    elseif($resFieldType=="crop"){
        $resFieldTypeLong="Cropland";
    }

    if($newWood>=$upgradeReqs[0] && $newClay>=$upgradeReqs[1] && $newIron>=$upgradeReqs[2] && $newCrop>=$upgradeReqs[3]){        
        $timeCompleted=$currentTime+$upgradeReqs[4];
        
        $logResFieldUpgrade = $connection->prepare("INSERT INTO resfieldupgradetimes (idvillage,rfid,fieldtype,fieldlevel,timestarted,timecompleted) VALUES (?,?,?,?,?,?)");
        $logResFieldUpgrade->bind_param("iisiii", $villageID, $rfid, $resFieldTypeLong, $resFieldLevelNew, $currentTime, $timeCompleted);
        $logResFieldUpgrade->execute();
        $logResFieldUpgrade->close();

        $newWood -= $upgradeReqs[0];
        $newClay -= $upgradeReqs[1];
        $newIron -= $upgradeReqs[2];
        $newCrop -= $upgradeReqs[3];

        $updateCurrentRes = $connection->prepare("UPDATE villageresources SET currentWood=?,currentClay=?,currentIron=?,currentCrop=?,lastUpdate=? WHERE idVillage = ?");
        $updateCurrentRes->bind_param("ddddii", $newWood,$newClay,$newIron,$newCrop,$currentTime,$villageID);
        $updateCurrentRes->execute();
        $updateCurrentRes->close();

        $upgradeEventQuery = "
                CREATE EVENT IF NOT EXISTS upgradeResField".$rfid."_".$villageID."
                ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL ".$upgradeReqs[4]." SECOND
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
        header('location: /resources/resourceField/?rfid='.$rfid);
    }

?>
