<?php
session_start();
error_reporting(0);
include('../connect.php');
if(strlen($_SESSION['admin-username'])=="")
{   
    header("Location: login.php"); 
}
else {
}
$username=$_SESSION['admin-username'];
$sql = "select * from admin where username='$username'"; 
$result = $conn->query($sql);
$row= mysqli_fetch_array($result);

// Process form submission for editing
if (isset($_POST['edit'])) {
    $edit_id = $_POST['edit_id'];
    $sql = "SELECT * FROM admin WHERE ID='$edit_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $edit_username = $row['username'];
        $edit_password = $row['password'];
    }
}
// Process form submission for deleting individual records
if(isset($_POST['deleteId'])) {
  $deleteId = $_POST['deleteId'];
  $deleteSql = "DELETE FROM teacher WHERE id = $deleteId";
  if ($conn->query($deleteSql) === TRUE) {
      echo "Record deleted successfully";
  } else {
      echo "Error deleting record: " . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Applications Records|Online Student Admission system</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <link rel="shortcut icon" href="../images/log.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Your other CSS files here -->
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
    <!--
    .style6 {font-size: 12px}
    -->
    *{
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
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>      </li>
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
      <img src="../images/log.jpg" alt=" Logo" width="154" height="143" style="opacity: .8">
      <span class="brand-text font-weight-light">      &nbsp;&nbsp;&nbsp;&nbsp;   </span>    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../upload/no_image.jpg" alt="User Image" width="188" height="181" class="img-circle elevation-2">        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $row['username'];  ?></a>
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
              <li class="breadcrumb-item active">Applications'm1</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    
<!-- Main content -->
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8"> <!-- Changed col-md-6 to col-md-8 -->
      <div class="card">
        <div class="card-header">
          <h2 class="text-center bg-info">Teacher Details</h2>
        </div> 
        
        <div class="card-body">
        <form action="report/teacherpdf.php" method="post" class="ms-2">
         <input type="submit" name="submit" class="btn btn-outline-danger mb-3" value="export PDF file">
         </form>
        
          <div class="table-responsive">
          <table class="table table-bordered">
    <thead>
        <tr>
            <th>ລະຫັດ</th>
            <th>ຊື່</th>
            <th>ເພດ</th>
            <th>ທີ່ຢູ່</th>
            <th>ເມວ</th>
            <th>ເບີໂທ</th>
            <th>ການກວດສອບ</th> <!-- New column for delete action -->
        </tr>
    </thead>
    <tbody>
        <?php
        // Display admin records
        $sql = "SELECT * FROM teacher";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $count = 1;
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$count."</td>
                        <td>".$row['name']."</td>
                        <td>".$row['gender']."</td>
                        <td>".$row['address']."</td>
                        <td>".$row['gmail']."</td>
                        <td>".$row['phone']."</td>
                        <td><button class='btn btn-danger delete-btn' data-id='".$row['id']."'>Delete</button></td>
                      </tr>";
                $count++;
            }
        } else {
            echo "<tr><td colspan='6' class='text-center'>No records found</td></tr>";
        }
        $conn->close();
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<!-- JavaScript to handle individual record deletion -->
<script>
$(document).ready(function() {
  $('.delete-btn').click(function() {
    var recordId = $(this).data('id');
    if(confirm("Are you sure you want to delete this record?")) {
      $.ajax({
        url: '', // Leave it empty to send the request to the same page
        type: 'post',
        data: { deleteId: recordId }, // Send the record ID to be deleted
        success: function(response) {
          // If deletion is successful, reload the page to reflect changes
          location.reload();
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
          // Handle error if deletion fails
          alert('Error deleting record');
        }
      });
    }
  });
});
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
