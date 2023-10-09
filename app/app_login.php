<?php 
if (isset($_POST['email']) && isset($_POST['password'])) 
{
	require_once "../database/config_DB.php";
	require_once "validate.php";
	$email = validate($_POST['email']);
	$password = validate($_POST['password']);

	// check email is or not in database
	$checkemail = "Select * from users where email = '$email'";
	if ($DBcon->query($checkemail)->num_rows>0) {
		//check now password is or not
		$checkpass = "Select * from users where password = '".md5($password)."'";
		if ($DBcon->query($checkpass)->num_rows>0) {
		    $row = mysqli_fetch_assoc(mysqli_query($DBcon,$checkpass));
			echo json_encode($row);
// 			echo "success";
		}
		else {
			echo "passwordnotfound";
		}


	}
	else {
		echo "emailnotfound";
	}


}


 ?>