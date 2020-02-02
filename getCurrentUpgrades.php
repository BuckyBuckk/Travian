<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/connect.php');

    $villageID = $_SESSION['idPlayer'];

    //Gets all current upgrades
    $getCurrentUpgrades = $connection->prepare('SELECT * FROM resfieldupgradetimes WHERE idVillage= ?');
    $getCurrentUpgrades->bind_param('i', $villageID);
    $getCurrentUpgrades->execute();
    $resultCurrentUpgrades = $getCurrentUpgrades->get_result();
    $getCurrentUpgrades->close();

    $currentUpgrades = $resultCurrentUpgrades->fetch_all(MYSQLI_NUM);

    //If there are 2 upgrades and the second takes less time, switch them
    if(count($currentUpgrades) == 2){
        if(($currentUpgrades[0][5] - $currentUpgrades[0][4]) > ($currentUpgrades[1][5] - $currentUpgrades[0][4])){
            $temp = $currentUpgrades[0];
            $currentUpgrades[0] = $currentUpgrades[1];
            $currentUpgrades[1] = $temp;
        }
    }
?>
