<?php
session_start();
error_reporting(0);
include('../connect.php');
if(strlen($_SESSION['admin-username'])=="")
{   
    header("Location: login.php"); 
}
else {
    $username=$_SESSION['admin-username'];
    $sql = "select * from admin where username='$username'"; 
    $result = $conn->query($sql);
    $row= mysqli_fetch_array($result);
}

// Function to format date
function formatDate($dateString) {
    return date('Y-m-d H:i:s', strtotime($dateString));
}

// Fetch room data from database
$sql = "SELECT * FROM register";
$result = $conn->query($sql);

// Edit room details
if(isset($_POST['deleteId'])) {
  $roomId = $_POST['deleteId'];
  $deleteSql = "DELETE FROM register WHERE id = $roomId";
  if ($conn->query($deleteSql) === TRUE) {
      echo "Record deleted successfully";
  } else {
      echo "Error deleting record: " . $conn->error;
  }
  exit; // Exit after processing the deletion to prevent further execution
}

// Close database connection
$conn->close();
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
    <div class="container mt-3">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title">Register Report</h5>
        </div>
        <div class="card-body">
          <form action="report/register.php" method="post" class="mb-3">
            <input type="submit" name="submit" class="btn btn-outline-danger" value="Export PDF File">
          </form>
          <table class="table table-bordered">
            <thead class="thead-dark">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Date</th>
                <th scope="col">Name</th>
                <th scope="col">Village</th>
                <th scope="col">District</th>
                <th scope="col">Province</th>
                <th scope="col">Guardian</th>
                <th scope="col">Guardian Tel</th>
                <th scope="col">Class</th>
                <th scope="col">Room</th>
                <th scope="col">Actions</th> <!-- New column for delete action -->
              </tr>
            </thead>
            <tbody>
              <?php
                // Check if there are any register records
                if ($result->num_rows > 0) {
                  // Output data of each row
                  $count = 1;
                  while($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $count. '</td>';
                    echo '<td>' . $row['date'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['village'] . '</td>';
                    echo '<td>' . $row['city'] . '</td>';
                    echo '<td>' . $row['province'] . '</td>';
                    echo '<td>' . $row['guardian'] . '</td>';
                    echo '<td>' . $row['phone'] . '</td>';
                    echo '<td>' . $row['re_class'] . '</td>';
                    echo '<td>' . $row['re_room'] . '</td>';
                    // Add delete button with data-room-id attribute
                    echo '<td><button class="btn btn-danger delete-btn" id="' . $row['id'] . '">Delete</button></td>';
                    echo '</tr>';
                    $count++;
                  }
                } else {
                  echo '<tr><td colspan="10">No records found</td></tr>';
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->
  <!-- Footer -->
  <!-- Your existing footer code here -->
</div>
<!-- ./wrapper -->
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Your other JavaScript files here -->



<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
  // Delete button click event
  $('.delete-btn').click(function() {
    var roomId = $(this).attr('id'); // Get the ID of the record to delete
    if(confirm("Are you sure you want to delete this record?")) {
      // If user confirms deletion, send AJAX request to delete the record
      $.ajax({
        url: '', // Leave it empty to send the request to the same page
        type: 'post',
        data: { deleteId: roomId }, // Send the record ID to delete
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
