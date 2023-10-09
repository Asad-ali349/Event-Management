<?php
include_once("../database/config_DB.php");

//Handle Routes
$URL_LOCATION = "salepe.in";

//Login Route
if(isset($_POST['login'])){
    if(isset($_POST['userName'])&&isset($_POST['password'])){
        $userName = $_POST['userName'];
        $password = $_POST['password'];
        $query = $DBcon->query("SELECT * FROM admin WHERE userName='".$userName."' AND password = '".$password."'");
        $row=$query->fetch_array();
        $count = $query->num_rows; // if userName/password are correct returns must be 1 row
            if ($count==1) {
                echo "Here";
                setcookie("_e_ll", $row['userName'], time() + 7200, '/');
                header("Location:../index.php");
            } else{
                // echo "The provided information is wrong";
                header("Location:../login.php?status=error&message=The provided information is wrong!");
            }
    }else{
        header("Location:../login.php?status=error&message=Check your database!");
    }
}

//Logout route
if(isset($_GET['logout'])){
setcookie("_e_ll", "test", time() - 7200, '/');
header("Location:../login.php");
}

//Get Ovpn servers api
if(isset($_GET['Servers'])){
    $query = $DBcon->query("SELECT * FROM servers");
    $servers_list = array();
    while($row=$query->fetch_array()){
        array_push($servers_list,$row); 
    }
    echo json_encode($servers_list);
}



//Get admob ads api
if(isset($_GET['admob'])){
    $query = $DBcon->query("SELECT * FROM admobconfig WHERE activeAd = 1");
    $servers_list = array();
    while($row = mysqli_fetch_assoc($query)){
			$servers_list = $row;
		}
    
    echo json_encode($servers_list);
}

?>