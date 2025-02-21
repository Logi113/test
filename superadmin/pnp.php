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
    <div class="text">Dashboard</div>
    

  </section>
  
  <!-- Scripts -->
  <script src="../js/sidebar.js"></script>
</body>
</html>