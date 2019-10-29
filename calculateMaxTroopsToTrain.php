<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/connect.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/getCurrentResources.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/troopInfoLookup.php');

    $maxTroopsToTrain = [];
    for($i = 1; $i < 11; $i++){
        $trainCost = TroopInfo::getTrainCost("teuton",$i);
        $maxTroopsWood = (int)($newWood / $trainCost[0]);
        $maxTroopsClay = (int)($newClay / $trainCost[1]);
        $maxTroopsIron = (int)($newIron / $trainCost[2]);
        $maxTroopsCrop = (int)($newCrop / $trainCost[3]);

        $maxTroopsToTrain[$i] = min($maxTroopsWood,$maxTroopsClay,$maxTroopsIron,$maxTroopsCrop);
    }

?>