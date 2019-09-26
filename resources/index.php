<?php
    //Start the Session
    session_start();
    require('../connect.php');

    if (!isset($_SESSION['username'])){
        header('location: /login');    
    }

    // GET USER RESOURCES 
    $query = $connection->prepare('SELECT * FROM playerresources WHERE idPlayer= ?');
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

    <title>Travian - Resources</title>
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
        <div class="row">
            <div class="col-md-8">
                <p class="h2 text-center"> <?php echo $_SESSION['username']." (capital)"; //tuki more bit village name ?></p>
                <div class="d-flex justify-content-center" id="resourceRow1">
                    <div class="list-group list-group-horizontal w-50" style="height:100px">
                        <button class="list-group-item w-100" style="background-color:Green" onclick='window.location.href="resourceField?rfid=1"'>
                            10
                        </button>
                        <button class="list-group-item w-100" style="background-color:Green" onclick='window.location.href="resourceField?rfid=2"'>
                            1
                        </button>
                        <button class="list-group-item w-100" style="background-color:Green" onclick='window.location.href="resourceField?rfid=3"'>
                            1
                        </button>
                        <button class="list-group-item w-100" style="background-color:Green" onclick='window.location.href="resourceField?rfid=4"'>
                            1
                        </button>
                    </div>
                </div>
                <div class="d-flex justify-content-center" id="resourceRow2">
                    <div class="list-group list-group-horizontal w-50" style="height:100px">
                        <button  class="list-group-item w-100" style="background-color:orange" onclick='window.location.href="resourceField?rfid=5"'>
                            1
                        </button >
                        <button  class="list-group-item w-100" style="background-color:orange" onclick='window.location.href="resourceField?rfid=6"'>
                            1
                        </button >
                        <button  class="list-group-item w-100" style="background-color:orange" onclick='window.location.href="resourceField?rfid=7"'>
                            1
                        </button >
                        <button  class="list-group-item w-100" style="background-color:orange" onclick='window.location.href="resourceField?rfid=8"'>
                            1
                        </button >
                    </div>
                </div>
                <div class="d-flex justify-content-center" id="resourceRow3">
                    <div class="list-group list-group-horizontal w-50" style="height:100px">
                        <button  class="list-group-item w-100" style="background-color:silver" onclick='window.location.href="resourceField?rfid=9"'>
                            1
                        </button >
                        <button  class="list-group-item w-100" style="background-color:silver" onclick='window.location.href="resourceField?rfid=10"'>
                            1
                        </button >
                        <button  class="list-group-item w-100" style="background-color:silver" onclick='window.location.href="resourceField?rfid=11"'>
                            1
                        </button >
                        <button  class="list-group-item w-100" style="background-color:silver" onclick='window.location.href="resourceField?rfid=12"'>
                            1
                        </button >
                    </div>
                </div>
                <div class="d-flex justify-content-center" id="resourceRow4">
                    <div class="list-group list-group-horizontal w-50" style="height:100px">
                        <button  class="list-group-item w-100" style="background-color:yellow" onclick='window.location.href="resourceField?rfid=13"'>
                            1
                        </button >
                        <button  class="list-group-item w-100" style="background-color:yellow" onclick='window.location.href="resourceField?rfid=14"'>
                            1
                        </button >
                        <button  class="list-group-item w-100" style="background-color:yellow" onclick='window.location.href="resourceField?rfid=15"'>
                            1
                        </button >
                        <button  class="list-group-item w-100" style="background-color:yellow" onclick='window.location.href="resourceField?rfid=16"'>
                            1
                        </button >
                        <button  class="list-group-item w-100" style="background-color:yellow" onclick='window.location.href="resourceField?rfid=17"'>
                            1
                        </button >
                        <button  class="list-group-item w-100" style="background-color:yellow" onclick='window.location.href="resourceField?rfid=18"'>
                            1
                        </button >
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <p></p>
                <p class="h3">Troop Movements:</p>
                <div class="d-flex justify-content-between">
                    <h5 style="color:Red"><img style="width: 1.2rem;" src="/img/att_inc.gif"><strong> 1 Attack<strong></h5>
                    <h5>in 0:15:06 hrs.</h5>
                </div>
                <div class="d-flex justify-content-between">
                    <h5 style="color:Orange"><img style="width: 1.2rem;" src="/img/att_out.gif"><strong> 2 Attacks<strong></h5>
                    <h5>in 1:05:35 hrs.</h5>
                </div>
                <div class="d-flex justify-content-between">
                    <h5 style="color:Green"><img style="width: 1.2rem;" src="/img/def_1.gif"><strong> 45 Reinf.<strong></h5>
                    <h5>in 0:55:30 hrs.</h5>
                </div>
                <p></p>
                <p class="h3">Production:</p>
                <div class="d-flex justify-content-between">
                    <h5><img style="width: 1.5rem;height: 1rem;" src="/img/wood.gif"> Wood:</h5>
                    <h5><strong>200</strong> per hour</h5>
                </div>
                <div class="d-flex justify-content-between">
                    <h5><img style="width: 1.5rem;height: 1rem;" src="/img/clay.gif"> Clay:</h5>
                    <h5><strong>200</strong> per hour</h5>
                </div>
                <div class="d-flex justify-content-between">
                    <h5><img style="width: 1.5rem;height: 1rem;" src="/img/iron.gif"> Iron:</h5>
                    <h5><strong>200</strong> per hour</h5>
                </div>
                <div class="d-flex justify-content-between">
                    <h5><img style="width: 1.5rem;height: 1rem;" src="/img/crop.gif"> Crop:</h5>
                    <h5><strong>200</strong> per hour</h5>
                </div>
                <p></p>
                <p class="h3">Troops:</p>
                <p class="h5">
                <?php if(1){
                    echo '
                    <div class="d-flex justify-content-center">
                        <h5><img src="/img/maceman.gif"> 48 Macemen</h5>
                    </div>
                    ';
                } // check troops from database
                else{
                    echo '
                    <div class="text-center">
                    <h5>None</h5>
                    </div>
                    ';
                }
                ?>
                </p>
            </div>
        </div>
    </div>