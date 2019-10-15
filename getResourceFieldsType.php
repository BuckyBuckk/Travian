<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/connect.php');

    //Get village data
    $villageID=$_SESSION['idPlayer'];

    //Get current resources
    $getResFieldType = $connection->prepare('SELECT * FROM villagefieldtypes WHERE idVillage= ?');
    $getResFieldType->bind_param('i', $villageID);
    $getResFieldType->execute();
    $resultResFieldType = $getResFieldType->get_result();

    $resFieldType = $resultResFieldType->fetch_row();
    $getResFieldType->close();

    //Colors for the frontend
    $resFieldColor = array();
    for($i = 1; $i < count($resFieldType); $i++){
        if($resFieldType[$i]=="wood"){
            $resFieldColor[$i]="Green";
        }
        else if($resFieldType[$i]=="clay"){
            $resFieldColor[$i]="Orange";
        }
        else if($resFieldType[$i]=="iron"){
            $resFieldColor[$i]="Silver";
        }
        else if($resFieldType[$i]=="crop"){
            $resFieldColor[$i]="Gold";
        }
    }

?>