<?php 
include_once("database/config_DB.php");

$cookie_name = "_e_ll";
if(strcmp($_SERVER['REQUEST_URI'],"/login.php") && strcmp($_SERVER['REQUEST_URI'],"/login.php?status=error&message=The provided information is wrong!") && strcmp($_SERVER['REQUEST_URI'],"/login.php?status=error&message=Check your database!")){
  if(!isset($_COOKIE[$cookie_name])){
    header("Location:./login.php");
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="https://thesupervpn.raufcoders.com/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Admin Panel
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
   <!--CSS Files -->
<link rel="stylesheet" href="assets/css/material-dashboard.css">
 
   <!--CSS Just for demo purpose, don't include it in your project -->
  <!--<link href="https://thesupervpn.raufcoders.com/assets/demo/demo.css" rel="stylesheet" />-->
</head>
