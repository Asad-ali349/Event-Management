<?php 
include('includes/header.php');
?>
<body>
  <div class="wrapper ">
    <?php include('includes/sidenav.php')?>
    <div class="main-panel">
      <!-- Navbar -->
      <?php include("includes/navbar.php")?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- Servers Table -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">List of Users</h4>
                  <p class="card-category"> Users information</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          #
                        </th>
                        <th>
                          Name	
                        </th>
                        <th>
                          Email	
                        </th>
                        <th>
                          Password	
                        </th>
                        <th>
                          User Type	
                        </th>
                        <th>
                          Delete
                        </th>
                        <th></th>
                        <th></th>
                      </thead>
                      <tbody>
                      <?php 
                      $query = $DBcon->query("SELECT * FROM users");
                      $count = mysqli_num_rows($query);
                      $i = 1;
                      if($count > 0){
                      while ($row = $query->fetch_assoc()) {
                    ?>
                        <tr  class="configuration">
                          <td>
                            <?php echo $i;?>
                          </td>
						  
                          <td>
                            <?php echo $row['name'];?>
                          </td>
                          <td>
                          <?php echo $row['email'];?>
                          </td>
                          <td>
                          <?php echo $row['password'];?>
                          </td>
                          <td>
                          <?php echo $row['level'];?>
                          </td>
							<!--<td>-->
							<!--<?php echo $row['adType'];?>-->
       <!--                   </td>-->
                          <!--<td class="text-center"><?php if(strcmp($row['activeAd'],'1')==0){?><i class="fa fa-check text-success"></i><?php }else{ ?><i class="fa fa-times text-danger"></i><?php }?></td>-->
							<td>
                              <a type="button" rel="tooltip" title="Delete user" href="index.php?delete_user=<?php echo $row['id']?>" class="btn btn-danger btn-link btn-sm">
                                <i class="material-icons">close</i>
                              </a>
							</td>
                        </tr>
                        <?php 
                        $i++;
                      }
                    }else{
                      echo "<tr><td>No user saved!</td></tr>";
                    }
                      ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
      
      
<?php include('./includes/footer.php')?>
</body>