
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
                        <h2 class="" style="margin: 0;"><i class="fa fa-user icon"></i> Manage Circular Memorandum</h2>
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMemorandum" style="display: flex; align-items: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16" style="margin-right: 5px;">
                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                    </svg> Add New Memorandum
                </button>
                </div>
            </section>

            <!-- User Table -->
            <div class="card-body">
                <div style="max-height: 550px; overflow-y: auto;">
                    <table class="table table-striped table-bordered table-condensed border-secondary table-hover" style="--bs-border-opacity: .4;">
                        <thead>
                            <tr>
                                <th style="color: #ffffff; background-color: #0f557f; border: 1px solid #ffffff;">Memorandum Number</th>
                                <th style="color: #ffffff; background-color: #0f557f; border: 1px solid #ffffff;">Memo Title</th>
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

                            $fetch_query = "SELECT * FROM tbl_memo";
                            $fetch_query_run = $conn->query($fetch_query);

                            if ($fetch_query_run->num_rows > 0) {
                                while ($row = $fetch_query_run->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td class="uid"><?php echo htmlspecialchars($row['memo_number']); ?></td>
                                        <td class="uid"><?php echo htmlspecialchars($row['memo_title']); ?></td>
                                        
                                        <td>
                                          <?php 
                                            if (!empty($row['memo_file_path']) && file_exists($row['memo_file_path'])) { 
                                                ?>
                                                <a href="<?= htmlspecialchars($row['memo_file_path']); ?>" target="_blank">View File</a>
                                            <?php 
                                            } else { 
                                                ?>
                                                <span style="color:red;">No File</span>
                                            <?php 
                                            } 
                                          ?>
                                        </td>
                                        <td class="text-center">
                                          <!-- Button to trigger modal -->
                                          <button type="button" class="btn btn-primary editMemoBtn"
                                              data-bs-toggle="modal" 
                                              data-bs-target="#editMemoModal"
                                              data-memo-id="<?php echo $row['memo_id']; ?>"
                                              data-memo-title="<?php echo htmlspecialchars($row['memo_title']); ?>"
                                              data-memo-number="<?php echo htmlspecialchars($row['memo_number']); ?>"
                                              data-memo-file="<?php echo htmlspecialchars($row['memo_file_path']); ?>">
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

<div class="modal fade" id="editMemoModal" tabindex="-1" aria-labelledby="editMemoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Memo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="update_memo.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="memo_id" id="editMemoId">

                    <div class="mb-3">
                        <label class="form-label">Memo Title</label>
                        <input type="text" class="form-control" name="memo_title" id="editMemoTitle" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Memo Number</label>
                        <input type="text" class="form-control" name="memo_number" id="editMemoNumber" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Memo File</label>
                        <input type="file" class="form-control" name="memo_file">
                        <small>Current File: <span id="editMemoFile"></span></small>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="update_memo">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addMemorandum" tabindex="-1" aria-labelledby="addMemorandumLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMemorandumLabel">Add New Memorandum</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="memorandumForm" action="add_memorandum.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="memoNumber" class="form-label">Memorandum Number</label>
                        <input type="text" class="form-control" id="memo_number" name="memo_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="memoTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="memo_title" name="memo_title" required>
                    </div>
                    <div class="mb-3">
                        <label for="memoFile" class="form-label">Attach File</label>
                        <input type="file" class="form-control" id="memo_file_path" name="memo_file_path" onchange="showFileName()">
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
        document.querySelectorAll(".editMemoBtn").forEach(button => {
            button.addEventListener("click", function () {
                const memoId = this.getAttribute("data-memo-id");
                const memoTitle = this.getAttribute("data-memo-title");
                const memoNumber = this.getAttribute("data-memo-number");
                const memoFile = this.getAttribute("data-memo-file");

                document.getElementById("editMemoId").value = memoId;
                document.getElementById("editMemoTitle").value = memoTitle;
                document.getElementById("editMemoNumber").value = memoNumber;
                document.getElementById("editMemoFile").textContent = memoFile ? memoFile : "No file uploaded";
            });
        });
    });
</script>

  <script src="../js/addmemo.js"></script>
  <script src="../js/sidebar.js"></script>
</body>
</html>