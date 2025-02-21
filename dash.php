<!DOCTYPE html>
<html lang="en">
<head>
  <title>Responsive Sidebar</title>
  <!-- Link Styles -->
  <link rel="stylesheet" href="../css/mainstyle.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
  <style>
    ul.nav-list{
  padding-left: 0rem;
}
.dropdown-links {
    display: none; /* Hide the links by default */
    list-style-type: none;
    padding-left: 20px;
  }

  /* Show dropdown on hover */
  .dropdown:hover .dropdown-links {
    display: block;
  }

  .dropdown-links li {
    margin: 5px 0;
  }

  .dropdown-links a {
    text-decoration: none;
    color: white;
  }
  
  .dropdown-links a:hover {
    color: #007bff; /* Change color on hover */
  }
</style>

<body>
<div class="sidebar">
  <div class="logo_details">
    <i class="bx bxl-audible icon"></i>
    <div class="logo_name">Query Sytem</div>
    <i class="bx bx-menu" id="btn"></i>
  </div>
  <ul class="nav-list">
    <li>
      <a href="dash.php">
        <i class="bx bx-grid-alt"></i>
        <span class="link_name">Dashboard</span>
      </a>
      <span class="tooltip">Dashboard</span>
    </li>
    <li>
      <a href="usermngmt.php">
        <i class="bx bx-user"></i>
        <span class="link_name">User Management</span>
      </a>
      <span class="tooltip">User</span>
    </li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle">
        <i class="bx bx-chat"></i>
        <span class="link_name">Policy Management</span>
      </a>
      <span class="tooltip">Policy Management</span>
      <!-- Dropdown Links for Policy Management -->
      <ul class="dropdown-links">
        <li><a href="memo.php">Circular Memorandum</a></li>
        <li><a href="reso.php">Resolution</a></li>
        <li><a href="pnp.php">PNP Policy</a></li>
        <li><a href="#">Add Policy</a></li>
      </ul>
    </li>
    <li class="profile">
      <div class="profile_details">
        <img src="profile.jpeg" alt="profile image">
        <div class="profile_content">
          <div class="name">Anna Jhon</div>
          <div class="designation">Admin</div>
        </div>
      </div>
      <i class="bx bx-log-out" id="log_out"></i>
    </li>
  </ul>
</div>
  
<section class="home-section">
  <!-- Header Section -->
  <header class="dashboard-header">
    <h2 class="m-0">Dashboard</h2>
</header>
  <!-- main dash contents -->
  <main class="px-3 py-2" style="background-color: #e6e4e4; margin-top: 20px;">
                <div class="container-fluid">
                    <div class="card mb-3">
                        <h2 class="card-header"><i class="fa fa-home icon"></i>TOTAL</h2>
                            <div class="card-body row mb-3">
                                
                                <!-- total user -->
                                <div class="col">
                                    <a href="manageuser.php">
                                        <div class="card dashboard-card">
                                            <div class="card-body">
                                                <box-icon type='solid' name='user' size="lg" class="pull-left" animation='tada-hover' color='#ffffff' style='position: relative; bottom: 3px; left: 10px;'></box-icon> 
                                                    <h5 class="card-title text-center">Users</h5> <!-- Fixed h5 tag -->
                                                <p class="card-text text-center h6" id="totalUsers"></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <!-- Total Sales -->
                                <div class="col">
                                    <a href="reportgen.php">
                                    <div class="card dashboard-card">
                                        <div class="card-body">
                                            <box-icon name='dollar-circle' size="lg" class="pull-left" animation='tada-hover' color='#ffffff' style='position: relative; bottom: 3px; left: 10px;'></box-icon>
                                                <h5 class="card-title text-center"> Sales</h5>
                                            <p class="card-text text-center h6">PHP <span id="salesTotal"></span></p>
                                        </div>
                                    </div>
                                    </a>
                                </div>

                                <!-- Total Products Sold -->
                                <div class="col">
                                    <a href="reportgen.php">
                                    <div class="card dashboard-card">
                                        <div class="card-body">
                                            <box-icon type='solid' name='package' size="lg" class="pull-left" animation='tada-hover' color='#ffffff' style='position: relative; bottom: 3px; left: 10px;'></box-icon> 
                                                <h5 class="card-title text-center">Products Sold</h5>
                                            <p class="card-text text-center h6" id="totalSold"></p>
                                        </div>
                                    </div>
                                    </a>
                                </div>

                              

                                <!-- low stocks -->
                                <!-- <div class="col">
                                    <a href="manageinventory.php">
                                        <div class="card dashboard-card">
                                            <div class="card-body">
                                                <box-icon type='solid' name='error-circle' size="lg" class="pull-left" animation='tada-hover' color='#ffffff' style='position: relative; bottom: 3px; left: 10px;'></box-icon> 
                                                    <h5 class="card-title text-center">Low Stocks</h5>
                                                <p class="card-text text-center h6" id="totalLowStock"></p>
                                            </div>
                                        </div>
                                    </a>
                                </div> -->
                        </div>

                     

                    </div>
                </div>
            </main>
  </section>

  
  <!-- Scripts -->
  <script src="../js/sidebar.js"></script>
</body>
</html>