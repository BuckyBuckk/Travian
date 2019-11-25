<?php 
session_start();
if (!isset($_SESSION['username'])){
    header('location: /login');
}

require_once($_SERVER['DOCUMENT_ROOT'].'/connect.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/troopInfoLookup.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/getCurrentTroops.php');



?>