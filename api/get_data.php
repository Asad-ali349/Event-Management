<?php
include('../database/config_DB.php');

$response=['error'=>true];

$query = $DBcon->query("SELECT * FROM event");
$events=[];
$event_count=0;
$data_count = $query->num_rows; 

while($event_data=$query->fetch_array()){
    $event=[];
    $id=$event_data['id'];
    $event['id']=$id;
    $event['name']=$event_data['name'];
    $event['event_icon']=$event_data['event_icon'];
    $event['tagline']=$event_data['tagline'];
    $event['description']=$event_data['description'];

    $date=date_create($event_data['event_date']);
    $event['event_date']= date_format($date,"Y/m/d H:i:s");


    // $event['event_date']=$event_data['event_date'];
    $event['price_per_cnx']=$event_data['price_per_cnx'];
    $event['listing_price']=$event_data['listing_price'];
    $event['vesting_period']=$event_data['vesting_period'];
    $event['total_supply']=$event_data['total_supply'];
    $event['current_round']=$event_data['current_round'];
    $event['total_rounds']=$event_data['total_rounds'];
    $event['status']=$event_data['status'];
    $event['purchase_link']=$event_data['purchase_link'];
    $group_id=$event_data['team_group_id'];
    
    $event_members_query = $DBcon->query("SELECT * FROM team_members where team_group_id='$group_id'");
    $group_count=0;
    $event_group_members=[];
    while($event_members_data=$event_members_query->fetch_array()){
        $member['member_id']=$event_members_data['id'];
        $member['member_name']=$event_members_data['name'];
        $member['member_email']=$event_members_data['email'];
        $member['member_phone']=$event_members_data['phone'];
        $member['member_designation']=$event_members_data['designation'];
        $member['member_user_profile_pic']=$event_members_data['user_profile_pic'];
        $event_group_members[$group_count]=$member;
        $group_count++;
    }
    $event['event_group_members']=$event_group_members;


    $event_rating_query = $DBcon->query("SELECT * FROM event_rating where event_id='$id'");
    $event_rating_data=$event_rating_query->fetch_array();
    $event_rating['activity_rating']=$event_rating_data['activity'];
    $event_rating['plan_rating']=$event_rating_data['plan'];
    $event_rating['team_rating']=$event_rating_data['team'];
    $event_rating['vision_rating']=$event_rating_data['vision'];
    $event_rating['product_rating']=$event_rating_data['product'];
    $event_rating['potential_rating']=$event_rating_data['potential'];
    $event['event_rating']=$event_rating;

    $event_url_query = $DBcon->query("SELECT * FROM event_urls where event_id='$id'");
    $url_count=0;
    $event_url=[];
    while($event_url_data=$event_url_query->fetch_array()){
        $url['url_id']=$event_url_data['id'];
        $url['url_name']=$event_url_data['url_name'];
        $url['url_link']=$event_url_data['url_link'];
        $event_url[$url_count]=$url;
        $url_count++;
    }
    $event['event_urls']=$event_url;

    $event_lite_paper_query = $DBcon->query("SELECT * FROM event_lite_paper where event_id='$id'");
    $lite_count=0;
    $event_lite_paper=[];
    while($event_lite_paper_data=$event_lite_paper_query->fetch_array()){
        $lite_paper['id']=$event_lite_paper_data['id'];
        $lite_paper['document']=$event_lite_paper_data['document'];
        $event_lite_paper[$lite_count]=$lite_paper;
        $lite_count++;
    }
    $event['event_light_papers']=$event_lite_paper;
    $events[$event_count]=$event;
    $event_count++;

}  


// -------------------------FAQs----------------------------

$faq_query = $DBcon->query("SELECT * FROM faqs");
$faqs=[];
$faq_count=0;
$data_count_faq = $faq_query->num_rows; 

while($faq_data=$faq_query->fetch_array()){
    $faq=[];
    $id=$faq_data['id'];
    $faq['id']=$id;
    $faq['question']=$faq_data['question'];
    $faq['answer']=$faq_data['answer'];
    $faqs[$faq_count]=$faq;
    $faq_count++;
}



$response['error']=false;
$response['events']=$events;
$response['faqs']=$faqs;

header('content-Type:application/json');
echo json_encode($response);




?>