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
                  <h4 class="card-title ">List of Team Members</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          #
                        </th>
                        <th>
                          Member Name	
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                          Phone	
                        </th>
                        <th>
                          Designation
                        </th>
                        <th>
                          Group Name
                        </th>
						            <th>
                          Action
                        </th>
                      </thead>
                      <tbody>
                      <?php 
                      $query = $DBcon->query("SELECT * FROM team_members");
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
                                <?php echo $row['email'];?>
                                </td>
                                <td>
                                <?php echo $row['phone'];?>
                                </td>
                                <td>
                                <?php echo $row['designation'];?>
                                </td>
                                <td>
                                  <?php 
                                    $group_id=$row['team_group_id'];
                                    $group_query = $DBcon->query("SELECT * FROM team_groups where id='$group_id'");
                                    $group_data = $group_query->fetch_assoc();
                                    echo $group_data['name'];
                                  ?>
                                </td>
                                    
                                
                                <td>
                                    <a type="button" rel="tooltip" title="Edit Team Member" href="add_team_member.php?edit=<?php echo $row['id']?>" class="btn btn-primary btn-link btn-sm">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <a type="button" rel="tooltip" title="Delete Team Member" onclick="delete_data('<?php echo $row['id']?>','team_members')" class="btn btn-danger btn-link btn-sm">
                                        <i class="material-icons">close</i>
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
          </div>
          </div>
        </div>
      </div>
    <?php include('./includes/footer.php')?>



    <script>
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