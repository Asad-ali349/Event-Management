<?php 
include('includes/header.php');
$is_edit = false;
$name =  "";
$email =  "";
$password =  "";
$phone =  "";
$designation =  "";
$profile_image =  "";
$link =  "";
$id = 0;

if(isset($_GET['edit'])){
  $is_edit = true;
  $id = $_GET['edit'];
  $query = $DBcon->query("SELECT * FROM team_members WHERE id='".$_GET['edit']."'");
  $row=$query->fetch_array();
  $count = $query->num_rows; 
  $name =  $row['name'];
  $email =  $row['email'];
  $phone =  $row['phone'];
  $designation =  $row['designation'];
  $profile_image =  $row['user_profile_pic'];
  $link =  $row['linked_in_link'];
  $team_group_id =  $row['team_group_id'];
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
                    <h4 class="card-title"><?php if($is_edit){ echo "Edit Team Member"; }else{ echo "Add Team Member"; }?></h4>
                </div>
                <div class="card-body">
                  <form method="POST" action="includes/routes.php"  enctype="multipart/form-data">
                    <div class="row">
                    <input type="hidden" required  name="id" class="form-control" value="<?php echo $id?>">
                      <?php 
                        if($profile_image!=""){
                        ?>
                        <div class="col-md-12">
                            <img src="<?php echo "team_members/".$profile_image?>" width="200px" height="200px"/>
                        </div>
                        <?php
                        }
                      ?>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">User Name</label>
                          <input type="text" required  name="name" class="form-control" value="<?php echo $name?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email</label>
                          <input type="email" name="email" class="form-control" value="<?php echo $email?>">
                        </div>
                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Phone</label>
                          <input type="text" required  name="phone" class="form-control" value="<?php echo $phone?>">
                        </div>
                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Designation</label>
                          <input type="text" required  name="designation" class="form-control" value="<?php echo $designation?>">
                        </div>
                      </div>
                      <div class="col-md-6 mt-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Link Profile Link</label>
                          <input type="url" required  name="link" class="form-control" value="<?php echo $link?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                            <label>Team Group</label>
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
                      <div class="col-md-12">
                            <label>Member Picture</label>
                          <input type="file" accept="image/*" name="profile_image" class="form-control" <?php if($profile_image==""){echo 'required';}?> >
                      </div>
                        <button type="submit" name="<?php if($is_edit){echo "editMember";}else{echo "addMember";}?>" class="btn btn-primary pull-right"><?php if($is_edit){echo "Edit";}else{echo "Add";}?></button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
            
        </div>
      </div>
    <?php include('./includes/footer.php')?>
</body>

</html>