<?php
    //Start the Session
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'].'/connect.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/getCurrentResources.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/getCurrentTroops.php');

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

    <title>Travian - Send Troops</title>
    <meta name="description" content="Travian Send Troops">

    <link rel="icon" href="/favicon.ico">
    <link href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
</head>
<body>

    <!-- Navigation -->    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark d-flex justify-content-between">
        <div>
        <a class="navbar-brand" href="/">TRAVIAN</a>
        </div>
        <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarNav">
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link" href="/resources">Resources</a>
                </li>
                <li class="nav-item active">
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
        <div class="d-flex justify-content-end">
        <a class="navbar-brand" href="/logout">Logout</a>
        </div>
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
            <h1> Send Troops to DestinationVillageName 10/-10</h1><br />
            <br />
            <table class="table table-bordered w-75 m-auto">
                <thead >
                    <tr>
                    <th scope="col"><img style="width: 1.2rem;height: 1rem;" src="/img/maceman.gif"></th>
                    <th scope="col"><img style="width: 1.2rem;height: 1rem;" src="/img/maceman.gif"></th>
                    <th scope="col"><img style="width: 1.2rem;height: 1rem;" src="/img/maceman.gif"></th>
                    <th scope="col"><img style="width: 1.2rem;height: 1rem;" src="/img/maceman.gif"></th>
                    <th scope="col"><img style="width: 1.2rem;height: 1rem;" src="/img/maceman.gif"></th>
                    <th scope="col"><img style="width: 1.2rem;height: 1rem;" src="/img/maceman.gif"></th>
                    <th scope="col"><img style="width: 1.2rem;height: 1rem;" src="/img/maceman.gif"></th>
                    <th scope="col"><img style="width: 1.2rem;height: 1rem;" src="/img/maceman.gif"></th>
                    <th scope="col"><img style="width: 1.2rem;height: 1rem;" src="/img/maceman.gif"></th>
                    <th scope="col"><img style="width: 1.2rem;height: 1rem;" src="/img/maceman.gif"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="align-middle">
                            <div class="input-group input-group-sm align-middle justify-content-center">
                                <input id="unit1" type="text" class="form-control w-100 text-center" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <a onclick="insertTroops(1);" href="#" style="color:green"><strong>(<span id="currentTroops1"><?php echo (int)$currentTroops[1]; ?></span>)</strong></a>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="input-group input-group-sm align-middle justify-content-center">
                                <input id="unit2" type="text" class="form-control w-100 text-center" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <a onclick="insertTroops(2);" href="#" style="color:green"><strong>(<span id="currentTroops2"><?php echo (int)$currentTroops[2]; ?></span>)</strong></a>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="input-group input-group-sm align-middle justify-content-center">
                                <input id="unit3" type="text" class="form-control w-100 text-center" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <a onclick="insertTroops(3);" href="#" style="color:green"><strong>(<span id="currentTroops3"><?php echo (int)$currentTroops[3]; ?></span>)</strong></a>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="input-group input-group-sm align-middle justify-content-center">
                                <input id="unit4" type="text" class="form-control w-100 text-center" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <a onclick="insertTroops(4);" href="#" style="color:green"><strong>(<span id="currentTroops4"><?php echo (int)$currentTroops[4]; ?></span>)</strong></a>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="input-group input-group-sm align-middle justify-content-center">
                                <input id="unit5" type="text" class="form-control w-100 text-center" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <a onclick="insertTroops(5);" href="#" style="color:green"><strong>(<span id="currentTroops5"><?php echo (int)$currentTroops[5]; ?></span>)</strong></a>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="input-group input-group-sm align-middle justify-content-center">
                                <input id="unit6" type="text" class="form-control w-100 text-center" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <a onclick="insertTroops(6);" href="#" style="color:green"><strong>(<span id="currentTroops6"><?php echo (int)$currentTroops[6]; ?></span>)</strong></a>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="input-group input-group-sm align-middle justify-content-center">
                                <input id="unit7" type="text" class="form-control w-100 text-center" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <a onclick="insertTroops(7);" href="#" style="color:green"><strong>(<span id="currentTroops7"><?php echo (int)$currentTroops[7]; ?></span>)</strong></a>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="input-group input-group-sm align-middle justify-content-center">
                                <input id="unit8" type="text" class="form-control w-100 text-center" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <a onclick="insertTroops(8);" href="#" style="color:green"><strong>(<span id="currentTroops8"><?php echo (int)$currentTroops[8]; ?></span>)</strong></a>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="input-group input-group-sm align-middle justify-content-center">
                                <input id="unit9" type="text" class="form-control w-100 text-center" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <a onclick="insertTroops(9);" href="#" style="color:green"><strong>(<span id="currentTroops9"><?php echo (int)$currentTroops[9]; ?></span>)</strong></a>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="input-group input-group-sm align-middle justify-content-center">
                                <input id="unit10" type="text" class="form-control w-100 text-center" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <a onclick="insertTroops(10);" href="#" style="color:green"><strong>(<span id="currentTroops10"><?php echo (int)$currentTroops[10]; ?></span>)</strong></a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="dropdown mt-3">
                <button class="btn btn-secondary dropdown-toggle w-25" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Reinforcement
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" id="ddItem1" href="#">Reinforcement</a>
                    <a class="dropdown-item" id="ddItem2" href="#">Full Attack</a>
                    <a class="dropdown-item" id="ddItem3" href="#">Raid Attack</a>
                </div>                    
                <div class="btn-group w-50" role="group" aria-label="Train">
                    <button onclick="sendTroops();" type="button" class="btn btn-success w-75 m-auto" id="sendType">Reinforcement</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    $("#ddItem1").click(function(){
        $("#sendType").text("Reinforcement").css({"background-color": "", "border-color": ""});
        $("#dropdownMenuButton").text("Reinforcement");
    });
    $("#ddItem2").click(function(){
        $("#sendType").text("Full Attack").css({"background-color": "darkred", "border-color": "darkred"});
        $("#dropdownMenuButton").text("Full Attack");
    });
    $("#ddItem3").click(function(){
        $("#sendType").text("Raid Attack").css({"background-color": "purple", "border-color": "purple"});
        $("#dropdownMenuButton").text("Raid Attack");
    });
    </script>
    <script>
        function insertTroops(id){           
            document.getElementById("unit"+id).value =  document.getElementById("currentTroops"+id).innerHTML;
        }
    </script>
    <script>
    function sendTroops(){
        troopsToSend="";
        for(let i = 1; i < 11; i++){
            let unit = "unit"+i;
            if(document.getElementById(unit).value){
                troopsToSend+="&"+unit+"="+document.getElementById(unit).value;
            }
        }
        if(troopsToSend){
            let sendType = document.getElementById("dropdownMenuButton").innerText.replace(" ","").toLowerCase();
            let toVillageID = <?php echo 2; ?>

            troopsToSend+="&sendType="+sendType;
            troopsToSend+="&toVillageID="+toVillageID;
            window.location.href = "/sendTroopsScript.php?"+troopsToSend;
        }
    }
    </script>
</body>
