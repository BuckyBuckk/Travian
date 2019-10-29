<?php
    //Start the Session
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'].'/connect.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/getCurrentResources.php');

    if (!isset($_SESSION['username'])){
        header('location: /login');    
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Travian - Map</title>
    <meta name="description" content="Travian Map">

    <link rel="icon" href="/favicon.ico">
    <link href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="mapHexCss.css" type="text/css">

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
                <li class="nav-item">
                    <a class="nav-link" href="/resources">Resources</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/village">Village</a>
                </li>
                <li class="nav-item active">
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

    <!-- Main Body -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="h2 text-center"></p>
                <div class="grid">
                    <ul id="hexGrid" style="padding-left: 0px;">
                        <!-- Row 1 -->
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <!-- Row 2 -->
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <!-- Row 3 -->
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <!-- Row 4 -->
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:ForestGreen'>
                                    <p style="top:25%;font-weight:600;opacity:1;color:black"> <?php echo $_SESSION['username']." (capital)"; //tuki more bit village name ?></p>
                                </div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <!-- Row 5 -->
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <!-- Row 6 -->
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <!-- Row 7 -->
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="mapTile?mtid=1">
                                <div class='img' style='background-color:GreenYellow'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>