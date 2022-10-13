<?php

$host = "localhost";
$port = "3306";
$socket = "";
$user = "root";
$password = ""; // if online leave blank//deleted//must input 
$dbName = "mapping";
$conn = mysqli_connect($host, $user, $password, $dbName, $port, $socket);
if(!$conn){
    die("Connection failed". mysqli_connect_error());
}
