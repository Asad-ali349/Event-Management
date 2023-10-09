<?php 
include('includes/header.php');
$is_edit = false;
$name='';
$tagline='';
$description='';
$event_date='';
$team_group_id='';
$price_per_cnx='';
$listing_price='';
$vesting_period='';
$total_supply='';
$current_round ='';
$total_rounds ='';
$status='';
$purchase_link='';
$activity='';
$plan='';
$team='';
$vision='';
$product='';
$potential='';
$event_icon='';
$event_video_url='';

$id = 0;
// $team_members = $DBcon->query("SELECT * FROM team_members");

if(isset($_GET['edit'])){
  $is_edit = true;
  $id = $_GET['edit'];

  // Event 
  $query = $DBcon->query("SELECT * FROM event WHERE id='".$_GET['edit']."'");
  $row=$query->fetch_array();
  $count = $query->num_rows; 
  $name=$row['name'];
  $tagline=$row['tagline'];
  $description=$row['description'];
  $event_date=$row['event_date'];
  $team_group_id=$row['team_group_id'];
  $price_per_cnx=$row['price_per_cnx'];
  $listing_price=$row['listing_price'];
  $vesting_period=$row['vesting_period'];
  $total_supply=$row['total_supply'];
  $current_round =$row['current_round'];
  $total_rounds =$row['total_rounds'];
  $status=$row['status'];
  $purchase_link=$row['purchase_link'];
  $event_icon=$row['event_icon'];
  $event_video_url=$row['event_video_url'];



  // Event rating
  $rating_query = $DBcon->query("SELECT * FROM event_rating WHERE event_id='".$_GET['edit']."'");
  $rating=$rating_query->fetch_array();

  $activity=$rating['activity'];
  $plan=$rating['plan'];
  $team=$rating['team'];
  $vision=$rating['vision'];
  $product=$rating['product'];
  $potential=$rating['potential'];


}
?>
<body>
  <div class="wrapper ">
    <?php include('includes/sidenav.php')?>
    <div class="main-panel">
      <!-- Navbar -->
      <?php include("includes/navbar.php")?>
      <!-- End Navbar -->
      <div class="content ">
        <div class="container-fluid ">

        <div class="row justify-content-center">
            <div class="col-md-6 ">

              <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title"><?php if($is_edit){ echo "Edit Event"; }else{ echo "Add Event"; }?></h4>
                </div>
                <div class="card-body">
                  <form method="POST" action="includes/routes.php"  enctype="multipart/form-data">
                    <div class="row">
                      <input type="hidden" required  name="id" class="form-control" value="<?php echo $id?>">
                    <div class="col-md-12">
                        <h6>Event Information</h6>
                    </div>
                      <input type="hidden" required  name="id" class="form-control" value="<?php echo $id?>">
                      <?php 
                      if($is_edit && $event_icon!=''){
                      ?>
                      <div class="col-md-12">
                        <img src="<?php echo 'Event_Icons/'.$event_icon?>" width="80%">
                      </div>
                      <?php  
                      }
                      ?>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Event Name</label>
                          <input type="text" required  name="name" class="form-control" value="<?php echo $name?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Tagline</label>
                          <input type="text" name="tagline" class="form-control" value="<?php echo $tagline?>">
                        </div>
                      </div>
                      
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">description</label>
                          <textarea type="text" required  name="description" class="form-control" rows="4" ><?php echo $description?></textarea>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Event Date</label>
                          <input type="datetime-local" required  name="date" class="form-control" value="<?php echo $event_date?>">
                        </div>
                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">status</label>
                          <select name="event_status" class="form-control" id="" required>
                            <option value="">Select Status</option>
                            <?php

                              if($status=='UpComing'){
                            ?>
                            <option value="UpComing" selected>UpComing</option>
                            <option value="Active">Active</option>
                            <option value="Ended">Ended</option>
                            <?php
                              }else if($status=='Active'){
                            ?>
                            <option value="UpComing">UpComing</option>
                            <option value="Active" selected>Active</option>
                            <option value="Ended">Ended</option>
                            <?php
                              }else if($status=='Ended'){
                            ?>
                            <option value="UpComing">UpComing</option>
                            <option value="Active">Active</option>
                            <option value="Ended" selected>Ended</option>
                            <?php
                              }else{
                            ?>
                            <option value="UpComing">UpComing</option>
                            <option value="Active">Active</option>
                            <option value="Ended">Ended</option>
                            <?php
                              }
                            
                            
                            ?>

                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Event Video Url</label>
                          <input type="url" required  name="event_video_url" class="form-control" value="<?php echo $event_video_url?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Team Group</label>
                          <select name="group_id" id="" class="form-control" required> 
                              <option value="">Select Group</option>
                              <?php
                                $groups= $DBcon->query("SELECT * FROM team_groups");
                                while($group_data=$groups->fetch_array()){
                                  if($group_data['id']==$team_group_id){
                              ?>
                                  <option value="<?php echo $group_data['id']?>" selected><?php echo $group_data['name']?></option>
                                <?php
                                  }else{
                                    ?>
                              
                                  <option value="<?php echo $group_data['id']?>"><?php echo $group_data['name']?></option>
                              <?php
                                  }
                                }
                              
                              ?>
                            </select>
                        </div>
                      </div>
                      <div class="col-md-6 mt-3">
                          <label class="bmd-label-floating">Event Icon</label>
                          <input type="file"  accept="image/*" name="event_icon" class="form-control" <?php if(!$is_edit){ echo 'required';}?>>
                      </div>
                      <?php 
                        if($is_edit){
                      ?>
                          <div class="col-md-12" id="litepaper-body">
                            <div class="row">
    
                              <div class="col-md-12 d-flex justify-content-between">
                                <h6>Lite Paper</h6>
                                <button type="button" onclick="add_litepaper()" class="btn btn-primary"><i class="fa fa-plus"></i> More lite papers</button>
                              </div>
                              <?php
                               $event_id=$row['id'];
                               $lite_paper_query = $DBcon->query("SELECT * FROM event_lite_paper WHERE event_id='$event_id'");
                               
                                while($lite_paper_row=$lite_paper_query->fetch_array()){
                              ?>
                              <div class="col-md-12">
                                <div class="row">
                                  <div class="col-md-10">
                                    <a href="<?php echo "Lite_Paper_docs/".$lite_paper_row['document']?>" target="blank"><input type="text" class="form-control" value="<?php echo $lite_paper_row['document']?>" readonly></a>
                                    <input type="file" name="" class="form-control" value="<?php echo $lite_paper_row['document']?>" style="display:none">
                                  </div>
                                  <div class="col-md-2 col-md-2 col-sm-2 col-2">
                                    <a  onclick="delete_data('<?php echo $lite_paper_row['id']; ?>','event_lite_paper')"><i class="fa fa-times" style="color: red; font-size: 30px;padding-top:5px" aria-hidden="true"></i></a>
                                  </div>
                                </div>
                              </div>
                              <?php
                                }
                              ?>
                            </div>
                          </div>
                          <div class="col-md-12 mt-3" id="url-body">
                            <div class="row">
                              <div class="col-md-12 d-flex justify-content-between">
                                <h6>Social Links</h6>
                                <button type="button" onclick="addurl()" class="btn btn-primary"><i class="fa fa-plus"></i> More Links</button>
                              </div>
                              <?php
                                $event_id=$row['id'];
                                $url_query = $DBcon->query("SELECT * FROM event_urls WHERE event_id='$event_id'");
                                
                                while($url_row=$url_query->fetch_array()){
                              ?>
                                <div class="col-md-12">
                                  <div class="row">
                                    <div class="col-md-5">
                                      <div class="form-group">
                                        <label class="bmd-label-floating">Url Name</label>
                                        <input type="text"  class="form-control" value="<?php echo $url_row['url_name']?>">
                                      </div>
                                    </div>
                                    <div class="col-md-5">
                                      <div class="form-group">
                                        <label class="bmd-label-floating">Url</label>
                                        <input type="url" class="form-control" value="<?php echo $url_row['url_link']?>">
                                      </div>
                                    </div>
                                    <div class="col-md-2 col-md-2 col-sm-2 col-2">
                                      <a  onclick="delete_data('<?php echo $url_row['id']; ?>','event_urls')"><i class="fa fa-times" style="color: red; font-size: 30px;margin-top:40px" aria-hidden="true"></i></a>
                                  </div>
                                  </div>
                                </div>
                              <?php
                                }
                              ?>
                            </div>
                          </div>
                          <?php    
                        }else{
                          ?>
                          <div class="col-md-12" id="litepaper-body">
                            <div class="row">
    
                              <div class="col-md-12 d-flex justify-content-between">
                                <h6>Lite Paper</h6>
                                <button type="button" onclick="add_litepaper()" class="btn btn-primary"><i class="fa fa-plus"></i> More lite papers</button>
                              </div>
                              <div class="col-md-12">
                                <div class="row">
                                  <div class="col-md-10">
                                    <input type="file" required accept="image/*" name="lite_paper[]" class="form-control" >
                                  </div>
                                </div>
                              </div>
                              
                            </div>
                          </div>
                          <div class="col-md-12 mt-3" id="url-body">
                            <div class="row">
                              <div class="col-md-12 d-flex justify-content-between">
                                <h6>Social Links</h6>
                                <button type="button" onclick="addurl()" class="btn btn-primary"><i class="fa fa-plus"></i> More Links</button>
                              </div>
                             
                                <div class="col-md-12">
                                  <div class="row">
                                    <div class="col-md-5">
                                      <div class="form-group">
                                        <label class="bmd-label-floating">Url Name</label>
                                        <input type="text" required  name="url_name[]" class="form-control">
                                      </div>
                                    </div>
                                    <div class="col-md-5">
                                      <div class="form-group">
                                        <label class="bmd-label-floating">Url</label>
                                        <input type="url" name="url[]" class="form-control" required >
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              
                            </div>
                          </div>
                      <?php
                        }
                      ?>

                      
                      <div class="col-md-12 mt-3">
                        <h6>Rating</h6>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="bmd-label-floating">Activity</label>
                              <input type="number" required  name="activity_rating" value="<?php echo $activity?>" class="form-control">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="bmd-label-floating">Plan of the Project</label>
                              <input type="number" required  name="planning_rating" value="<?php echo $plan?>" class="form-control">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="bmd-label-floating">Team</label>
                              <input type="number" required  name="team_rating" value="<?php echo $team?>" class="form-control">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="bmd-label-floating">Vision</label>
                              <input type="number" required  name="vision_rating" value="<?php echo $vision?>" class="form-control">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="bmd-label-floating">Product</label>
                              <input type="number" required  name="product_rating" value="<?php echo $product?>" class="form-control">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="bmd-label-floating">Potential</label>
                              <input type="number" required  name="potential_rating" value="<?php echo $potential?>" class="form-control">
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <div class="col-md-12">
                        <h6>PreSale Participation</h6>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="bmd-label-floating">Price Per Cnx</label>
                              <input type="number" name="price_per_cnx" class="form-control" value="<?php echo $price_per_cnx?>" required>
                            </div>  
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="bmd-label-floating">Listing Price</label>
                              <input type="number" name="listing_price" class="form-control" value="<?php echo $listing_price?>" required>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="bmd-label-floating">Vesting Period</label>
                              <input type="number" name="vesting_period" class="form-control" value="<?php echo $vesting_period?>" required>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="form-group">
                              <label class="bmd-label-floating">Purchase Link</label>
                              <input type="url" required  name="purchase_link" value="<?php echo $purchase_link?>" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <h6>General Information</h6>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="bmd-label-floating">Total Supply</label>
                              <input type="number" name="total_supply" class="form-control" required value="<?php echo $total_supply?>">
                            </div>  
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="bmd-label-floating">Current Round</label>
                              <input type="number" name="current_round" class="form-control" required value="<?php echo $current_round?>">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="bmd-label-floating">Total Rounds</label>
                              <input type="number" name="total_round" class="form-control" required value="<?php echo $total_rounds?>">
                            </div>
                          </div>
                        </div>
                      </div>
                        <button type="submit" name="<?php if($is_edit){echo "editEvent";}else{echo "addEvent";}?>" class="btn btn-primary pull-right"><?php if($is_edit){echo "Edit";}else{echo "Add";}?></button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
            
        </div>
      </div>
    <?php include('./includes/footer.php')?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    function add_litepaper(){
      
      var lite_count=1;
      additionalhtml='<div class="row mt-3" id="litecount'+lite_count+'">'+
                                '<div class="col-md-10 col-sm-2 col-2">'+
                                  '<input type="file" required accept="image/*" name="lite_paper[]" class="form-control">'+
                                '</div>'+
                                '<div class="col-md-2 col-md-2 col-sm-2 col-2">'+
                                    '<a  onclick="deleterow_paper('+lite_count+')"><i class="fa fa-times" style="color: red; font-size: 30px;padding-top:5px" aria-hidden="true"></i></a>'+
                                '</div>'+
                               
                            '</div>';
      lite_count++;
      $("#litepaper-body").append(additionalhtml);
    }
    function deleterow_paper(id){
        
        $('#litecount'+id).remove()
        // alert("aaa")
    
    } 

    var url_count=1
    function addurl(){
      additionalhtml='<div class="row mt-3" id="'+url_count+'">'+
                            '<div class="col-md-5">'+
                              '<div class="form-group">'+
                                '<label class="bmd-label-floating">Url Name</label>'+
                                '<input type="text" required  name="url_name[]" class="form-control">'+
                              '</div>'+
                            '</div>'+
                            '<div class="col-md-5">'+
                              '<div class="form-group">'+
                                '<label class="bmd-label-floating">Url</label>'+
                                '<input type="url" name="url[]" class="form-control">'+
                              '</div>'+
                            '</div>'+
                          '<div class="col-md-2 col-md-2 col-sm-2 col-2">'+
                              '<a  onclick="deleteurl('+url_count+')"><i class="fa fa-times" style="color: red; font-size: 30px;margin-top:40px" aria-hidden="true"></i></a>'+
                          '</div>'+
                          
                      '</div>';
      url_count++;                  
      $("#url-body").append(additionalhtml);

    }

    function deleteurl(id){
        $('#'+id).remove()
    }
    function delete_data(id,table){
      $.post('includes/routes.php', {id: id,table_name:table}).then((result)=> {             
          if(!result.error){
            location.reload();
          }
      })
    }
  </script>




</body>

</html>