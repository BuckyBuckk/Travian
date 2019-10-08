<?php
    //Start the Session
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'].'/connect.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/refreshResources.php');

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

    <title>Travian - Map Tile</title>
    <meta name="description" content="Travian Tile">

    <link rel="icon" href="/favicon.ico">
    <link href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/hexcss.css" type="text/css">

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
            <!-- Village Fields -->
            <div class="col-md-8">
                <p class="h2 text-center"><strong> <?php echo $_SESSION['username']." (capital)"; //tuki more bit village name ?></strong></p>
                <div class="grid">
                    <ul id="hexGrid" style="padding-left: 0px;">
                        <!-- Row 1 -->
                        <li class="hex">
                            <div class="hexIn">
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="resourceField?rfid=1">
                                <div class='img' style='background-color:Green'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="resourceField?rfid=1">
                                <div class='img' style='background-color:Orange'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="resourceField?rfid=1">
                                <div class='img' style='background-color:Silver'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            </div>
                        </li>
                        <!-- Row 2 -->
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="resourceField?rfid=1">
                                <div class='img' style='background-color:Silver'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="resourceField?rfid=1">
                                <div class='img' style='background-color:Gold'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="resourceField?rfid=1">
                                <div class='img' style='background-color:Gold'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="resourceField?rfid=1">
                                <div class='img' style='background-color:Green'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <!-- Row 3 -->
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="resourceField?rfid=1">
                                <div class='img' style='background-color:Orange'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="resourceField?rfid=1">
                                <div class='img' style='background-color:Gold'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="/village">
                                <div class='img' style='background-color:White'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="resourceField?rfid=1">
                                <div class='img' style='background-color:Gold'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="resourceField?rfid=1">
                                <div class='img' style='background-color:Orange'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <!-- Row 4 -->
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="resourceField?rfid=1">
                                <div class='img' style='background-color:Green'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="resourceField?rfid=1">
                                <div class='img' style='background-color:Gold'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="resourceField?rfid=1">
                                <div class='img' style='background-color:Gold'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="resourceField?rfid=1">
                                <div class='img' style='background-color:Silver'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <!-- Row 5 -->
                        <li class="hex">
                            <div class="hexIn">
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="resourceField?rfid=1">
                                <div class='img' style='background-color:Silver'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="resourceField?rfid=1">
                                <div class='img' style='background-color:Orange'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                        <li class="hex">
                            <div class="hexIn">
                            <a class="hexLink" href="resourceField?rfid=1">
                                <div class='img' style='background-color:Green'></div>
                                <h1 id="demo1"></h1>
                                <p id="demo2"></p>
                            </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Village info -->
            <div class="col-md-3 text-center">
                <p></p>
                <p class="h3">Player info:</p>
                <div class="d-flex justify-content-between">
                    <h5><strong>Tribe:<strong></h5>
                    <h5>Teutons</h5>
                </div>
                <div class="d-flex justify-content-between">
                    <h5><strong>Alliance:<strong></h5>
                    <a href="" class="h5">Santas</a>
                </div>
                <div class="d-flex justify-content-between">
                    <h5><strong>Owner:<strong></h5>
                    <a href="" class="h5">admin</a>
                </div>
                <div class="d-flex justify-content-between">
                    <h5><strong>Population:<strong></h5>
                    <h5>350</h5>
                </div>
                <p></p>
                <p class="h3">Reports:</p>
                <div class="d-flex justify-content-center">
                    <a href="" class="h5"><strong>3.10.2019</strong></a>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="" class="h5"><strong>2.10.2019</strong></a>
                </div>
                <p></p>
                <p class="h3">Options:</p>
                <div class="d-flex justify-content-center">
                    <a href="/sendTroops.php" class="h5"><strong>Send Troops</strong></a>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="" class="h5"><strong>Send Merchants</strong></a>
                </div>
            </div>
        </div>
    </div>