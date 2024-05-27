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
              <li class="breadcrumb-item active">Applications'class1</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <p>&nbsp;</p>
          <table width="1161" border="0" align="center">
            <tr>
              <td width="1155">
                <div class="card">
                  <div class="card-header">
                    <h2>Class 2</h2>
                    <h3 class="card-title">&nbsp;</h3>
                  </div>
                  <div class="card-body">
                    <table width="85%" align="center" class="table table-bordered table-striped" id="example1">
                      <thead>
                        <tr>
                          <th width="3%">#</th>
                          <th width="13%">ຊື່ ແລະນາມສະກຸນ</th>
                          <th width="7%">ເພດ</th>
                          <th width="7%">ບ້ານ</th>
                          <!-- <th width="7%">ເມື່ອງ</th>
                          <th width="9%">ແຂວງ</th> -->
                          <th width="13%">ວັນ/ເດືອນ/ປີເກີດ.</th>
                          <th width="7%"> ເບີຕິດຕໍ່</th>
                          <th width="7%">ຊື້ຜູ້ປົກຄອງ</th>
                          <th width="7%">ເບີຕິດຕໍຜູ້ປົກຄອງ</th>
                          <th width="7%">ຊັ້ນຮຽນ</th>
                          <th width="7%">ຫ້ອງ</th>
                          <th width="7%">ອີເມວ</th>
                          <th width="7%">ລະຫັດ</th>
                          <th width="7%">ວັນທີ່</th>
                          <th width="8%">ປຶ່ມຕິດຕາມ</th>
                          <th width="8%">ຮູບ</th>
                          <th width="9%">Status</th>
                          <th width="16%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $sql = "SELECT * FROM admission WHERE ssce_details='end' ORDER BY date_admission ASC";
                          $result = $conn->query($sql);
                          $cnt=1;
                          while($row = $result->fetch_assoc()) { 
                        ?>
                          <tr class="gradeX">
                            <td height="47"><div align="center"><?php echo $cnt; ?></div></td>
                            <td><div align="center"><?php echo $row['fullname']; ?></div></td>
                            <td><div align="center"><?php echo $row['sex']; ?></div></td>
                            <td><div align="center"><?php echo $row['dept']; ?></div></td>
                            <!-- <td><div align="center"><?php echo $row['lga']; ?></div></td>
                            <td><div align="center"><?php echo $row['state']; ?></div></td> -->
                            <td><div align="center"><?php echo $row['jamb_number']; ?></div></td>
                            <td><div align="center"><?php echo $row['phone']; ?></div></td>
                            <td><div align="center"><?php echo $row['faculty']; ?></div></td>
                            <td><div align="center"><?php echo $row['jamb_score']; ?></div></td>
                            <td><div align="center"><?php echo $row['ssce_details']; ?></div></td>
                            <td><div align="center"><?php echo $row['room']; ?></div></td>
                            <td><div align="center"><?php echo $row['email']; ?></div></td>
                            <td><div align="center"><?php echo $row['applicationID']; ?></div></td>
                            <td><div align="center"><?php echo $row['date_admission']; ?></div></td>
                            <td><div align="center"><span class="controls"><img src="../<?php echo $row['ssce'];?>"  width="100" height="100" border="2"/></span></div></td>
                            <td><div align="center"><span class="controls"><img src="../<?php echo $row['photo'];?>"  width="50" height="43" border="2"/></span></div></td>
                            <td><?php if(($row['status'])==((1))) { ?>
                              <span class="badge badge-primary">ໄດ້ຊຳລະຄ່າເທີມແລວແລ້ວ</span>
                            <?php } else { ?>
                              <span class="badge badge-danger"> ຍັງບໍ່ທັນຊຳລະຄ່າເທີມ</span>
                            <?php } ?></td>
                            <td>
                              <span class="style6">
                                <?php if(($row['status'])==((1))) { ?>
                                  <a href="admit_exec.php?id=<?php echo $row['ID'];?>"> ຍົກເລີກການຊຳລະ </a> 
                                <?php } else { ?>
                                  <a href="admit_exec.php?uid=<?php echo $row['ID'];?>"> ຊຳລະຄ່າເທີມແລ້ວ </a> 
                                <?php } ?>
                                /
                                <a href="delete-user.php?id=<?php echo $row['ID'];?>" onClick="return deldata('<?php echo $row['fullname']; ?>');">Delete </a>
                              </span>
                            </td>
                          </tr>
                          <?php $cnt=$cnt+1;} ?>
                      </tbody>
                      <tfoot>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </td>
            </tr>
          </table>
          <p>
          </p>
        </div>
    </div>
  </div>
</div>
<footer class="main-footer">
  <div class="float-right d-none d-sm-block"></div>
</footer>

<aside class="control-sidebar control-sidebar-dark">
</aside>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
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