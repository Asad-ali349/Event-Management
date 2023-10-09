<?php
if (isset($_POST['email'])) {
	require_once "../database/config_DB.php";
	require_once "validate.php";

	$email = validate($_POST['email']);


	$checkemail = "Select * from users where email = '$email'";
	$result = mysqli_query($DBcon,$checkemail);
	if ($result->num_rows >0) {
		echo "emailfound";
	}
	else{
		echo "emailnotfound";
	}

}
?>
<?php
if (isset($_POST['email']) && isset($_POST['password'])) {
	require_once "../database/config_DB.php";
	require_once "validate.php";
	
	$email = validate($_POST['email']);
	$password = validate($_POST['password']);



$resetpass = "UPDATE users SET password = '".md5($password)."' where email = '$email'";
	if ($DBcon->query($resetpass)) {
		echo "Updated";
	}
	else {
		echo "NotUpdated";
	}
}
?>
