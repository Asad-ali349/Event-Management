<?php 
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['phone'])) 
{
 require_once "../database/config_DB.php";
 require_once "validate.php";

 $name = validate($_POST['name']);
 $email = validate($_POST['email']);
 $password = validate($_POST['password']);
 $phone = validate($_POST['phone']);

}
 $check = "Select * from users where email = '$email'";
 if ($DBcon->query($check)->num_rows>0) {
    echo "emailnotvalid";
 }
 else{
     $sql = "insert into users values ('', '$name', '$email', '".md5($password)."', '$phone')";
 if ($DBcon->query($sql)) {
  echo "success";
 } 

 else {
    echo "failure";
 }
 }

 ?>