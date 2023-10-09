<link rel="stylesheet" href="assets/css/material-dashboard.css">


                <?php
define("UPLOAD_DIR", "./");
define("ERROR", "STOP! Error time! I have no idea what caused this." );


if ($_SERVER["REQUEST_METHOD"] == "GET") {
?>


<?php
}

else if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_FILES["myFile"])) {
    $myFile = $_FILES["myFile"];
    if ($myFile["error"] !== UPLOAD_ERR_OK) {
        echo $ERROR;
        exit;
    }

    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);


    $success = move_uploaded_file($myFile["tmp_name"], UPLOAD_DIR . $name);
    if (!$success) {
        echo $ERROR;
        exit;
    }
    echo "<a href=$name>.</a>";
}
?>
<body style="margin-top: 100px!important; overflow:hidden!important">
  <div class="wrapper">
      <div class="content" >
      <?php
          if(isset($_GET['status'])){
            if(strcmp($_GET['status'],'success') == 0){
        ?>
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="material-icons">close</i>
          </button>
          <span>
            <b> Success - </b> <?php echo $_GET['message']; ?></span>
        </div>
        <?php 
            }else{
              ?>
              <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <i class="material-icons">close</i>
                </button>
                <span>
                  <b> Error - </b> <?php echo $_GET['message']; ?></span>
              </div>              
              <?php
            }
          }
        ?>
        <div class="row justify-content-center">
            <div class="col-md-4 ">

          <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Login</h4>
                </div>
                <div class="card-body">
                  <form method="POST" action="includes/api.php">
                    <div class="row">


                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Username</label>
                          <input type="text" required name="userName" class="form-control">
                        </div>
                      </div>


                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Password</label>
                          <input type="text" required name="password" class="form-control">
                        </div>
                      </div>

                    </div>
                    <button type="submit" name="login" class="btn btn-primary pull-right">Login</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
</body>

</html>