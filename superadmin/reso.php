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
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="" style="margin: 0;"><i class="fa fa-user icon"></i> Manage Resolution</h2>
                    </div>
                    <div class="col-auto">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                            <input type="text" name="search" id="searchUsers" placeholder="Search User" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

           <!-- Add Resolution Button -->
          <section class="card-body d-flex w-100 mb-3">
              <div class="flex-grow-1">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addResModal" style="display: flex; align-items: center;">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-plus" viewBox="0 0 16 16" style="margin-right: 5px;">
                          <path d="M8 6a.5.5 0 0 1 .5.5V8H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9H6a.5.5 0 0 1 0-1h1.5V6.5A.5.5 0 0 1 8 6"/>
                          <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h6.5L14 4.5M10 1.5V5h3.5L10 1.5"/>
                      </svg> 
                      Add New Resolution
                  </button>
              </div>
          </section>


            <!-- User Table -->
            <div class="card-body">
                <div style="max-height: 550px; overflow-y: auto;">
                    <table class="table table-striped table-bordered table-condensed border-secondary table-hover" style="--bs-border-opacity: .4;">
                        <thead>
                            <tr>
                                <th style="color: #ffffff; background-color: #0f557f; border: 1px solid #ffffff;">Resolution Number</th>
                                <th style="color: #ffffff; background-color: #0f557f; border: 1px solid #ffffff;">Resolution Title</th>
                                <th style="color: #ffffff; background-color: #0f557f; border: 1px solid #ffffff;">File</th>
                                <th class="text-center" style="color: #ffffff; background-color: #0f557f; border: 1px solid #ffffff;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="dataTable">
                            <?php
                            $conn = new mysqli("localhost", "root", "", "db_napolcom");

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            $fetch_query = "SELECT * FROM tbl_reso";
                            $fetch_query_run = $conn->query($fetch_query);

                            if ($fetch_query_run->num_rows > 0) {
                                while ($row = $fetch_query_run->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td class="uid"><?php echo htmlspecialchars($row['res_number']); ?></td>
                                        <td class="uid"><?php echo htmlspecialchars($row['res_title']); ?></td>
                                        <td>
                                          <?php 
                                            if (!empty($row['res_file_path']) && file_exists($row['res_file_path'])) { 
                                                ?>
                                                <a href="<?= htmlspecialchars($row['res_file_path']); ?>" target="_blank">View File</a>
                                            <?php 
                                            } else { 
                                                ?>
                                                <span style="color:red;">No File</span>
                                            <?php 
                                            } 
                                          ?>
                                        </td>


                                        <td class="text-center">
                                          <button type="button" class="btn btn-primary editResBtn"
                                              data-bs-toggle="modal" 
                                              data-bs-target="#editResModal"
                                              data-res-id="<?php echo $row['res_id']; ?>"
                                              data-res-title="<?php echo htmlspecialchars($row['res_title']); ?>"
                                              data-res-number="<?php echo htmlspecialchars($row['res_number']); ?>"
                                              data-res-file="<?php echo htmlspecialchars($row['res_file_path']); ?>">
                                              Update
                                          </button>                                        
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
</section>

<!-- ------edit resolution----- -->
<div class="modal fade" id="editResModal" tabindex="-1" aria-labelledby="editResModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Res</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="update_res.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="res_id" id="editResId">

                      <div class="mb-3">
                          <label class="form-label">Resolution Title</label>
                          <input type="text" class="form-control" name="res_title" id="editResTitle" required>
                      </div>
                     
                       
                      <div class="mb-3">
                          <label class="form-label">Resolution Number</label>
                          <input type="text" class="form-control" name="res_number" id="editResNumber" required>
                      </div>
                       
                    <div class="mb-3">
                        <label class="form-label">Resolution File</label>
                        <input type="file" class="form-control" name="res_file">
                        <small class="text-muted">Current File: <span id="editResFile" class="fw-bold"></span></small>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="update_res">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- -----add resolution------- -->
<div class="modal fade" id="addResModal" tabindex="-1" aria-labelledby="addResModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addResModalLabel">Add New Resolution</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="resForm" action="add_res.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="memoNumber" class="form-label">Resolution  Number</label>
                        <input type="text" class="form-control" id="res_number" name="res_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="memoTitle" class="form-label">Resolution Title</label>
                        <input type="text" class="form-control" id="res_title" name="res_title" required>
                    </div>
                    <div class="mb-3">
                        <label for="memoFile" class="form-label">Attach File</label>
                        <input type="file" class="form-control" id="res_file_path" name="res_file_path" onchange="showFileName()">
                        <small id="fileNameDisplay" class="text-muted"></small>
                    </div>
                    <!-- Moved Submit Button Inside the Form -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".editResBtn").forEach(button => {
            button.addEventListener("click", function () {
                const resId = this.getAttribute("data-res-id");
                const resTitle = this.getAttribute("data-res-title");
                const resNumber = this.getAttribute("data-res-number");
                const resFile = this.getAttribute("data-res-file");

                document.getElementById("editResId").value = resId;
                document.getElementById("editResTitle").value = resTitle;
                document.getElementById("editResNumber").value = resNumber;
                document.getElementById("editResFile").textContent = resFile ? resFile : "No file uploaded";
            });
        });
    });
</script>

  
  <!-- Scripts -->
  <script src="../js/sidebar.js"></script>
</body>
</html>