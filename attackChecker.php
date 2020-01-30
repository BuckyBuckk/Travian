<?php

    $start = microtime(true);
    set_time_limit(60);
    
    for ($i = 0; $i < 59; ++$i) {
        $attacks = checkAttacks();
        if( $attacks ){
            foreach($attacks as $attack){
                executeAttacks($attack);
            }
            break;
        };
        time_sleep_until($start + $i + 1);
    }

    function checkAttacks(){
        require($_SERVER['DOCUMENT_ROOT'].'/connect.php');
        $currentTime = time();

        $getAttacks = $connection->prepare('SELECT * FROM sendtroops WHERE timearrived <= ?');
        $getAttacks->bind_param('i', $currentTime);
        $getAttacks->execute();
        $resultGetAttacks = $getAttacks->get_result()->fetch_all(MYSQLI_NUM);
        $getAttacks->close();

        if($resultGetAttacks){
            return $resultGetAttacks;
        }
        return null;
    }

    function executeAttacks($attack){
        require($_SERVER['DOCUMENT_ROOT'].'/connect.php');
        
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
        
        $updateTroopsAttacker = $connection->prepare("UPDATE villageowntroops SET troop1=?,troop2=?,troop3=?,troop4=?,troop5=?,troop6=?,troop7=?,troop8=?,troop9=?,troop10=? WHERE idVillage = ?");
        $updateTroopsAttacker->bind_param("iiiiiiiiiii", $attackersTroopsAfter[1],$attackersTroopsAfter[2],$attackersTroopsAfter[3],$attackersTroopsAfter[4],$attackersTroopsAfter[5],$attackersTroopsAfter[6],$attackersTroopsAfter[7],$attackersTroopsAfter[8],$attackersTroopsAfter[9],$attackersTroopsAfter[10],$attack[2]);
        $updateTroopsAttacker->execute();
        $updateTroopsAttacker->close();

        $updateTroopsDefender = $connection->prepare("UPDATE villageowntroops SET troop1=?,troop2=?,troop3=?,troop4=?,troop5=?,troop6=?,troop7=?,troop8=?,troop9=?,troop10=? WHERE idVillage = ?");
        $updateTroopsDefender->bind_param("iiiiiiiiiii", $defendersTroopsAfter[1],$defendersTroopsAfter[2],$defendersTroopsAfter[3],$defendersTroopsAfter[4],$defendersTroopsAfter[5],$defendersTroopsAfter[6],$defendersTroopsAfter[7],$defendersTroopsAfter[8],$defendersTroopsAfter[9],$defendersTroopsAfter[10],$attack[3]);
        $updateTroopsDefender->execute();
        $updateTroopsDefender->close();

        $deleteAttack = $connection->prepare("DELETE FROM sendtroops WHERE sendtroopsid = ?");
        $deleteAttack->bind_param("i", $attack[0]);
        $deleteAttack->execute();
        $deleteAttack->close();
        
    }
?>