<?php
include('../database/config_DB.php');

$response=['error'=>true];

$query = $DBcon->query("SELECT * FROM servers_region");
$regions=[];
$region_count=0;
$data_count = $query->num_rows; 
if($data_count>0){
    while($region_data=$query->fetch_array()){
        $region=[];
        $region_id=$region_data['id'];
        $region_name=$region_data['name'];
        $server_query = $DBcon->query("SELECT * FROM servers where region_id='$region_id'");
        $server_count = $server_query->num_rows;
        $servers=[];
        $server_qount=0;
        if($server_count>0)
        {   
            while($server_data=$server_query->fetch_array()){

                $server=[];

                $server['id']=$server_data['id'];
                $server['serverName']=$server_data['serverName'];
                $server['flagURL']=$server_data['flagURL'];
                $server['ovpnConfiguration']=$server_data['ovpnConfiguration'];
                $server['vpnUserName']=$server_data['vpnUserName'];
                $server['vpnPassword']=$server_data['vpnPassword'];
                $server['isFree']=$server_data['isFree'];
                $server['region_id']=$server_data['region_id'];

                $servers[$server_qount]=$server;
                $server_qount++;
            }
        }

        $region['region_id']=$region_data['id'];
        $region['region_name']=$region_data['name'];
        $region['servers']=$servers;
        $regions[$region_count]=$region;
        $region_count++;
    }
    $response['error']=false;
    $response['regions']=$regions;
    header('content-Type:application/json');
    echo json_encode($response);
}else{
    $response['error']=true;
    $response['error_msg']="No Region Found";
    header('content-Type:application/json');
    echo json_encode($response);
}


?>