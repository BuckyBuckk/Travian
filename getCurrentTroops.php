<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/connect.php');

    //Get village and time data
    $villageID = $_SESSION['idPlayer'];
    $currentTime = time();

    //Get current troops
    $getCurrentTroops = $connection->prepare('SELECT * FROM villageowntroops WHERE idVillage = ?');
    $getCurrentTroops->bind_param('i', $villageID);
    $getCurrentTroops->execute();
    $resultCurrentTroops = $getCurrentTroops->get_result();
    $getCurrentTroops->close();

    $currentTroops = $resultCurrentTroops->fetch_row();

    //Get troop production
    $getTroopProduction = $connection->prepare('SELECT * FROM barracksproduction WHERE idVillage= ?');
    $getTroopProduction->bind_param('i', $villageID);
    $getTroopProduction->execute();    
    $resultTroopProduction = $getTroopProduction->get_result();
    $getTroopProduction->close();

    $troopProduction = $resultTroopProduction->fetch_row();

    if($troopProduction){
        $troopID = (int)$troopProduction[2];

        //Calculate the time difference
        $timeDiff = $currentTime-$troopProduction[8];

        //Calculate new troops produced
        $troopsProduced = ($timeDiff/$troopProduction[4]);

        if($troopsProduced > 0){
            $deleteLater = false;

            //Check if there were too many troops produced
            if($troopsProduced >= $troopProduction[3] - $troopProduction[9]){
                $troopsProduced = $troopProduction[3] - $troopProduction[9];
                $deleteLater = true;
            }

            $troopsProducedCombined = $troopsProduced + $troopProduction[9];
            $currentTroops[$troopID] += $troopsProduced;

            if($deleteLater){
                //Delete the production entry
                $deleteBarracksProduction = $connection->prepare("DELETE FROM barracksproduction WHERE idvillage = ? AND barrprodid = ?");
                $deleteBarracksProduction->bind_param("ii", $villageID, $troopProduction[7]);
                $deleteBarracksProduction->execute();
                $deleteBarracksProduction->close();

                //Update the troops to int value
                $updateCurrentTroops = $connection->prepare("UPDATE villageowntroops SET troop".$troopID." = ? WHERE idVillage = ?");
                $updateCurrentTroops->bind_param("ii", $currentTroops[$troopID],$villageID);
                $updateCurrentTroops->execute();
                $updateCurrentTroops->close();
            }
            else{
                //Update troopsdonealready and the last update
                $updateBarracksProduction = $connection->prepare("UPDATE barracksproduction SET lastupdate = ?, troopsdonealready = ? WHERE idVillage = ? AND barrprodid = ?");
                $updateBarracksProduction->bind_param("idii", $currentTime, $troopsProducedCombined, $villageID, $troopProduction[7]);
                $updateBarracksProduction->execute();
                $updateBarracksProduction->close();

                //Update the troops
                $updateCurrentTroops = $connection->prepare("UPDATE villageowntroops SET troop".$troopID." = ? WHERE idVillage = ?");
                $updateCurrentTroops->bind_param("di", $currentTroops[$troopID],$villageID);
                $updateCurrentTroops->execute();
                $updateCurrentTroops->close();
            }
        }
    }
?>