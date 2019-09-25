<?php

$servername = "localhost";
$username = "root";
$password = "password";
$db = "travian";

// Create connection
$connection = new mysqli($servername, $username, $password, $db);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 
?>