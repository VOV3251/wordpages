<?php
session_start();
error_reporting(0);
include('../connect.php');

if(strlen($_SESSION['admin-username']) == 0) { 
  header("Location: login.php"); 
  exit();
}

// Perform deletion if transaction ID is provided
if(isset($_POST['transaction_id'])) {
  $transaction_id = $_POST['transaction_id'];

  // Perform the deletion
  $sql = "DELETE FROM transactions WHERE id = $transaction_id";
  if ($conn->query($sql) === TRUE) {
    echo "Deletion successful";
  } else {
    echo "Error in deletion";
  }

  exit(); // Terminate script execution after deletion
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
  <title>Transactions Records | Online Student Admission System</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <link rel="shortcut icon" href="../images/log.jpg" type="image/x-icon" />
  <style type="text/css">
    * {
      font-family: "Noto Sans Lao", sans-serif;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
    </ul>
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
    <ul class="navbar-nav ml-auto">
    </ul>
  </nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
      <img src="../images/log.jpg" alt="Logo" width="154" height="143" style="opacity: .8">
      <span class="brand-text font-weight-light"> </span>    
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../upload/no_image.jpg" alt="User Image" width="188" height="181" class="img-circle elevation-2">        
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $row['username']; ?></a>
        </div>
      </div>
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
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php include('sidebar.php');?>
        </ul>
      </nav>
    </div>
  </aside>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">&nbsp;</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Playment Record</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <p>&nbsp;</p>
          <table width="1161" border="0" align="center">
            <tr>
              <td width="1155">
                <div class="card">
                <div class="card-header">
                <h2>All Payments</h2>
            </div>
            
            <div class="card-body">
            <form action="report/pay.php" method="post" class="ms-2">
      <input type="submit" name="submit" class="btn btn-outline-danger" value="export PDF file">
    </form>
                <table class="table table-bordered table-striped mt-5" id="example1">
                <thead>
                <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Guardian</th>
                        <th>Class</th>
                        <th>Room</th>
                        <th>Total Amount</th>
                        <th>Image Filename</th> 
                        <th>Upload Date</th>  <th>Action</th>  
                      </tr>
</thead>
<tbody>
<?php
                   $sql = "SELECT transactions.*, images.filename AS image_filename, images.filepath, images.upload_date AS image_upload_date
                   FROM transactions
                   LEFT JOIN images ON transactions.id = transactions.id"; // Assuming 'transaction_id' is the foreign key in images
           
           
              $result = $conn->query($sql);
                    $count = 1;

                    if (!$result) {
                      die("Error in SQL query: " . $conn->error);
                    }

                    while ($row = $result->fetch_assoc()) {
                      echo "<tr id='row{$row['id']}'>  <td>{$count}</td>
                            <td>{$row['date']}</td>
                            <td>{$row['fullname']}</td>
                            <td>{$row['guardian']}</td>
                            <td>{$row['class']}</td>
                            <td>{$row['room']}</td>
                            <td>{$row['total_amount']}</td>
                                    <td>" . (!empty($row['image_filename']) ? $row['image_filename'] : 'No Image Available') . "</td>
                                    <td>" . (!empty($row['filepath']) ? "<img src='playment/{$row['filepath']}' alt='{$row['image_filename']}' style='max-width: 100px;'>" : '') . "</td>
                                    <td><button class='btn btn-danger' onclick='deleteTransaction({$row['id']})'>Delete</button></td>
                                    ...</tr>";
                              $count++;
                            }
                          
                    ?>
</tbody>

                </table>
            </div>
                </div>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </section>
  </div>
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block"></div>
  </footer>
</div>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<!-- JavaScript section -->
<script>
      function deleteTransaction(id) {
        if (confirm("Are you sure you want to delete this transaction?")) {
          // Send an AJAX request to the same page for deletion
          $.post('', { transaction_id: id })
            .done(function(data) {
              // Remove the row from the table upon successful deletion
              var rowId = 'row' + id;
              var row = document.getElementById(rowId);
              row.parentNode.removeChild(row);
              alert(data); // Display success message
            })
            .fail(function() {
              alert("Error in deletion"); // Display error message
            });
        }
      }
    </script>
</body>
</html>
