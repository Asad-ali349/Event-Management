<?php
include('../database/config_DB.php');

$response=['error'=>true];

$query = $DBcon->query("SELECT * FROM faqs");
$faqs=[];
$faq_count=0;
$data_count = $query->num_rows; 
if($data_count>0){
    while($faq_data=$query->fetch_array()){
        $faq=[];
        $id=$faq_data['id'];
        $faq['id']=$id;
        $faq['question']=$faq_data['question'];
        $faq['answer']=$faq_data['answer'];
        $faqs[$faq_count]=$faq;
        $faq_count++;
    }
    $response['error']=false;
    $response['faqs']=$faqs;
    header('content-Type:application/json');
    echo json_encode($response);
}else{
    $response['error']=true;
    $response['error_msg']="No Event Found";
    header('content-Type:application/json');
    echo json_encode($response);
}


?>