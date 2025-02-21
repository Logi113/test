<?php
include '../connection.php';
?>

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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
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
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                    <h2 class="mb-0" style="margin-top: 0 !important;"><i class="fa fa-user icon"></i> Manage User</h2>
                    </div>
                    <div class="col-auto">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                            <input type="text" name="search" id="searchUsers" placeholder="Search User" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add User Button -->
            <section class="card-body d-flex w-100 mb-3">
                <div class="flex-grow-1">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUsers" style="display: flex; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16" style="margin-right: 5px;">
                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                        </svg> Add New User
                    </button>
                </div>
            </section>

            <!-- User Table -->
            <div class="card-body">
                <div style="max-height: 550px; overflow-y: auto;">
                    <table class="table table-striped table-bordered table-condensed border-secondary table-hover" style="--bs-border-opacity: .4;">
                        <thead>
                            <tr>
                                <th style="color: #ffffff; background-color: #0f557f; border: 1px solid #ffffff;">Username</th>
                                <th style="color: #ffffff; background-color: #0f557f; border: 1px solid #ffffff;">Name</th>
                                <th style="color: #ffffff; background-color: #0f557f; border: 1px solid #ffffff;">Status</th>
                                <th style="color: #ffffff; background-color: #0f557f; border: 1px solid #ffffff;">User Level</th>
                                <th class="text-center" style="color: #ffffff; background-color: #0f557f; border: 1px solid #ffffff;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="dataTable">
                            <?php
                            $conn = new mysqli("localhost", "root", "", "db_napolcom");

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            $fetch_query = "SELECT * FROM tbl_users";
                            $fetch_query_run = $conn->query($fetch_query);

                            if ($fetch_query_run->num_rows > 0) {
                                while ($row = $fetch_query_run->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td class="uid"><?php echo htmlspecialchars($row['username']); ?></td>
                                        <td class="uid"><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td class="uid"><?php echo htmlspecialchars($row['status']); ?></td>
                                        <td class="uid"><?php echo htmlspecialchars($row['ulvl']); ?></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary view_user" data-id="<?php echo $row['id']; ?>">View</button>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal-<?php echo $row['id']; ?>">Update</button>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='5' style='text-align: center;'>No Records Found</td></tr>";
                            }

                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
                            
<!-- Footer -->
<footer class="footer fixed-bottom" style="background-color: #ffffff; box-shadow: 0 0 35px 0 rgba(49, 57, 66, 0.3);">
        <div class="container d-flex justify-content-end align-items-center" style="height: 40px;">
            <div class="column col100">
                <div id="footer" class="text-end">
                    <div class="title" style="font-family: 'Poppins', sans-serif; color: #686868; font-size: 80%;">
                        © 2025 National Police Commission Region 1, City of San Fernando, La Union. All rights reserved
                    </div>
                </div>
            </div>
        </div>
    </footer>
  

</section>


  <!-- Scripts -->
  <script src="../js/sidebar.js"></script>
  <script>
  // Optional: Adding JavaScript for a smoother hover effect (if needed)
  document.querySelectorAll('.dropdown').forEach(function(dropdown) {
    dropdown.addEventListener('mouseenter', function() {
      this.querySelector('.dropdown-links').style.display = 'block';
    });
    dropdown.addEventListener('mouseleave', function() {
      this.querySelector('.dropdown-links').style.display = 'none';
    });
  });
</script>
</body>
</html>
