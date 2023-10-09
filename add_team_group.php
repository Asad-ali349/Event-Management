<?php 
include('includes/header.php');
$is_edit = false;
$name =  "";
$id = 0;

if(isset($_GET['edit'])){
  $is_edit = true;
  $id = $_GET['edit'];
  $query = $DBcon->query("SELECT * FROM team_groups WHERE id='".$_GET['edit']."'");
  $row=$query->fetch_array();
  $count = $query->num_rows;
  $name =  $row['name'];
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
                  <h4 class="card-title"><?php if($is_edit){ echo "Edit Team Group"; }else{ echo "Add Team Group"; }?></h4>
                </div>
                <div class="card-body">
                  <form method="POST" action="includes/routes.php">
                    <div class="row">
                    <input type="hidden" required value="<?php echo $id; ?>" name="id" class="form-control">
                    <div class="col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Group Name</label>
                        <input type="text" required value="<?php echo $name; ?>" name="name" class="form-control">
                    </div>
                    </div>
                    <button type="submit" name="<?php if($is_edit){echo "editGroup";}else{echo "addGroup";}?>" class="btn btn-primary pull-right"><?php if($is_edit){echo "Edit";}else{echo "Add";}?></button>
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