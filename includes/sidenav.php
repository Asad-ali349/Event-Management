<div class="sidebar" data-color="green" data-background-color="black">
      <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
      <div class="logo">
        <a href="/" class="simple-text logo-normal">
          Admin Panel
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
        <li class="nav-item <?php if(!strcmp($_SERVER['REQUEST_URI'],"/"))
        {echo "active";}?>">
            <a class="nav-link" href="./">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item  <?php if(!strcmp($_SERVER['REQUEST_URI'],"/add_servers.php")){echo "active";}?>">
            <a class="nav-link" href="add_servers.php">
              <i class="material-icons">add</i>
              <p>Add Server</p>
            </a>
          </li>

          <li class="nav-item  <?php if(!strcmp($_SERVER['REQUEST_URI'],"/servers.php")){echo "active";}?>">
            <a class="nav-link" href="servers.php">
              <i class="material-icons">public</i>
              <p>Servers</p>
            </a>
          </li>
		  <li class="nav-item  <?php if(!strcmp($_SERVER['REQUEST_URI'],"/add_ads.php")){echo "active";}?>">
            <a class="nav-link" href="add_ads.php">
              <i class="material-icons">add</i>
              <p>Add Ads Config</p>
            </a>
          </li>
          <li class="nav-item  <?php if(!strcmp($_SERVER['REQUEST_URI'],"/ads_list.php")){echo "active";}?>">
            <a class="nav-link" href="ads_list.php">
              <i class="material-icons">track_changes</i>
              <p>Ads Config List</p>
            </a>
          </li>
          <li class="nav-item  <?php if(!strcmp($_SERVER['REQUEST_URI'],"/add_user.php")){echo "active";}?>">
            <a class="nav-link" href="add_user.php">
              <i class="material-icons">add</i>
              <p>Add User</p>
            </a>
          </li>
          <li class="nav-item  <?php if(!strcmp($_SERVER['REQUEST_URI'],"/user_list.php")){echo "active";}?>">
            <a class="nav-link" href="user_list.php">
              <i class="material-icons">group</i>
              <p>Users</p>
            </a>
          </li>
          <li class="nav-item  <?php if(!strcmp($_SERVER['REQUEST_URI'],"/add_team_member.php")){echo "active";}?>">
            <a class="nav-link" href="add_team_member.php">
              <i class="fa fa-user-plus"></i>
              <p>Add Team Member</p>
            </a>
          </li>
          <li class="nav-item  <?php if(!strcmp($_SERVER['REQUEST_URI'],"/view_team_members.php")){echo "active";}?>">
            <a class="nav-link" href="team_members.php">
            <i class="material-icons">group</i>
              <p>Team Members</p>
            </a>
          </li>
          <li class="nav-item  <?php if(!strcmp($_SERVER['REQUEST_URI'],"/add_team_group.php")){echo "active";}?>">
            <a class="nav-link" href="add_team_group.php">
              <i class="material-icons">add</i>
              <p>Add Team Group</p>
            </a>
          </li>
          <li class="nav-item  <?php if(!strcmp($_SERVER['REQUEST_URI'],"/team_group.php")){echo "active";}?>">
            <a class="nav-link" href="team_group.php">
            <i class="material-icons">group_add</i>
              <p>Team Group</p>
            </a>
          </li>
          <li class="nav-item  <?php if(!strcmp($_SERVER['REQUEST_URI'],"/add_event.php")){echo "active";}?>">
            <a class="nav-link" href="add_event.php">
              <i class="fa fa-calendar-plus-o"></i>
              <p>Add Event</p>
            </a>
          </li>
          <li class="nav-item  <?php if(!strcmp($_SERVER['REQUEST_URI'],"/events.php")){echo "active";}?>">
            <a class="nav-link" href="events.php">
              <i class="fa fa-calendar" aria-hidden="true"></i>
              <p>Events</p>
            </a>
          </li>
          <li class="nav-item  <?php if(!strcmp($_SERVER['REQUEST_URI'],"/add_faq.php")){echo "active";}?>">
            <a class="nav-link" href="add_faq.php">
            <i class="material-icons">add</i>
              <p>Add FAQs</p>
            </a>
          </li>
          <li class="nav-item  <?php if(!strcmp($_SERVER['REQUEST_URI'],"/faqs.php")){echo "active";}?>">
            <a class="nav-link" href="faqs.php">
              <i class="fa fa-question" aria-hidden="true"></i>
              <p>FAQs</p>
            </a>
          </li>
          <!-- your sidebar here -->
        </ul>
      </div>
    </div>
