<?php 
include('includes/header.php');
$is_edit = false;
$name =  "";
$email =  "";
$password =  "";
$phone =  "";
$id = 0;

if(isset($_GET['edit'])){
  $is_edit = true;
  $id = $_GET['edit'];
  $query = $DBcon->query("SELECT * FROM servers WHERE id='".$_GET['edit']."'");
  $row=$query->fetch_array();
  $count = $query->num_rows; 
  $serverName =  $row['serverName'];
  $flagURL =  $row['flagURL'];
  $latitude =  $row['latitude'];
  $longitude =  $row['longitude'];
  $region =  $row['region'];
  $city =  $row['city'];
  $hostname =  $row['hostname'];
  $postal =  $row['postal'];
  $timezone =  $row['timezone'];
  $ovpnConfiguration =  $row['ovpnConfiguration'];
  $vpnUserName =  $row['vpnUserName'];
  $vpnPassword =  $row['vpnPassword'];
  $vpnType =  $row['vpnType'];
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
                  <h4 class="card-title"><?php if($is_edit){ echo "Edit User"; }else{ echo "Add User"; }?></h4>
                </div>
                <div class="card-body">
                  <form method="POST" action="includes/routes.php">
                    <div class="row">

                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">User Name</label>
                          <input type="text" required value="<?php echo $serverName; ?>" name="name" class="form-control">
                        </div>
                      </div>

                      
                      
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email</label>
                          <input type="text" required value="<?php echo $latitude; ?>" name="email" class="form-control">
                        </div>
                      </div>
                      
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Phone</label>
                          <input type="text" required value="<?php echo $longitude; ?>" name="phone" class="form-control">
                        </div>
                      </div>
                      
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Password</label>
                          <input type="text" required value="<?php echo $region; ?>" name="password" class="form-control">
                        </div>
                      </div>
                      
                    <button type="submit" name="<?php if($is_edit){echo "editUser";}else{echo "addUser";}?>" class="btn btn-primary pull-right"><?php if($is_edit){echo "Edit";}else{echo "Add";}?></button>
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