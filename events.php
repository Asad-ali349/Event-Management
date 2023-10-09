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
                  <h4 class="card-title ">List of Events</h4>
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
                      $query = $DBcon->query("SELECT * FROM event");
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
                                    $group_query = $DBcon->query("SELECT * FROM team_groups where id='$group_id'");
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
                                    <a type="button" rel="tooltip" title="Edit Event" href="add_event.php?edit=<?php echo $row['id']?>" class="btn btn-primary btn-link btn-sm">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <a type="button" rel="tooltip" title="Delete Event" onclick="delete_data('<?php echo $row['id']?>','event')" class="btn btn-danger btn-link btn-sm">
                                        <i class="material-icons">close</i>
                                    </a>
                                </td>
                                
                            </tr>
                        <?php 
                            $i++;
                        }
                        }else{
                        echo "<tr><td>No Event saved!</td></tr>";
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
          console.log(result)
      })
    }
    </script>
</body>

</html>