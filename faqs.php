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
                          FAQ Question	
                        </th>
						<th>
                          Action
                        </th>
                      </thead>
                      <tbody>
                      <?php 
                      $query = $DBcon->query("SELECT * FROM faqs");
                      $count = mysqli_num_rows($query);
                      $i = 1;
                      if($count > 0){
                        while ($row = $query->fetch_assoc()) {
                        ?>
                            <tr class="configuration">
                                <td>
                                    <?php echo $i;?>
                                </td>
                                
                                <td style="max-width:500px">
                                    <?php echo $row['question'];?>
                                </td>
                                    
                                
                                <td>
                                    <a type="button" rel="tooltip" title="Edit FAQ" href="add_faq.php?edit=<?php echo $row['id']?>" class="btn btn-primary btn-link btn-sm">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <a type="button" rel="tooltip" title="Delete FAQ" onclick="delete_data('<?php echo $row['id']?>','faqs')" class="btn btn-danger btn-link btn-sm">
                                        <i class="material-icons">close</i>
                                    </a>
                                </td>
                                
                            </tr>
                        <?php 
                            $i++;
                        }
                        }else{
                        echo "<tr><td>No FAQ Saved!</td></tr>";
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