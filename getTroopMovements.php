<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/connect.php');

    $villageID = $_SESSION['idPlayer'];

    //Gets all current upgrades
    $getVillageTroopMovements = $connection->prepare('SELECT * FROM sendtroops WHERE idvillagefrom = ? OR idvillageto = ? ORDER BY timearrived ASC');
    $getVillageTroopMovements->bind_param('ii', $villageID, $villageID);
    $getVillageTroopMovements->execute();
    $resultGetVillageTroopMovements = $getVillageTroopMovements->get_result();
    $getVillageTroopMovements->close();

    $villageTroopMovements = $resultGetVillageTroopMovements->fetch_all(MYSQLI_NUM);

    $incomingAttacks = [];
    $outgoingAttacks = [];
    $incomingReinforcements = [];
    $outgoingReinforcements = [];

    foreach($villageTroopMovements as $troopMove){
        if($troopMove[2] == $villageID){
            if($troopMove[1] == "full" || $troopMove[1] == "raid"){
                array_push($outgoingAttacks,$troopMove);
            }
            else if($troopMove[1] == "reinforcement"){
                array_push($outgoingReinforcements,$troopMove);
            }
        }

        else if($troopMove[3] == $villageID){
            if($troopMove[1] == "full" || $troopMove[1] == "raid"){
                array_push($incomingAttacks,$troopMove);
            }
            else if($troopMove[1] == "reinforcement" || $troopMove[1] == "return"){
                array_push($incomingReinforcements,$troopMove);
            }
        }
    }

?>
