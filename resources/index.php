<?php  
    //Start the Session
    session_start();
    require('../connect.php');

    
    // GET USER RESOURCES 
    $query = $connection->prepare('SELECT * FROM playerresources WHERE idPlayer= ?');
    $query->bind_param('i', $_SESSION['idPlayer']);
    $query->execute();

    // Get result
    $result = $query->get_result();

    // Save array as assocc
    $arr = $result->fetch_all(MYSQLI_ASSOC);
    //var_export($arr);
    echo "<h3>USER RESOURCES</h3>";
    echo "<br>IRON:".(int)$arr[0]['count']."<br>".
            "CLAY:".(int)$arr[1]['count']."<br>".
            "GRAIN:".(int)$arr[2]['count']."<br>".
            "WOOD:".(int)$arr[3]['count']."<br>";

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Main</title>
</head>
<body>
    


    <title>Document</title>
</head>
<body>
    <h1>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</h1>

</body>
</html>