<?php 
include('includes/header.php');
$is_edit = false;
$serverName =  "";
$flagURL =  "";
$latitude =  "";
$longitude =  "";
$region =  "";
$city =  "";
$hostname =  "";
$postal   = "";
$timezone   = "";
$ovpnConfiguration =  "";
$vpnUserName =  "";
$vpnPassword =  "";
$vpnType =  "";
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
<h4 class="card-title"><?php if($is_edit){ echo "Edit Server"; }else{ echo "Add Server"; }?></h4>
                </div>
                <div class="card-body">
                  <form method="POST" action="includes/routes.php">
                    <div class="row">

                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Server Name</label>
                          <input type="text" required value="<?php echo $serverName; ?>" name="serverName" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Country Flag (URL)</label>
                          <input type="text" required value="<?php echo $flagURL; ?>" name="flagURL" class="form-control">
                        </div>
                      </div>
                      
                      
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">latitude</label>
                          <input type="text" required value="<?php echo $latitude; ?>" name="latitude" class="form-control">
                        </div>
                      </div>
                      
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">longitude</label>
                          <input type="text" required value="<?php echo $longitude; ?>" name="longitude" class="form-control">
                        </div>
                      </div>
                      
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Region</label>
                          <input type="text" required value="<?php echo $region; ?>" name="region" class="form-control">
                        </div>
                      </div>
                      
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">City</label>
                          <input type="text" required value="<?php echo $city; ?>" name="city" class="form-control">
                        </div>
                      </div>
                      
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Hostname</label>
                          <input type="text" required value="<?php echo $hostname; ?>" name="hostname" class="form-control">
                        </div>
                      </div>
                      
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Postal Address</label>
                          <input type="text" required value="<?php echo $postal; ?>" name="postal" class="form-control">
                        </div>
                      </div>
                      
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">TimeZone</label>
                          <input type="text" required value="<?php echo $timezone; ?>" name="timezone" class="form-control">
                        </div>
                      </div>
                      
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">OVPN Configuration Scripts</label>
                          <textarea name="ovpn"  class="form-control"><?php echo $ovpnConfiguration; ?></textarea>
                        </div>
                      </div>


                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">VPN Username</label>
                          <input type="text"  value="<?php echo $vpnUserName; ?>"name="vpnUsername" class="form-control">
                        </div>
                      </div>


                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">VPN Password</label>
                          <input type="text"  value="<?php echo $vpnPassword; ?>" name="vpnPassword" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                            <label class="bmd-label-floating">VPN Type</label>
                            <select name="vpnType" class="form-control">
                              <option value="free" <?php if($vpnType==1){echo "selected";} ?>>Open VPN</option>
                              <option value="pro"  <?php if($vpnType==0){echo "selected";} ?>>Ikev2 VPN</option>
                            </select>
                        </div>
                      </div>
                      <input type="text" value="<?php echo $id; ?>" name="id" style="display:none" class="form-control">

                    </div>
                    <button type="submit" name="<?php if($is_edit){echo "editServer";}else{echo "addServer";}?>" class="btn btn-primary pull-right"><?php if($is_edit){echo "Edit";}else{echo "Add";}?></button>
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