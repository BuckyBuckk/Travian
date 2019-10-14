<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/connect.php');

    //Get village data
    $villageID=$_SESSION['idPlayer'];

    //Get current resources
    $getResFieldLevel = $connection->prepare('SELECT * FROM villagefieldlevels WHERE idVillage= ?');
    $getResFieldLevel->bind_param('i', $villageID);
    $getResFieldLevel->execute();
    $resultResFieldLevel = $getResFieldLevel->get_result();

    $resFieldLevel = $resultResFieldLevel->fetch_row();
    $getResFieldLevel->close();

?>