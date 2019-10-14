<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/connect.php');

    $villageID = $_SESSION['idPlayer'];

    $getCurrentUpgrades = $connection->prepare('SELECT * FROM resfieldupgradetimes WHERE idVillage= ?');
    $getCurrentUpgrades->bind_param('i', $villageID);
    $getCurrentUpgrades->execute();
    $resultCurrentUpgrades = $getCurrentUpgrades->get_result();
    $getCurrentUpgrades->close();

    $currentUpgrades = $resultCurrentUpgrades->fetch_all(MYSQLI_NUM);
?>
