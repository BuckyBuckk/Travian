<?php
    //Start the Session
    session_start();
    require_once('../../connect.php');

    if (!isset($_SESSION['username'])){
        header('location: /login');    
    }

    // GET USER RESOURCES 
    $query = $connection->prepare('SELECT * FROM playerresources WHERE idVillage= ?');
    $query->bind_param('i', $_SESSION['idPlayer']);
    $query->execute();

    // Get result
    $result = $query->get_result();

    // Save array as assocc
    $arr = $result->fetch_all(MYSQLI_ASSOC);
    //var_export($arr);

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
    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
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
                    <?php echo (int)$arr[3]['count'] ?>/100
                </li>
                <li class="list-group-item">
                    <?php echo (int)$arr[1]['count'] ?>/100
                </li>
                <li class="list-group-item">
                    <?php echo (int)$arr[0]['count'] ?>/100
                </li>
                <li class="list-group-item">
                    <?php echo (int)$arr[2]['count'] ?>/100
                </li>
            </ul>
        </div>
    </div>

    <div class="container" style="min-height:30px"></div>


    <!-- Resource Fields -->
    <div class="container">
        <div class="justify-content-center text-center">
            <h1> <?php //tuki more bit resourceField name in level glede na rfid ?> Woodcutter Level 1 </h1><br />
            <h6>Your population`s food is produced here. By increasing the farm`s level you increase its crop production. </h6> <br />
            <h5> <p><?php //current production glede na level ?>Current production:        200 per hour</p></h5>
            <h5> <p><?php //production glede na level+1 ?>Production at level 2:        300 per hour</p></h5>
            <br />
            <h4> <p><?php //Cost upgrada na level+1 ?>Cost for upgrading to Level 2:</p></h4>
            <h5> <p><?php //Cost upgrada na level+1 ?>
                <img style="width: 1.5rem;height: 1rem;" src="/img/wood.gif"> 40 |
                <img style="width: 1.5rem;height: 1rem;" src="/img/clay.gif"> 100 |
                <img style="width: 1.5rem;height: 1rem;" src="/img/iron.gif"> 50 |
                <img style="width: 1.5rem;height: 1rem;" src="/img/crop.gif"> 60 |
                <img style="width: 1.5rem;height: 1rem;" src="/img/consum.gif"> 2 |
                <img style="width: 1.5rem;height: 1rem;" src="/img/clock.gif"> 0:00:03</p>
            </h5>
            <h6> <a <?php if(0){echo 'href="#" onclick="test()"';} //check if theres enough resources to upgrade?> >Upgrade to Level 2</a> </h6>
        </div>
    </div>