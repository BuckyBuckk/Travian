<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/connect.php');
if (!isset($_SESSION['username'])){
    header('location: /login');    
}

require_once($_SERVER['DOCUMENT_ROOT'].'/connect.php');

$unitsToTrain=[];
if(isset($_GET['unit1'])){
    array_push($unitsToTrain,(int)mysqli_real_escape_string($connection, $_GET['unit1']));
}
if(isset($_GET['unit2'])){
    array_push($unitsToTrain,(int)mysqli_real_escape_string($connection, $_GET['unit2']));
}
var_dump($unitsToTrain);


?>