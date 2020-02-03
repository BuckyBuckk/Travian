<?php

    $start = microtime(true);
    set_time_limit(600);
    
    for ($i = 0; $i < 599; ++$i) {
        $troopMoves = checkTroopMoves();
        if( $troopMoves ){
            foreach($troopMoves as $troopMove){
                if($troopMove[1] == "full" || $troopMove[1] == "raid"){
                    executeAttacks($troopMove);
                }
                else if($troopMove[1] == "reinforcement"){
                    executeReinforcement($troopMove);
                }
                else if($troopMove[1] == "return"){
                    executeReturn($troopMove);
                }           
            }
        };
        time_sleep_until($start + $i + 1);
    }

    function checkTroopMoves(){
        require($_SERVER['DOCUMENT_ROOT'].'/connect.php');
        $currentTime = time();

        $getTroopMoves = $connection->prepare('SELECT * FROM sendtroops WHERE timearrived <= ?');
        $getTroopMoves->bind_param('i', $currentTime);
        $getTroopMoves->execute();
        $resultgetTroopMoves = $getTroopMoves->get_result()->fetch_all(MYSQLI_NUM);
        $getTroopMoves->close();

        if($resultgetTroopMoves){
            return $resultgetTroopMoves;
        }
        return null;
    }

    function executeAttacks($attack){
        require($_SERVER['DOCUMENT_ROOT'].'/connect.php');
        $currentTime = time();
        
        $getDefender = $connection->prepare('SELECT * FROM villageowntroops WHERE idvillage = ?');
        $getDefender->bind_param('i', $attack[3]);
        $getDefender->execute();
        $resultGetDefender = $getDefender->get_result()->fetch_row();
        $getDefender->close();

        
        $type = $attack[1];

        $attackerTribe = $attack[6];
        $attackersTroops = array(0,$attack[7],$attack[8],$attack[9],$attack[10],$attack[11],$attack[12],$attack[13],$attack[14],$attack[15],$attack[16]);
        
        $defenderTribe = $resultGetDefender[11];
        $defendersTroops = array(0,(int)$resultGetDefender[1],(int)$resultGetDefender[2],(int)$resultGetDefender[3],(int)$resultGetDefender[4],(int)$resultGetDefender[5],(int)$resultGetDefender[6],(int)$resultGetDefender[7],(int)$resultGetDefender[8],(int)$resultGetDefender[9],(int)$resultGetDefender[10]);

        require($_SERVER['DOCUMENT_ROOT'].'/combatCalculator.php');

        /*
        $updateTroopsAttacker = $connection->prepare("UPDATE villageowntroops SET troop1=?,troop2=?,troop3=?,troop4=?,troop5=?,troop6=?,troop7=?,troop8=?,troop9=?,troop10=? WHERE idVillage = ?");
        $updateTroopsAttacker->bind_param("iiiiiiiiiii", $attackersTroopsAfter[1],$attackersTroopsAfter[2],$attackersTroopsAfter[3],$attackersTroopsAfter[4],$attackersTroopsAfter[5],$attackersTroopsAfter[6],$attackersTroopsAfter[7],$attackersTroopsAfter[8],$attackersTroopsAfter[9],$attackersTroopsAfter[10],$attack[2]);
        $updateTroopsAttacker->execute();
        $updateTroopsAttacker->close();
        */

        $travelTime = $attack[5] - $attack[4];
        //$arrivalTime = $currentTime + $travelTime;
        $arrivalTime = $attack[5] + $travelTime;
        $sendType = "return";


        $returnTroopsAttacker = $connection->prepare("INSERT INTO sendtroops (sendType, idvillagefrom, idvillageto, timesent, timearrived, troopTribe, troop1num, troop2num, troop3num, troop4num, troop5num, troop6num, troop7num, troop8num, troop9num, troop10num) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $returnTroopsAttacker->bind_param("siiiisiiiiiiiiii", $sendType, $attack[3], $attack[2], $currentTime, $arrivalTime, $attack[6], $attackersTroopsAfter[1],$attackersTroopsAfter[2],$attackersTroopsAfter[3],$attackersTroopsAfter[4],$attackersTroopsAfter[5],$attackersTroopsAfter[6],$attackersTroopsAfter[7],$attackersTroopsAfter[8],$attackersTroopsAfter[9],$attackersTroopsAfter[10]);
        $returnTroopsAttacker->execute();
        $returnTroopsAttacker->close();

        print("ok");

        
        $updateTroopsDefender = $connection->prepare("UPDATE villageowntroops SET troop1=?,troop2=?,troop3=?,troop4=?,troop5=?,troop6=?,troop7=?,troop8=?,troop9=?,troop10=? WHERE idVillage = ?");
        $updateTroopsDefender->bind_param("iiiiiiiiiii", $defendersTroopsAfter[1],$defendersTroopsAfter[2],$defendersTroopsAfter[3],$defendersTroopsAfter[4],$defendersTroopsAfter[5],$defendersTroopsAfter[6],$defendersTroopsAfter[7],$defendersTroopsAfter[8],$defendersTroopsAfter[9],$defendersTroopsAfter[10],$attack[3]);
        $updateTroopsDefender->execute();
        $updateTroopsDefender->close();
        

        $deleteAttack = $connection->prepare("DELETE FROM sendtroops WHERE sendtroopsid = ?");
        $deleteAttack->bind_param("i", $attack[0]);
        $deleteAttack->execute();
        $deleteAttack->close();
        
    }

    function executeReinforcement($reinforcement){
        require($_SERVER['DOCUMENT_ROOT'].'/connect.php');

        $insertReinforcement = $connection->prepare("INSERT INTO villagereinforcements (idvillage, idvillagefrom, tribe, troop1, troop2, troop3, troop4, troop5, troop6, troop7, troop8, troop9, troop10) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $insertReinforcement->bind_param("iisiiiiiiiiii", $reinforcement[3], $reinforcement[2], $reinforcement[6], $reinforcement[7],$reinforcement[8],$reinforcement[9],$reinforcement[10],$reinforcement[11],$reinforcement[12],$reinforcement[13],$reinforcement[14],$reinforcement[15],$reinforcement[16]);
        $insertReinforcement->execute();

        if($insertReinforcement){
            $insertReinforcement->close();

            $deleteReinforcement = $connection->prepare("DELETE FROM sendtroops WHERE sendtroopsid = ?");
            $deleteReinforcement->bind_param("i", $reinforcement[0]);
            $deleteReinforcement->execute();
            $deleteReinforcement->close();
        }
    }

    function executeReturn($return){
        require($_SERVER['DOCUMENT_ROOT'].'/connect.php');
        
        $addTroops = $connection->prepare("UPDATE villageowntroops SET troop1=troop1+?,troop2=troop2+?,troop3=troop3+?,troop4=troop4+?,troop5=troop5+?,troop6=troop6+?,troop7=troop7+?,troop8=troop8+?,troop9=troop9+?,troop10=troop10+? WHERE idVillage = ?");
        $addTroops->bind_param("iiiiiiiiiii", $return[7],$return[8],$return[9],$return[10],$return[11],$return[12],$return[13],$return[14],$return[15],$return[16],$return[3]);
        $addTroops->execute();

        if($addTroops){
            $addTroops->close();

            $deleteReturn = $connection->prepare("DELETE FROM sendtroops WHERE sendtroopsid = ?");
            $deleteReturn->bind_param("i", $return[0]);
            $deleteReturn->execute();
            $deleteReturn->close();
        }
    }
?>