<?php

$servername = "shared44.accountservergroup.com";
$username = "wardpete_tstusr";
$password = "_skz6lp=RwBj";
$dbname = "wardpete_testUserDB";

$con = mysqli_connect($servername, $username, $password,$dbname);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}