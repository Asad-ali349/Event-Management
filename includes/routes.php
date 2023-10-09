<?php
include_once("../database/config_DB.php");

$cookie_name = "_e_ll";
if(!isset($_COOKIE[$cookie_name])){
header("Location:../login.php");
} else {
    $query = $DBcon->query("SELECT * FROM admin WHERE userName='".$_COOKIE[$cookie_name]."'");
    $count = $query->num_rows;
    if($count < 1){
    header("Location:../login.php");
    }
}

//Add Servers
if(isset($_POST['addServer'])){
    $serverName =  $_POST['serverName'];
    $flagURL =  $_POST['flagURL'];
    $latitude   =   $_POST['latitude'];
    $longitude =  $_POST['longitude'];
    $region    =     $_POST['region'];
    $city      =       $_POST['city'];
    $hostname  =   $_POST['hostname'];
    $postal    =     $_POST['postal'];
    $timezone  =   $_POST['timezone'];
    $exploded =  explode("\n",$_POST['ovpn']);
    $ovpn = '';
    for($i = 0;$i < sizeof($exploded);$i++){
        if(strcmp($exploded[$i][0],"#")!= 0){
               $ovpn =$ovpn.$exploded[$i].'\n';
        }
    }
    //echo $ovpn;
    $vpnUsername =  $_POST['vpnUsername'];
    $vpnPassword =  $_POST['vpnPassword'];
    if(strcmp($_POST['vpnType'],"free") == 0){
        $vpnType = 1;
    }else{
        $vpnType = 0;
    }
    if($query = $DBcon->query("INSERT INTO servers(serverName,flagURL
    ,latitude,longitude,region,city,hostname,postal,timezone
    ,ovpnConfiguration,vpnUserName,vpnPassword,vpnType) VALUES('".$serverName."','".$flagURL."','".$latitude."','".$longitude."','".$region."','".$city."','".$hostname."','".$postal."','".$timezone."','".$ovpn."','".$vpnUsername."','".$vpnPassword."',".$vpnType.")")){
        header('Location:../index.php?status=success&message=Server added succesfully');
    }else{
        // //echo "And here";
        //echo $DBcon->error;
        header('Location:../add_servers.php.php?status=error&message=Error can\'t add server');
    }
}
//Add User
if(isset($_POST['addUser'])){
    $name =  $_POST['name'];
    $email =  $_POST['email'];
    $phone   =   $_POST['phone'];
    $password =  $_POST['password'];
    
    $check = "Select * from users where email = '$email'";
 if ($DBcon->query($check)->num_rows>0) {
     echo 'This email is already registered';
 } else{
    if($query = $DBcon->query("INSERT INTO users(name,email
    ,phone,password) VALUES('".$name."','".$email."','".$phone."','".md5($password)."')")){
        header('Location:../index.php?status=success&message=User added succesfully');
    }else{
        // //echo "And here";
        echo $DBcon->error;
        // header('Location:../add_user.php.php?status=error&message=Error can\'t add user');
    }
 }
}
//Change edit servers
if(isset($_POST['editServer'])){
    $id =  $_POST['id'];
    $serverName =  $_POST['serverName'];
    $flagURL =  $_POST['flagURL'];
    $latitude   =   $_POST['latitude'];
    $longitude =  $_POST['longitude'];
    $region    =     $_POST['region'];
    $city      =       $_POST['city'];
    $hostname  =   $_POST['hostname'];
    $postal    =     $_POST['postal'];
    $timezone  =   $_POST['timezone'];
    $exploded =  explode("\n",$_POST['ovpn']);
    $ovpn = '';
    for($i = 0;$i < sizeof($exploded);$i++){
        if(strcmp($exploded[$i][0],"#")!= 0){
               $ovpn =$ovpn.$exploded[$i].'\n';
        }
    }
    //echo $ovpn;
    $vpnUsername =  $_POST['vpnUsername'];
    $vpnPassword =  $_POST['vpnPassword'];
    if(strcmp($_POST['vpnType'],"free") == 0){
        $vpnType = 1;
    }else{
        $vpnType = 0;
    }
    if($query = $DBcon->query("UPDATE servers SET serverName = '".$serverName."',flagURL = '".$flagURL."',latitude = '".$latitude."',longitude = '".$longitude."',region = '".$region."',city = '".$city."',hostname = '".$hostname."',postal = '".$postal."',timezone = '".$timezone."',ovpnConfiguration = '".$ovpn."',vpnUserName =  '".$vpnUsername."', vpnPassword = '".$vpnPassword."',vpnType = ".$vpnType." WHERE id = ".$id)){
        header('Location:../index.php?status=success&message=Server edited succesfully');
    }else{
        // echo "And here";
        echo $DBcon->error;
        // header('Location:../add_servers.php?status=error&message=Error can\'t edit server');
    }
}



//Change admob
if(isset($_POST['editAdmob'])){
    $admobID =  $_POST['admobID'];
    $interstitialID =  $_POST['interstitialID'];
    $bannerID =  $_POST['bannerID'];
    $nativeID =  $_POST['nativeID'];
    if($query = $DBcon->query("UPDATE admobconfig SET admobID = '".$admobID."', interstitialID = '".$interstitialID."' , bannerID = '".$bannerID."' , nativeID = '".$nativeID."' WHERE admobconfig.id = 1")){
        header('Location:../index.php?status=success&message=Information changed succesfully');
    }else{
        //echo $DBcon->error;

        header('Location:../manage_admob?status=error&message=Error can\'t change information');
    }
}


//Change password
if(isset($_POST['changePassword'])){
    $previousPassword =  $_POST['previousPassword'];
    $newPassword =  $_POST['newPassword'];
    $confirmPassword =  $_POST['confirmPassword'];
    $previousUsername =  $_POST['previousUsername'];
    $newUsername =  $_POST['newUsername'];


    if(strcmp($newPassword,$confirmPassword)==0){
        $query = $DBcon->query("SELECT * FROM admin WHERE password = '".$previousPassword."' && userName = '".$previousUsername."'");
        $row=$query->fetch_array();
        $count = $query->num_rows; // if userName/password are correct returns must be 1 row
            if ($count==1) {
            if($query = $DBcon->query("UPDATE admin SET password = '".$newPassword."', userName = '".$newUsername."' WHERE admin.id = 1")){
                header('Location:../index.php?status=success&message=Password changed succesfully');
            }else{
        // echo $DBcon->error;

                header('Location:../change_password.php?status=error&message=Error can\'t change information');
            }
            }else{
        //echo $DBcon->error;

                header('Location:../change_password.php?status=error&message=Incorrect previous password or username.');
            }
    }else{
        //echo $DBcon->error;

        header('Location:../change_password.php?status=error&message=New password don\'t match.');
    }
}

//Add Adss
if(isset($_POST['addAds']))
{
    $admobID =  $_POST['admobID'];
    $bannerID =  $_POST['bannerID'];
	$interstitialID =  $_POST['interstitialID'];
	$nativeID =  $_POST['nativeID'];
	$adType =  $_POST['adType'];
    if(strcmp($_POST['activeAd'],"1") == 0)
	{
        $activeAd = 1;
    }
	else
	{
        $activeAd = 0;
    }
	
    if($query = $DBcon->query("INSERT INTO admobconfig(admobID, bannerID, interstitialID, nativeID, adType, activeAd) VALUES('".$admobID."','".$bannerID."','".$interstitialID."','".$nativeID."','".$adType."',".$activeAd.")"))
	{
        header('Location:../index.php?status=success&message=Ads config added succesfully');
    }
	else
	{
        header('Location:../add_ads.php.php?status=error&message=Error can\'t add ads config');
    }
}

//Change edit ads
if(isset($_POST['editAds']))
{
    $id =  $_POST['id'];
    $admobID =  $_POST['admobID'];
    $bannerID =  $_POST['bannerID'];
    $interstitialID =  $_POST['interstitialID'];
    $nativeID =  $_POST['nativeID'];
	$adType =  $_POST['adType'];
    if(strcmp($_POST['activeAd'],"1") == 0)
	{
        $activeAd = 1;
    }
	else
	{
        $activeAd = 0;
    }
	
    if($query = $DBcon->query("UPDATE admobconfig SET admobID = '".$admobID."',bannerID = '".$bannerID."',interstitialID = '".$interstitialID."',nativeID =  '".$nativeID."', adType = '".$adType."',activeAd = ".$activeAd." WHERE id = ".$id))
	{
		if ($activeAd == 1)
		{
			if ($query = $DBcon->query("UPDATE admobconfig SET activeAd = 0 WHERE id != ".$id));
			{
				header('Location:../index.php?status=success&message=Ads config edited succesfully');
			}
		}
		{
			header('Location:../index.php?status=success&message=Ads config edited succesfully');
		}
    }
	else
	{
        header('Location:../add_ads.php?status=error&message=Error can\'t edit ads config');
    }
}


if(isset($_POST['addMember'])){
    $name =  $_POST['name'];
    $email =  $_POST['email'];
    $phone   =   $_POST['phone'];
    $designation =  $_POST['designation'];
    $link =  $_POST['link'];
    $group_id =  $_POST['group_id'];
    // $profile_image =  $_POST['profile_image'];
    $check = "Select * from team_members where email = '$email'";
 if ($DBcon->query($check)->num_rows>0) {
     echo 'This email is already registered';
 } else{
    
    $filename = date("Y-m-d-H-i-s").$_FILES["profile_image"]["name"]; 
    $tempname = $_FILES["profile_image"]["tmp_name"];     
    $folder = "../team_members/".$filename;
    $allowed = array('gif', 'png', 'jpg','jpeg');
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (in_array($ext, $allowed)) {
        if (move_uploaded_file($tempname, $folder)) {
            if($query = $DBcon->query("INSERT INTO team_members(name,email
            ,phone,designation,linked_in_link,user_profile_pic,team_group_id) VALUES('".$name."','".$email."','".$phone."','".$designation."','".$link."','".$filename."','".$group_id."')")){
                header('Location:../index.php?status=success&message=Team Member added succesfully');
        }
    }else{
        echo "Only .jpg .jpeg .png file allowed";
    }
    }else{
        // //echo "And here";
        echo $DBcon->error;
        // header('Location:../add_user.php.php?status=error&message=Error can\'t add user');
    }
 }
}
if(isset($_POST['editMember'])){
    echo "in router";
    $id =  $_POST['id'];
    $name =  $_POST['name'];
    $email =  $_POST['email'];
    $phone   =   $_POST['phone'];
    $designation =  $_POST['designation'];
    $link =  $_POST['link'];
    $filename = date("Y-m-d-H-i-s").$_FILES["profile_image"]["name"]; 
    $tempname = $_FILES["profile_image"]["tmp_name"];     
    $folder = "../team_members/".$filename;
    $allowed = array('gif', 'png', 'jpg','jpeg');
    $group_id =  $_POST['group_id'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    
    if (in_array($ext, $allowed)) {
        
        if (move_uploaded_file($tempname, $folder)) {
            if($query = $DBcon->query("Update team_members Set name='$name',email='$email'
            ,phone='$phone',designation='$designation',linked_in_link='$link',user_profile_pic='$filename', team_group_id='$group_id' where id='$id'")){
                header('Location:../index.php?status=success&message=Team Member updated succesfully');
            }else{
                echo $DBcon->error;
            
            }
        }
    }else{
        
        if($query = $DBcon->query("Update team_members Set name='$name',email='$email'
                ,phone='$phone',designation='$designation',linked_in_link='$link', team_group_id='$group_id' where id='$id'")){
                    header('Location:../index.php?status=success&message=Team Member updated succesfully');
        }else{
            echo $DBcon->error;

        }
        // //echo "And here";
        // header('Location:../add_user.php.php?status=error&message=Error can\'t add user');
    }

}



if(isset($_POST['addEvent'])){

    $name=$_POST['name'];
    $tagline=$_POST['tagline'];
    $description=$_POST['description'];
    $description=htmlspecialchars($description);
    $description =str_replace("'", "&apos;", $description);
    $description=str_replace('"', "&quot;", $description);
    $date=$_POST['date'];
    $event_status=$_POST['event_status'];
    $group_id=$_POST['group_id'];
    $activity_rating=$_POST['activity_rating'];
    $planning_rating=$_POST['planning_rating'];
    $team_rating=$_POST['team_rating'];
    $vision_rating=$_POST['vision_rating'];
    $product_rating=$_POST['product_rating'];
    $potential_rating=$_POST['potential_rating'];
    $price_per_cnx=$_POST['price_per_cnx'];
    $listing_price=$_POST['listing_price'];
    $vesting_period=$_POST['vesting_period'];
    $purchase_link=$_POST['purchase_link'];
    $total_supply=$_POST['total_supply'];
    $current_round=$_POST['current_round'];
    $total_round=$_POST['total_round'];
    $event_video_url=$_POST['event_video_url'];

    $filename_icon = date("Y-m-d-H-i-s").$_FILES["event_icon"]["name"]; 
    $tempname_icon = $_FILES["event_icon"]["tmp_name"];
    $folder_icon = "../Event_Icons/".$filename_icon;
    $allowed = array('gif', 'png', 'jpg','jpeg');
    $ext_icon = pathinfo($filename_icon, PATHINFO_EXTENSION);

    if (in_array($ext_icon, $allowed)) {
        if (move_uploaded_file($tempname_icon, $folder_icon)) {

            if($query = $DBcon->query("INSERT INTO event(name, tagline, description, event_date, team_group_id, price_per_cnx, listing_price, vesting_period, total_supply, current_round, total_rounds, status,purchase_link,event_icon,event_video_url) VALUES('$name','$tagline','$description','$date','$group_id','$price_per_cnx','$listing_price','$vesting_period','$total_supply','$current_round','$total_round','$event_status','$purchase_link','$filename_icon','$event_video_url')")){
        
                $get_id_query=$DBcon->query("Select id from event where name='$name' AND tagline='$tagline' AND description='$description' AND event_date='$date' AND team_group_id='$group_id' AND price_per_cnx='$price_per_cnx' AND listing_price='$listing_price' AND vesting_period='$vesting_period' AND total_supply='$total_supply' AND current_round='$current_round' AND total_rounds='$total_round' AND status='$event_status'");
        
                $result_get_id_query=$get_id_query->fetch_array();
                $event_id=$result_get_id_query['id'];
                
                $rating_query=$DBcon->query("INSERT INTO event_rating(event_id, activity, plan, team, vision, product, potential) VALUES('$event_id','$activity_rating','$planning_rating','$team_rating','$vision_rating','$product_rating','$potential_rating')");
        
                foreach($_FILES["lite_paper"]["name"] as $key=>$name) {
                 
                    $image_Name = uniqid().date("Y-m-d-H-i-s").$_FILES['lite_paper']['name'][$key];
                    // File path configuration
                    $uploadDir = "../Lite_Paper_docs/";
                    $fileName = basename($_FILES['lite_paper']['name'][$key]);
                    $uploadFilePath = $uploadDir.$image_Name;
           
           
                    if (move_uploaded_file($_FILES['lite_paper']['tmp_name'][$key], $uploadFilePath)) {
                       $add_doc=mysqli_query($DBcon,"INSERT INTO event_lite_paper(event_id, document) VALUES('$event_id','$image_Name')");
                       
                    }
                 }
                foreach($_POST["url"] as $key=>$name) {
        
                    $url_name=$_POST['url_name'][$key];
                    $url=$_POST['url'][$key];
                    $add_doc=mysqli_query($DBcon,"INSERT INTO event_urls(event_id, url_name,url_link) VALUES('$event_id','$url_name','$url')");
        
                 }
        
        
        
                header('Location:../index.php?status=success&message=Event added succesfully');
            }else{
                echo $DBcon->error;
            }
        }else{
            
            header("Location:../add_event.php?status=error&message=Folder Event Icon doesn't exist");
            
        }
    }else{
        // error: icon type must be png,jpg or jpeg
        header('Location:../add_event.php?status=error&message=Error: Icon must be image');
    }


}


if(isset($_POST['editEvent'])){

    $id=$_POST['id'];
    $name=$_POST['name'];
    $tagline=$_POST['tagline'];
    $description=$_POST['description'];
    $description=htmlspecialchars($description);
    $description =str_replace("'", "&apos;", $description);
    $description=str_replace('"', "&quot;", $description);
    $date=$_POST['date'];
    $event_status=$_POST['event_status'];
    $group_id=$_POST['group_id'];
    $activity_rating=$_POST['activity_rating'];
    $planning_rating=$_POST['planning_rating'];
    $team_rating=$_POST['team_rating'];
    $vision_rating=$_POST['vision_rating'];
    $product_rating=$_POST['product_rating'];
    $potential_rating=$_POST['potential_rating'];
    $price_per_cnx=$_POST['price_per_cnx'];
    $listing_price=$_POST['listing_price'];
    $vesting_period=$_POST['vesting_period'];
    $purchase_link=$_POST['purchase_link'];
    $total_supply=$_POST['total_supply'];
    $current_round=$_POST['current_round'];
    $total_round=$_POST['total_round'];
    $event_video_url=$_POST['event_video_url'];

    $filename_icon = date("Y-m-d-H-i-s").$_FILES["event_icon"]["name"]; 
    $tempname_icon = $_FILES["event_icon"]["tmp_name"];     
    $folder_icon = "../Event_Icons/".$filename_icon;
    $allowed = array('gif', 'png', 'jpg','jpeg');
    $ext_icon = pathinfo($filename_icon, PATHINFO_EXTENSION);

    if (in_array($ext_icon, $allowed)) {
        if (move_uploaded_file($tempname_icon, $folder_icon)) {

            if($query = $DBcon->query("Update event SET name='$name', tagline='$tagline', description='$description', event_date='$date', team_group_id='$group_id', price_per_cnx='$price_per_cnx', listing_price='$listing_price', vesting_period='$vesting_period', total_supply='$total_supply', current_round='$current_round', total_rounds='$total_round', status='$event_status',purchase_link='$purchase_link',event_icon='$filename_icon',event_video_url='$event_video_url' where id='$id' ")){

        
        
                $rating_query=$DBcon->query("Update event_rating Set activity='$activity_rating', plan='$planning_rating', team='$team_rating', vision='$vision_rating', product='$product_rating', potential='$potential_rating' where event_id='$id'");
        
                if(isset($_FILES['lite_paper'])){
                    foreach($_FILES["lite_paper"]["name"] as $key=>$name) {
                    
                        $image_Name = uniqid().date("Y-m-d-H-i-s").$_FILES['lite_paper']['name'][$key];
                        // File path configuration
                        $uploadDir = "../Lite_Paper_docs/";
                        $fileName = basename($_FILES['lite_paper']['name'][$key]);
                        $uploadFilePath = $uploadDir.$image_Name;
            
            
                        if (move_uploaded_file($_FILES['lite_paper']['tmp_name'][$key], $uploadFilePath)) {
                        $add_doc=mysqli_query($DBcon,"INSERT INTO event_lite_paper(event_id, document) VALUES('$id','$image_Name')");
                        
                        }
                    }
                }
        
        
                if(isset($_POST['url'])){
                    foreach($_POST["url"] as $key=>$name) {
        
                        $url_name=$_POST['url_name'][$key];
                        $url=$_POST['url'][$key];
                        $add_doc=mysqli_query($DBcon,"INSERT INTO event_urls(event_id, url_name,url_link) VALUES('$id','$url_name','$url')");
        
                        }
                }
        
                header('Location:../index.php?status=success&message=Event Updated succesfully');
            }else{
                // //echo "And here";
                echo $DBcon->error;
                // header('Location:../add_user.php.php?status=error&message=Error can\'t add user');
            }
        }else{
            header("Location:../add_event.php?status=error&message=Folder Event Icon doesn't exist");
            
        }
    }else{
        // error: icon type must be png,jpg or jpeg
        if($query = $DBcon->query("Update event SET name='$name', tagline='$tagline', description='$description', event_date='$date', team_group_id='$group_id', price_per_cnx='$price_per_cnx', listing_price='$listing_price', vesting_period='$vesting_period', total_supply='$total_supply', current_round='$current_round', total_rounds='$total_round', status='$event_status',purchase_link='$purchase_link',event_video_url='$event_video_url' where id='$id' ")){



            $rating_query=$DBcon->query("Update event_rating Set activity='$activity_rating', plan='$planning_rating', team='$team_rating', vision='$vision_rating', product='$product_rating', potential='$potential_rating' where event_id='$id'");
    
            if(isset($_FILES['lite_paper'])){
                foreach($_FILES["lite_paper"]["name"] as $key=>$name) {
                
                    $image_Name = uniqid().date("Y-m-d-H-i-s").$_FILES['lite_paper']['name'][$key];
                    // File path configuration
                    $uploadDir = "../Lite_Paper_docs/";
                    $fileName = basename($_FILES['lite_paper']['name'][$key]);
                    $uploadFilePath = $uploadDir.$image_Name;
        
        
                    if (move_uploaded_file($_FILES['lite_paper']['tmp_name'][$key], $uploadFilePath)) {
                    $add_doc=mysqli_query($DBcon,"INSERT INTO event_lite_paper(event_id, document) VALUES('$id','$image_Name')");
                    
                    }
                }
            }
    
    
            if(isset($_POST['url'])){
                foreach($_POST["url"] as $key=>$name) {
    
                    $url_name=$_POST['url_name'][$key];
                    $url=$_POST['url'][$key];
                    $add_doc=mysqli_query($DBcon,"INSERT INTO event_urls(event_id, url_name,url_link) VALUES('$id','$url_name','$url')");
    
                    }
            }
    
            header('Location:../index.php?status=success&message=Event Updated succesfully ');
        }else{
            // //echo "And here";
            echo $DBcon->error;
            // header('Location:../add_user.php.php?status=error&message=Error can\'t add user');
        }
        // header('Location:../add_event.php?status=error&message=Error: Icon must be image');
    }
    

        
    

}



if(isset($_POST['addGroup'])){
    $name =  $_POST['name'];    
    if($query = $DBcon->query("INSERT INTO team_groups(name) VALUES('".$name."')")){

        header('Location:../index.php?status=success&message=Team Group added succesfully');
    }else{
        // //echo "And here";
        echo $DBcon->error;
        // header('Location:../add_user.php.php?status=error&message=Error can\'t add user');
    }

}


if(isset($_POST['editGroup'])){
    $id =  $_POST['id'];    
    $name =  $_POST['name'];    
    if($query = $DBcon->query("Update team_groups set name='$name' where id='$id'")){

        header('Location:../index.php?status=success&message=Team Group updated succesfully');
    }else{
        // //echo "And here";
        echo $DBcon->error;
        // header('Location:../add_user.php.php?status=error&message=Error can\'t add user');
    }

}


if(isset($_POST['id'])&& isset($_POST['table_name'])){
    $id=$_POST['id'];
    $table_name=$_POST['table_name'];
    // $query = $DBcon->query("Delete from $table_name where id='$id'");
    $query=mysqli_query($DBcon,"Delete from $table_name where id='$id'");
    if($query){
        $response=['error'=>false];
        header('content-Type:application/json');
	    echo json_encode($response);
    }else{
      
        // header('Location:../index.php.php?status=error&message=You cannot delete because this data is used somewhere');
        $response=['error'=>true];
        $response['error_msg']='You cannot delete because this data is used somewhere';
        header('content-Type:application/json');
	    echo json_encode($response);
    }

}



if(isset($_POST['addFaq'])){


    $question =  $_POST['question'];    
    $question=htmlspecialchars($question);
    $question =str_replace("'", "&apos;", $question);
    $question=str_replace('"', "&quot;", $question);
    
    $answer =  $_POST['answer'];    
    $answer=htmlspecialchars($answer);
    $answer =str_replace("'", "&apos;", $answer);
    $answer=str_replace('"', "&quot;", $answer);
    
    if($query = $DBcon->query("INSERT INTO faqs(question,answer) VALUES('$question','$answer')")){

        header('Location:../index.php?status=success&message=FAQ added succesfully');
    }else{
        
        echo $DBcon->error;
    }

}


if(isset($_POST['editFaq'])){
    $id =  $_POST['id'];    
    $question =  $_POST['question'];    
    $question=htmlspecialchars($question);
    $question =str_replace("'", "&apos;", $question);
    $question=str_replace('"', "&quot;", $question);
    
    $answer =  $_POST['answer'];    
    $answer=htmlspecialchars($answer);
    $answer =str_replace("'", "&apos;", $answer);
    $answer=str_replace('"', "&quot;", $answer);   
    if($query = $DBcon->query("Update faqs set question='$question',answer='$answer' where id='$id'")){
        header('Location:../index.php?status=success&message=FAQ updated succesfully');
    }else{
        echo $DBcon->error;
    }

}
if(isset($_POST['id']) && isset($_POST['status'])){
    $id =  $_POST['id'];    
    $status =  $_POST['status'];   
    if($query = $DBcon->query("Update event set status='$status' where id='$id'")){
        header('Location:../index.php?status=success&message=Event Status updated succesfully');
    }else{
        echo $DBcon->error;
    }

}



?>