<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/connect.php');    
    require_once($_SERVER['DOCUMENT_ROOT'].'/getResourceFieldsLevel.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/getResourceFieldsType.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/resourceInfoLookup.php');
    
    $villageID=$_SESSION['idPlayer'];

    $productionWood = 0;
    $productionClay = 0;
    $productionIron = 0;
    $productionCrop = 0;

    for($i = 0; $i < count($resFieldType); $i++){
        if($resFieldType[$i]=="wood"){
            $productionWood+=ResourceInfo::getProduction("wood",$resFieldLevel[$i]);
        }
        else if($resFieldType[$i]=="clay"){
            $productionClay+=ResourceInfo::getProduction("clay",$resFieldLevel[$i]);
        }
        else if($resFieldType[$i]=="iron"){
            $productionIron+=ResourceInfo::getProduction("iron",$resFieldLevel[$i]);
        }
        else if($resFieldType[$i]=="crop"){
            $productionCrop+=ResourceInfo::getProduction("crop",$resFieldLevel[$i]);
        }
    }

    //Update the resources and last update time
    $updateProduction = $connection->prepare("UPDATE villageproduction SET productionwood=?,productionclay=?,productioniron=?,productioncrop=? WHERE idvillage = ?");
    $updateProduction->bind_param("iiiii",$productionWood,$productionClay,$productionIron,$productionCrop,$villageID);
    $updateProduction->execute();
    $updateProduction->close();
?>