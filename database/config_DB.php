<?php

// include ("includes/validator.php");
$DBhost = "localhost";
$DBuser = "root";
$DBpass = "";
$DBname = "rauf_api";

$DBcon = new MySQLi($DBhost,$DBuser,$DBpass,$DBname);

if ($DBcon->connect_errno) {
    die("ERROR : -> ".$DBcon->connect_error);
}
?>
