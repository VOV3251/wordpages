<?php
session_start();
error_reporting(0);
include('../../connect.php');

// Check if admin is logged in
if(empty($_SESSION['admin-username'])) {   
    header("Location: ../login.php"); 
    exit();
}

$username = $_SESSION['admin-username'];
$sql = "SELECT * FROM admin WHERE username='$username'"; 
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);

// Handle image deletion
if(isset($_POST['action']) && $_POST['action'] == 'delete_image') {
    if(isset($_POST['image_id'])) {
        $imageId = $_POST['image_id'];
        // Perform deletion
        $deleteSql = "DELETE FROM images WHERE id = $imageId";
        if ($conn->query($deleteSql) === TRUE) {
            echo "Image deleted successfully";
        } else {
            echo "Error deleting image: " . $conn->error;
        }
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Applications Records | Online Student Admission System</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
  <link rel="shortcut icon" href="../../images/log.jpg" type="image/x-icon" />

  <script type="text/javascript">
    function deldata(fullname){
      if(confirm("ARE YOU SURE YOU WISH TO DELETE " + " " + fullname+ " " + " FROM THE LIST?")) {
        return true;
      } else {
        return false;
      } 
    }
  </script>

  <style type="text/css">
    .style6 {font-size: 12px}
    * {
      font-family: "Noto Sans Lao", sans-serif;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../../images/log.jpg" alt=" Logo" width="154" height="143" style="opacity: .8">
      <span class="brand-text font-weight-light">&nbsp;&nbsp;&nbsp;&nbsp;</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../upload/no_image.jpg" alt="User Image" width="188" height="181" class="img-circle elevation-2">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $row['username']; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php
            include('sidebar.php');
          ?>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">&nbsp;</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Applications</li>
            </ol>
          </div>
        </div>
      </div>
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
                              <th>name</th>
                              <th>Filename</th>
                              <th>Filepath</th>
                              <th>Upload Date</th>                       
                              <th>Image</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
// SQL query to select data from images and transactions tables
// SQL query to select data from images and transactions tables
$imageSql = "SELECT images.*, transactions.fullname AS fullname
             FROM images
             LEFT JOIN transactions ON images.id = transactions.id";
$imageResult = $conn->query($imageSql);

if ($imageResult->num_rows > 0) {
    $id = 1;
    while($imageRow = $imageResult->fetch_assoc()) {
        echo "<tr>
                <td>".$id."</td>
                <td>".$imageRow['fullname']."</td>
                <td>".$imageRow['filename']."</td>
                <td>".$imageRow['filepath']."</td>
                <td>".$imageRow['upload_date']."</td>
                <td><img src='".$imageRow['filepath']."' alt='".$imageRow['filename']."' class='img-thumbnail' style='max-width: 100px;'></td>
                <td><button class='btn btn-danger' onclick='deleteImage(".$imageRow['id'].")'>Delete</button></td> 
              </tr>";
        $id++;
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>No images found</td></tr>";
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
</div>

<footer class="main-footer">
  <div class="float-right d-none d-sm-block"></div>
</footer>

<aside class="control-sidebar control-sidebar-dark">
</aside>

<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>
<script src="../dist/js/demo.js"></script>

<script>
  function deleteImage(imageId) {
    if (confirm("Are you sure you want to delete this image?")) {
      // Send AJAX request to delete the image from the database
      $.post('', { action: 'delete_image', image_id: imageId })
        .done(function(data) {
          // Reload the page after successful deletion
          location.reload();
          alert(data); // Display success message
        })
        .fail(function() {
          alert("Error in deletion"); // Display error message
        });
    }
  }
</script>
 
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
