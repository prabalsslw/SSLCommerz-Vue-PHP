<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$database = "sslcvue"; 

$conn_integration = mysqli_connect($servername, $username, $password, $database);

if (!$conn_integration) {
    die("Connection failed: " . mysqli_connect_error());
}

