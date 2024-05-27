<?php
session_start();
error_reporting(0);
include('../connect.php');
if(strlen($_SESSION['admin-username']) == "") {   
    header("Location: login.php"); 
    exit();
} else {
    $username = $_SESSION['admin-username'];
    $sql = "SELECT * FROM admin WHERE username='$username'"; 
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result);
}

// Fetch room data from database
$sql = "SELECT * FROM room";
$result = $conn->query($sql);

// Edit room details
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editRoomId'])) {
    $roomId = $_POST['editRoomId'];
    $newRoomName = $_POST['editRoomName'];
    $newCapacity = $_POST['editCapacity'];

    $sql = "UPDATE room SET room_name = '$newRoomName', capacity = '$newCapacity' WHERE room_id = $roomId";
    if ($conn->query($sql) === TRUE) {
        // Edit successful
        echo "Room details updated successfully.";
    } else {
        // Error handling
        echo "Error updating room details: " . $conn->error;
    }
}

// Delete room
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteRoomId'])) {
    $roomId = $_POST['deleteRoomId'];

    $sql = "DELETE FROM room WHERE room_id = $roomId";
    if ($conn->query($sql) === TRUE) {
        // Deletion successful
        echo "Room deleted successfully.";
    } else {
        // Error handling
        echo "Error deleting room: " . $conn->error;
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Applications Records | Online Student Admission system</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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

  <style>
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
    <ul class="navbar-nav ml-auto"></ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
      <img src="../images/log.jpg" alt="Logo" width="154" height="143" style="opacity: .8">
      <span class="brand-text font-weight-light">&nbsp;&nbsp;&nbsp;&nbsp;</span>
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
          <?php include('sidebar.php'); ?>
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
              <li class="breadcrumb-item active">Applications</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="container mt-3">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title text-info">Room Report</h5>
        </div>
        <div class="card-body">
          <form action="report/room.php" method="post">
            <input type="submit" name="submit" class="btn btn-danger mb-3" value="Export PDF File">
          </form>
          <table class="table table-bordered">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Room ID</th>
                <th scope="col">Room Name</th>
                <th scope="col">Capacity</th>
                <th scope="col">Current Occupancy</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($result->num_rows > 0) {
                $count = 1;
                while($row = $result->fetch_assoc()) {
                  echo '<tr>';
                  echo '<td>' . $row['room_id'] . '</td>';
                  echo '<td>' . $row['room_name'] . '</td>';
                  echo '<td>' . $row['capacity'] . '</td>';
                  echo '<td>' . $row['current_occupancy'] . '</td>';
                  echo '<td>
                          <button class="btn btn-primary edit-btn" data-room-id="' . $row['room_id'] . '">Edit</button>
                          <button class="btn btn-danger delete-btn" data-room-id="' . $row['room_id'] . '">Delete</button>
                        </td>';
                  echo '</tr>';
                  $count++;
                }
              } else {
                echo '<tr><td colspan="5">No rooms found</td></tr>';
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Room</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="">
          <div class="modal-body">
            <input type="hidden" id="editRoomId" name="editRoomId">
            <div class="form-group">
              <label for="editRoomName">Room Name</label>
              <input type="text" class="form-control" id="editRoomName" name="editRoomName" required>
            </div>
            <div class="form-group">
              <label for="editCapacity">Capacity</label>
              <input type="number" class="form-control" id="editCapacity" name="editCapacity" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Delete Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Delete Room</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this room?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ./wrapper -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
  // Edit button click event
  $('.edit-btn').click(function() {
    var roomId = $(this).data('room-id');
    var roomName = $(this).closest('tr').find('td:eq(1)').text();
    var capacity = $(this).closest('tr').find('td:eq(2)').text();
    $('#editRoomId').val(roomId);
    $('#editRoomName').val(roomName);
    $('#editCapacity').val(capacity);
    $('#editModal').modal('show');
  });

  // Delete button click event
  $('.delete-btn').click(function() {
    var roomId = $(this).data('room-id');
    $('#confirmDelete').data('room-id', roomId);
    $('#deleteModal').modal('show');
  });

  // Confirm delete button click event
  $('#confirmDelete').click(function() {
    var roomId = $(this).data('room-id');
    // AJAX request to delete room
    $.post('', { deleteRoomId: roomId })
      .done(function(data) {
        console.log(data);
        // Reload the page after successful deletion
        location.reload();
      })
      .fail(function(xhr, status, error) {
        console.error(xhr.responseText);
      });
  });
});
</script>
</body>
</html>
