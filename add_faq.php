<?php 
include('includes/header.php');
$is_edit = false;
$question="";
$answer="";
$id = 0;

if(isset($_GET['edit']))
{
  $is_edit = true;
  $id = $_GET['edit'];
  $query = $DBcon->query("SELECT * FROM faqs WHERE id='".$_GET['edit']."'");
  $row=$query->fetch_array();
  $count = $query->num_rows; 
  $question =  $row['question'];
  $answer =  $row['answer'];
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
                    <h4 class="card-title"><?php if($is_edit){ echo "Edit FAQ"; }else{ echo "Add FAQ"; }?></h4>
                </div>
                <div class="card-body">
                  <form method="POST" action="includes/routes.php">
                    <div class="row">					  
                      <div class="col-md-12">
                          <input type="hidden"  name="id" class="form-control" value="<?php echo $id; ?>">
                        <div class="form-group">
                            <label class="bmd-label-floating">Question</label>
                            <textarea type="text"  name="question" rows="3" class="form-control"><?php echo $question; ?></textarea>
                        </div>
                      </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Answer</label>
                                <textarea type="text" name="answer" rows="5" class="form-control"><?php echo $answer; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="<?php if($is_edit){echo "editFaq";}else{echo "addFaq";}?>" class="btn btn-primary pull-right"><?php if($is_edit){echo "Edit";}else{echo "Add";}?></button>
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