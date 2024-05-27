<?php
session_start();
error_reporting(0);
include('../../connect.php'); // Assuming connect.php is in the parent directory of room
if(strlen($_SESSION['admin-username']) == 0) {   
    header("Location: login.php"); 
    exit();
}

$username = $_SESSION['admin-username'];
$sql = "SELECT * FROM admin WHERE username='$username'"; 
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Images Records | Online Student Admission system</title>
  <!-- Add your CSS and JS files here -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    * {
      font-family: "Noto Sans Lao", sans-serif;
    }
    .img-thumbnail {
      max-width: 100px;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Add Navbar content here -->
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar content here -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <!-- Content Header content here -->
    </div>

    <!-- Main content -->
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h2 class="text-center bg-info">Uploaded Images</h2>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Filename</th>
                      <th>Filepath</th>
                      <th>Upload Date</th>
                      <th>Image</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // Display images from the image table
                    $imageSql = "SELECT * FROM images";
                    $imageResult = $conn->query($imageSql);
                    if ($imageResult->num_rows > 0) {
                        while($imageRow = $imageResult->fetch_assoc()) {
                            echo "<tr>
                                    <td>".$imageRow['id']."</td>
                                    <td>".$imageRow['filename']."</td>
                                    <td>".$imageRow['filepath']."</td>
                                    <td>".$imageRow['upload_date']."</td>
                                    <td><img src='../playment".$imageRow['filepath']."' alt='".$imageRow['filename']."' class='img-thumbnail'></td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>No images found</td></tr>";
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
