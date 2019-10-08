<?php
    require_once('connect.php');

    if (!isset($_SESSION['username'])){
        header('location: /login');    
    }

    $villageID=$_SESSION['idPlayer'];
    $currentTime=time();

    $getCurrentRes = $connection->prepare('SELECT * FROM villageresources WHERE idVillage= ?');
    $getCurrentRes->bind_param('i', $villageID);
    $getCurrentRes->execute();
    $resultCurrentRes = $getCurrentRes->get_result();

    $currentRes = $resultCurrentRes->fetch_row();
    $getCurrentRes->close();

    $getProduction = $connection->prepare('SELECT * FROM villageproduction WHERE idVillage= ?');
    $getProduction->bind_param('i', $villageID);
    $getProduction->execute();    
    $resultProduction = $getProduction->get_result();

    $Production = $resultProduction->fetch_row();
    $getProduction->close();

    $timeDiff = ($currentTime-$currentRes[5])/3600;

    $newWood = $currentRes[1]+$timeDiff*$Production[1];
    $newClay = $currentRes[2]+$timeDiff*$Production[2];
    $newIron = $currentRes[3]+$timeDiff*$Production[3];
    $newCrop = $currentRes[4]+$timeDiff*$Production[4];

    //if($newWood==$currentRes[1] || $newClay==$currentRes[2] || $newIron==$currentRes[3] || $newCrop==$currentRes[4]){}
    
    $updateCurrentRes = $connection->prepare("UPDATE villageresources SET currentWood=?,currentClay=?,currentIron=?,currentCrop=?,lastUpdate=? WHERE idVillage = ?");
    $updateCurrentRes->bind_param("ddddii", $newWood,$newClay,$newIron,$newCrop,$currentTime,$villageID);
    $updateCurrentRes->execute();
    $updateCurrentRes->close();

?>