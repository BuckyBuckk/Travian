<?php
    //Start the Session
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'].'/connect.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/getCurrentResources.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/calculateProduction.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/getCurrentUpgrades.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/getCurrentTroops.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/calculateMaxTroopsToTrain.php');

    if (!isset($_SESSION['username'])){
        header('location: /login');    
    }

    $getAllTroopProduction = $connection->prepare('SELECT * FROM barracksproduction WHERE idVillage= ?');
    $getAllTroopProduction->bind_param('i', $villageID);
    $getAllTroopProduction->execute();    
    $allTroopProduction = $getAllTroopProduction->get_result()->fetch_all(MYSQLI_NUM);
    $getAllTroopProduction->close();

    $troopProdHtml = [];
    foreach ($allTroopProduction as $troopProd) {
        $troopProdHtml[] = 
            '<tr>
                <th scope="row" class="align-middle">
                    <img style="width: 1.2rem;height: 1rem;" src="/img/maceman.gif">'.($troopProd[3]-(int)$troopProd[9]).' '.$troopProd[1].'
                    <br />
                </th>
                <td class="align-middle">
                    <span class="trainCD">'.date("H:i:s",(int)$troopProd[6]-time()-3600).'</span>
                </td>
                <td class="align-middle">
                    '.date("H:i:s",(int)$troopProd[6]).'
                </td>
            </tr>';
    }

    //var_dump($troopProdHtml);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Travian - Barracks</title>
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
        <a class="navbar-brand" href="/logout">Logout</a>
    </nav>

    <!-- Current Resources -->
    <div class="container">
        <div class="d-flex justify-content-center" id="currentResources">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item">
                    <img style="width: 1.2rem;height: 0.9rem;" src="/img/wood.gif">
                    <span id="currentWood"><?php echo (int)$newWood; ?></span>/<span id="maxWood"><?php echo (int)$maxRes[1]; ?></span>
                </li>
                <li class="list-group-item">
                    <img style="width: 1.2rem;height: 0.9rem;" src="/img/clay.gif">
                    <span id="currentClay"><?php echo (int)$newClay; ?></span>/<span id="maxClay"><?php echo (int)$maxRes[2]; ?></span>
                </li>
                <li class="list-group-item">
                    <img style="width: 1.2rem;height: 0.9rem;" src="/img/iron.gif">
                    <span id="currentIron"><?php echo (int)$newIron; ?></span>/<span id="maxIron"><?php echo (int)$maxRes[3]; ?></span>
                </li>
                <li class="list-group-item">
                    <img style="width: 1.2rem;height: 0.9rem;" src="/img/crop.gif">
                    <span id="currentCrop"><?php echo (int)$newCrop; ?></span>/<span id="maxCrop"><?php echo (int)$maxRes[4]; ?></span>
                </li>
            </ul>
        </div>
    </div>

    <div class="container" style="min-height:30px"></div>


    <!-- Building Info -->
    <div class="container">
        <div class="justify-content-center text-center">
            <h1> <?php //tuki more bit villageBuilding name in level glede na rfid ?>Barracks Level 1</h1><br />
            <h6>All foot soldier are trained in the barracks. The higher the level of the barracks, the faster the troops are trained.</h6> <br />
            <table class="table table-bordered w-75 m-auto">
                <thead >
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col" style="max-width:150px">Quantity</th>
                    <th scope="col">Max</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" class="align-middle">
                            <img style="width: 1.2rem;height: 1rem;" src="/img/maceman.gif">Maceman (Available: <?php echo (int)$currentTroops[1]; ?>)
                            <br />
                            <img style="width: 1.2rem;height: 1rem;" src="/img/wood.gif"> 95 |
                            <img style="width: 1.2rem;height: 1rem;" src="/img/clay.gif"> 75 |
                            <img style="width: 1.2rem;height: 1rem;" src="/img/iron.gif"> 40 |
                            <img style="width: 1.2rem;height: 1rem;" src="/img/crop.gif"> 40 |
                            <img style="width: 1.2rem;height: 1rem;" src="/img/consum.gif"> 1 |
                            <img style="width: 1.2rem;height: 1rem;" src="/img/clock.gif"> 0:00:10
                        </th>
                        <td class="align-middle">
                            <div class="input-group input-group-sm mb-3 align-middle">
                                <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="unit1">
                            </div>
                        </td>
                        <td class="align-middle">
                            <a onclick="insertTroops(1);" href="#" style="color:green"><strong>(<span id="maxTroops1"><?php echo $maxTroopsToTrain[1]; ?></span>)</strong></a>
                        </td>
                    </tr>
                    <tr>
                    <th scope="row" class="align-middle">
                            <img style="width: 1.2rem;height: 1rem;" src="/img/spearman.gif"> Spearman (Available: <?php echo (int)$currentTroops[2]; ?>)
                            <br />
                            <img style="width: 1.2rem;height: 1rem;" src="/img/wood.gif"> 145 |
                            <img style="width: 1.2rem;height: 1rem;" src="/img/clay.gif"> 75 |
                            <img style="width: 1.2rem;height: 1rem;" src="/img/iron.gif"> 40 |
                            <img style="width: 1.2rem;height: 1rem;" src="/img/crop.gif"> 40 |
                            <img style="width: 1.2rem;height: 1rem;" src="/img/consum.gif"> 1 |
                            <img style="width: 1.2rem;height: 1rem;" src="/img/clock.gif"> 0:00:03
                        </th>
                        <td class="align-middle">
                            <div class="input-group input-group-sm mb-3 align-middle">
                                <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="unit2">
                            </div>
                        </td>
                        <td class="align-middle">
                            <a onclick="insertTroops(2);" href="#" style="color:green"><strong>(<span id="maxTroops2"><?php echo $maxTroopsToTrain[2]; ?></span>)</strong></a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="btn-group mt-2 mb-5 w-75" role="group" aria-label="Train">
                <button type="button" class="btn btn-success w-75 m-auto mt-3" onclick="train();">Train</button>
            </div>
            <?php
            if($allTroopProduction){
                echo
                '<table class="table table-bordered w-75 m-auto">
                    <thead >
                        <tr>
                        <th scope="col">Training</th>
                        <th scope="col" style="max-width:150px">Duration</th>
                        <th scope="col">Finished</th>
                        </tr>
                    </thead>
                    <tbody>
                        ';
                            foreach ($troopProdHtml as $troopProdHtml) {
                                echo $troopProdHtml;
                            };
                        echo '
                    </tbody>
                </table>';
            };
            ?>
            <h5 class="mt-5"> <p><?php //current training time glede na level ?>Current training time:        100 percent</p></h5>
            <h5> <p><?php //training time glede na level+1 ?>Training time at level 2:        96 percent</p></h5>
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
    <script>
    function train(){
        unitsToTrain="";
        if(document.getElementById("unit1").value > 0){
            unitsToTrain+="&unit1="+document.getElementById("unit1").value;
        }
        if(document.getElementById("unit2").value > 0){
            unitsToTrain+="&unit2="+document.getElementById("unit2").value;
        }

        if(unitsToTrain){
            window.location.href = "/trainBarracks.php?"+unitsToTrain+"&vbid=1";
        }
    }
    </script>
    <script>
        var woodInterval = setInterval( ()=> {
            let curWood = document.getElementById("currentWood").innerHTML;
            let maxWood = document.getElementById("maxWood").innerHTML;
            if(parseInt(curWood) < parseInt(maxWood)){
                document.getElementById("currentWood").innerHTML=parseInt(curWood)+1;
            }
            else if(document.getElementById("currentWood").innerHTML && document.getElementById("maxWood").innerHTML){
                clearInterval(woodInterval);
            }
        }, <?php echo 1000*3600/$productionWood ?>);

        var clayInterval = setInterval( ()=> {
            let curClay = document.getElementById("currentClay").innerHTML;
            let maxClay = document.getElementById("maxClay").innerHTML;
            if(parseInt(curClay) < parseInt(maxClay)){
                document.getElementById("currentClay").innerHTML=parseInt(curClay)+1;
            }
            else if(document.getElementById("currentClay").innerHTML && document.getElementById("maxClay").innerHTML){
                clearInterval(clayInterval);
            }
        }, <?php echo 1000*3600/$productionClay ?>);

        var ironInterval = setInterval( ()=> {
            let curIron = document.getElementById("currentIron").innerHTML;
            let maxIron = document.getElementById("maxIron").innerHTML;
            if(parseInt(curIron) < parseInt(maxIron)){
                document.getElementById("currentIron").innerHTML=parseInt(curIron)+1;
            }
            else if(document.getElementById("currentIron").innerHTML && document.getElementById("maxIron").innerHTML){
                clearInterval(ironInterval);
            }
        }, <?php echo 1000*3600/$productionIron ?>);
        
        var cropInterval = setInterval( ()=> {
            let curCrop = document.getElementById("currentCrop").innerHTML;
            let maxCrop = document.getElementById("maxCrop").innerHTML;
            if(parseInt(curCrop) < parseInt(maxCrop)){
                document.getElementById("currentCrop").innerHTML=parseInt(curCrop)+1;
            }
            else if(document.getElementById("currentCrop").innerHTML && document.getElementById("maxCrop").innerHTML){
                clearInterval(cropInterval);
            }
        }, <?php echo 1000*3600/$productionCrop ?>);
        
    </script>
    <script>
        function insertTroops(id){           
            document.getElementById("unit"+id).value =  document.getElementById("maxTroops"+id).innerHTML;
        }
    </script>
    <script>
    var trainCDs = document.getElementsByClassName("trainCD");
    if(trainCDs){
        var trainCD1Interval = setInterval( ()=> {
            for(let i = 0; i < trainCDs.length; i++){
                let trainCD = trainCDs[i].innerHTML.split(":");

                let trainCDSeconds = 3600*parseInt(trainCD[0]) + 60*parseInt(trainCD[1]) + parseInt(trainCD[2]);
                trainCDSeconds--;

                if(trainCDSeconds==-1){
                    location.reload();
                }
                else{
                    var h = Math.floor(trainCDSeconds / 3600);
                    if(h<10){
                        h="0"+h;
                    }
                    var m = Math.floor(trainCDSeconds % 3600 / 60);
                    if(m<10){
                        m="0"+m;
                    }
                    var s = Math.floor(trainCDSeconds % 3600 % 60);
                    if(s<10){
                        s="0"+s;
                    }
                    trainCDs[i].innerHTML=h+":"+m+":"+s;
                }
            }
        }, 1000);
    }
        

    </script>
</body>