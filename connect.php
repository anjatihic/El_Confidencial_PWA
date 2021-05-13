<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "el_confidencial";
$dbc = mysqli_connect($serverName, $userName, $password, $dbName) or
    die("Error connecting to MySQL server.".mysqli_connect_error());
mysqli_set_charset($dbc, "utf8");

?>