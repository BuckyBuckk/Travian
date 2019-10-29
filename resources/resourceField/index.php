<?php
    //Start the Session
    session_start();

    if (!isset($_SESSION['username'])){
        header('location: /login');    
    }
    if (!isset($_GET['rfid'])){
        header('location: /resources');    
    }

    require_once($_SERVER['DOCUMENT_ROOT'].'/connect.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/resourceInfoLookup.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/getCurrentResources.php');
    
    $rfid = (int)mysqli_real_escape_string($connection, $_GET['rfid']);

    //Gets specific resource field level
    $getResFieldLevel = $connection->prepare('SELECT * FROM villagefieldlevels WHERE idvillage= ?');
    $getResFieldLevel->bind_param('i', $villageID);
    $getResFieldLevel->execute();
    $resultResFieldLevel = $getResFieldLevel->get_result();
    $resFieldLevelRow = $resultResFieldLevel->fetch_row();

    $resFieldLevel = $resFieldLevelRow[$rfid];
    $getResFieldLevel->close();

    //Gets specific resource field type
    $getResFieldType = $connection->prepare('SELECT * FROM villagefieldtypes WHERE idVillage= ?');
    $getResFieldType->bind_param('i', $villageID);
    $getResFieldType->execute();
    $resultResFieldType = $getResFieldType->get_result();
    $resFieldTypeRow = $resultResFieldType->fetch_row();

    $resFieldType = $resFieldTypeRow[$rfid];
    $getResFieldType->close();

    //Resource field type for frontend
    $resFieldTypeLong="";
    if($resFieldType=="wood"){
        $resFieldTypeLong="Woodcutter";
    }
    elseif($resFieldType=="clay"){
        $resFieldTypeLong="Claypit";
    }
    elseif($resFieldType=="iron"){
        $resFieldTypeLong="Ironmine";
    }
    elseif($resFieldType=="crop"){
        $resFieldTypeLong="Cropland";
    }

    $productionCurrLevel = ResourceInfo::getProduction($resFieldType,$resFieldLevel);
    $productionNextLevel = ResourceInfo::getProduction($resFieldType,$resFieldLevel+1);

    $upgradeReqsNextLevel = ResourceInfo::getUpgradeReq($resFieldType,$resFieldLevel+1);

    //Converts time to H:m:s
    $timeNextLevelHours = (int)($upgradeReqsNextLevel[5] / 3600);
    if($timeNextLevelHours<10){
        $timeNextLevelHours="0".$timeNextLevelHours;
    }

    $timeNextLevelMinutes = (int)($upgradeReqsNextLevel[5] % 3600 / 60);
    if($timeNextLevelMinutes<10){
        $timeNextLevelMinutes="0".$timeNextLevelMinutes;
    }

    $timeNextLevelSeconds = (int)($upgradeReqsNextLevel[5] % 3600 % 60);
    if($timeNextLevelSeconds<10){
        $timeNextLevelSeconds="0".$timeNextLevelSeconds;
    }

    $timeNextLevel=$timeNextLevelHours.":".$timeNextLevelMinutes.":"."$timeNextLevelSeconds";

    $resFieldDesc = ResourceInfo::getResFieldDesc($resFieldType);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Travian - Woodcutter</title>
    <meta name="description" content="Travian Resources">

    <link rel="icon" href="/favicon.ico">
    <link href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
</head>
<body>

    <!-- Navigation -->    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">TRAVIAN</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarNav">
            <ul class="navbar-nav ">
                <li class="nav-item active">
                    <a class="nav-link" href="/resources">Resources</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/village">Village</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/map">Map</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Stats</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/report">Reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Messages</a>
                </li>
            </ul>
        </div>
        <a class="navbar-brand" href="/logout">Logout</a>
    </nav>

    <!-- Current Resources -->
    <div class="container">
        <div class="d-flex justify-content-center" id="currentResources">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item">
                    <img style="width: 1.2rem;height: 0.9rem;" src="/img/wood.gif"> <?php echo (int)$currentRes[1]."/".(int)$maxRes[1] ?>
                </li>
                <li class="list-group-item">
                    <img style="width: 1.2rem;height: 0.9rem;" src="/img/clay.gif"> <?php echo (int)$currentRes[2]."/".(int)$maxRes[2] ?>
                </li>
                <li class="list-group-item">
                    <img style="width: 1.2rem;height: 0.9rem;" src="/img/iron.gif"> <?php echo (int)$currentRes[3]."/".(int)$maxRes[3] ?>
                </li>
                <li class="list-group-item">
                    <img style="width: 1.2rem;height: 0.9rem;" src="/img/crop.gif"> <?php echo (int)$currentRes[4]."/".(int)$maxRes[4] ?>

                </li>
            </ul>
        </div>
    </div>

    <div class="container" style="min-height:30px"></div>


    <!-- Resource Fields -->
    <div class="container">
        <div class="justify-content-center text-center">
            <h1><?php echo $resFieldTypeLong; ?> Level <?php echo $resFieldLevel; ?></h1><br />
            <h6><?php echo $resFieldDesc; ?></h6><br />
            <h5><p>Current production:        <?php echo $productionCurrLevel; ?> per hour</p></h5>
            <h5><p>Production at Level <?php echo $resFieldLevel+1; ?>:        <?php echo $productionNextLevel; ?> per hour</p></h5>
            <br />
            <h4> <p>Cost for upgrading to Level <?php echo $resFieldLevel+1; ?>:</p></h4>
            <h5> <p>
                <img style="width: 1.5rem;height: 1rem;" src="/img/wood.gif"> <?php echo $upgradeReqsNextLevel[0]; ?> |
                <img style="width: 1.5rem;height: 1rem;" src="/img/clay.gif"> <?php echo $upgradeReqsNextLevel[1]; ?> |
                <img style="width: 1.5rem;height: 1rem;" src="/img/iron.gif"> <?php echo $upgradeReqsNextLevel[2]; ?> |
                <img style="width: 1.5rem;height: 1rem;" src="/img/crop.gif"> <?php echo $upgradeReqsNextLevel[3]; ?> |
                <img style="width: 1.5rem;height: 1rem;" src="/img/consum.gif"> <?php echo $upgradeReqsNextLevel[4]; ?> |
                <img style="width: 1.5rem;height: 1rem;" src="/img/clock.gif"> <?php echo $timeNextLevel; ?></p>
            </h5>
            <h5> <a href="/upgradeResField.php?rfid=<?php echo $rfid; ?>" >Upgrade to Level <?php echo $resFieldLevel+1; ?></a> </h5>
        </div>
    </div>