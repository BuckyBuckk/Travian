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
                            <img style="width: 1.2rem;height: 1rem;" src="/img/maceman.gif">Maceman (Available:13)
                            <br />
                            <img style="width: 1.2rem;height: 1rem;" src="/img/wood.gif"> 95 |
                            <img style="width: 1.2rem;height: 1rem;" src="/img/clay.gif"> 75 |
                            <img style="width: 1.2rem;height: 1rem;" src="/img/iron.gif"> 40 |
                            <img style="width: 1.2rem;height: 1rem;" src="/img/crop.gif"> 40 |
                            <img style="width: 1.2rem;height: 1rem;" src="/img/consum.gif"> 1 |
                            <img style="width: 1.2rem;height: 1rem;" src="/img/clock.gif"> 0:00:03
                        </th>
                        <td class="align-middle">
                            <div class="input-group input-group-sm mb-3 align-middle">
                                <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </td>
                        <td class="align-middle">
                            <a href="#" style="color:green"><strong>(6969)</strong></a>
                        </td>
                    </tr>
                    <tr>
                    <th scope="row" class="align-middle">
                            <img style="width: 1.2rem;height: 1rem;" src="/img/maceman.gif">Spearman (Available:0)
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
                                <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </td>
                        <td class="align-middle">
                            <a href="#" style="color:green"><strong>(4200)</strong></a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="btn-group mt-2 mb-5 w-75" role="group" aria-label="Train">
                <button type="button" class="btn btn-success w-75 m-auto mt-3">Train</button>
            </div>
            <table class="table table-bordered w-75 m-auto">
                <thead >
                    <tr>
                    <th scope="col">Training</th>
                    <th scope="col" style="max-width:150px">Duration</th>
                    <th scope="col">Finished</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" class="align-middle">
                            <img style="width: 1.2rem;height: 1rem;" src="/img/maceman.gif">500 Macemen
                            <br />
                        </th>
                        <td class="align-middle">
                            0:34:12
                        </td>
                        <td class="align-middle">
                            13:22:01
                        </td>
                    </tr>
                </tbody>
            </table>
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