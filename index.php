<?php 
include('includes/header.php');

// $query = $DBcon->query("SELECT * FROM event where status='UpComing' OR status='Active'");
$count_upcomming_query=mysqli_fetch_array($DBcon->query("SELECT COUNT(*) as upcoming FROM event where status='UpComing'"));
$count_upcomming=$count_upcomming_query['upcoming'];

$count_active_query=mysqli_fetch_array($DBcon->query("SELECT COUNT(*) as active FROM event where status='Active'"));
$count_active=$count_active_query['active'];

$count_ended_query=mysqli_fetch_array($DBcon->query("SELECT COUNT(*) as ended FROM event where status='Ended'"));
$count_ended=$count_ended_query['ended'];

$count_member_query=mysqli_fetch_array($DBcon->query("SELECT COUNT(*) as member FROM team_members"));
$count_member=$count_member_query['member'];

$count_group_query=mysqli_fetch_array($DBcon->query("SELECT COUNT(*) as groups FROM team_groups"));
$count_group=$count_group_query['groups'];

$count_faq_query=mysqli_fetch_array($DBcon->query("SELECT COUNT(*) as faq FROM faqs"));
$count_faq=$count_faq_query['faq'];




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
            
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">event</i>
                  </div>
                  <p class="card-category">Active</p>
                  <h3 class="card-title"><?php echo $count_active;?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    
                  </div>
                </div>

              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                  <i class="material-icons">event</i>
                  </div>
                  <p class="card-category">UpComping</p>
                  <h3 class="card-title"><?php echo $count_upcomming;?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">event</i>
                  </div>
                  <p class="card-category">Ended</p>
                  <h3 class="card-title"><?php echo $count_ended;?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="row">
            
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">group</i>
                  </div>
                  <p class="card-category">Team Members</p>
                  <h3 class="card-title"><?php echo $count_member;?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    
                  </div>
                </div>

              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">groups</i>
                  </div>
                  <p class="card-category">Team Groups</p>
                  <h3 class="card-title"><?php echo $count_group;?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-question"></i>
                  </div>
                  <p class="card-category">FAQS</p>
                  <h3 class="card-title"><?php echo $count_faq;?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
            <!-- Admob Table -->
          <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">List Of Events</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                      <th>
                          #
                        </th>
                        <th>
                          Event Name	
                        </th>
                        <th>
                            Tag Line
                        </th>
                        <th>
                          Group Name	
                        </th>
                        <th>
                          Event Date
                        </th>
                        <th>
                          Status
                        </th>
						            <th>
                          Action
                        </th>
                      </thead>
                      <tbody>
                      <?php 
                      $query = $DBcon->query("SELECT * FROM event where status='UpComing' OR status='Active'");
                      $count = mysqli_num_rows($query);
                      $i = 1;
                      if($count > 0){
                        while ($row = $query->fetch_assoc()) {
                        ?>
                            <tr class="configuration">
                                <td>
                                    <?php echo $i;?>
                                </td>
                                
                                <td>
                                    <?php echo $row['name'];?>
                                </td>
                                <td>
                                <?php echo $row['tagline'];?>
                                </td>
                                <td>
                                  <?php 
                                    $group_id=$row['team_group_id'];
                                    $group_query = $DBcon->query("SELECT * FROM team_groups where id='$group_id' ");
                                    $group_data = $group_query->fetch_assoc();
                                    echo $group_data['name'];
                                  ?>
                                </td>
                                <td>
                                <?php echo $row['event_date'];?>
                                </td>
                                
                                <td>
                                <?php echo $row['status'];?>
                                </td>
                                
                                <td>
                                    <a type="button" rel="tooltip" title="Mark as Ended" onclick="mark_as_end('<?php echo $row['id']?>')" class="btn btn-success btn-link btn-sm">
                                        <i class="material-icons">check</i>
                                    </a>
                                </td>
                                
                            </tr>
                        <?php 
                            $i++;
                        }
                        }else{
                        echo "<tr><td>No Member saved!</td></tr>";
                        }
                      ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <!-- Servers Table -->
          </div>
          </div>
        </div>
      </div>
    <?php include('./includes/footer.php')?>
    <script>
      function mark_as_end(id){
        var status='Ended';
      $.post('includes/routes.php', {id: id,status:status}).then((result)=> {             
          if(!result.error){
            window.location.href = "index.php?status=success&message=Event Status updated succesfully";
          }
      })
    }
    </script>



</body>



<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.alert {
  padding: 20px;
  background-color: #ffd117;
  color: #000000;
}

.closebtn {
  margin-left: 15px;
  color: #000000;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>


</html>