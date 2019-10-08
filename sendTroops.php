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

    <title>Travian - Send Troops</title>
    <meta name="description" content="Travian Send Troops">

    <link rel="icon" href="/favicon.ico">
    <link href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
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
                    <img style="width: 1.2rem;height: 0.9rem;" src="/img/wood.gif"> <?php echo (int)$arr[3]['count'] ?>/100
                </li>
                <li class="list-group-item">
                    <img style="width: 1.2rem;height: 0.9rem;" src="/img/clay.gif"> <?php echo (int)$arr[1]['count'] ?>/100
                </li>
                <li class="list-group-item">
                    <img style="width: 1.2rem;height: 0.9rem;" src="/img/iron.gif"> <?php echo (int)$arr[0]['count'] ?>/100
                </li>
                <li class="list-group-item">
                    <img style="width: 1.2rem;height: 0.9rem;" src="/img/crop.gif"> <?php echo (int)$arr[2]['count'] ?>/100
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
                    <th scope="col"><img style="width: 1.2rem;height: 1rem;" src="/img/maceman.gif"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="align-middle">
                            <div class="input-group input-group-sm align-middle">
                                <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <a href="#" style="color:green"><strong>(6969)</strong></a>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="input-group input-group-sm align-middle">
                                <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <a href="#" style="color:green"><strong>(6969)</strong></a>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="input-group input-group-sm align-middle">
                                <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <a href="#" style="color:green"><strong>(6969)</strong></a>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="input-group input-group-sm align-middle">
                                <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <a href="#" style="color:green"><strong>(6969)</strong></a>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="input-group input-group-sm align-middle">
                                <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <a href="#" style="color:green"><strong>(6969)</strong></a>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="input-group input-group-sm align-middle">
                                <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <a href="#" style="color:green"><strong>(6969)</strong></a>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="input-group input-group-sm align-middle">
                                <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <a href="#" style="color:green"><strong>(6969)</strong></a>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="input-group input-group-sm align-middle">
                                <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <a href="#" style="color:green"><strong>(6969)</strong></a>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="input-group input-group-sm align-middle">
                                <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <a href="#" style="color:green"><strong>(6969)</strong></a>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="input-group input-group-sm align-middle">
                                <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <a href="#" style="color:green"><strong>(6969)</strong></a>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="input-group input-group-sm align-middle">
                                <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <a href="#" style="color:green"><strong>(6969)</strong></a>
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
                    <button type="button" class="btn btn-success w-75 m-auto" id="sendType">Reinforcement</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    $("#ddItem1").click(function(){
        $("#dropdownMenuButton").text("Reinforcement");
        $("#sendType").text("Reinforcement");
        $("#sendType").css({"background-color": "", "border-color": ""});
    });
    $("#ddItem2").click(function(){
        $("#dropdownMenuButton").text("Full Attack");
        $("#sendType").text("Full Attack");
        $("#sendType").css({"background-color": "darkred", "border-color": "darkred"});
    });
    $("#ddItem3").click(function(){
        $("#dropdownMenuButton").text("Raid Attack");
        $("#sendType").text("Raid Attack");
        $("#sendType").css({"background-color": "purple", "border-color": "purple"});
    });
    </script>
</body>
