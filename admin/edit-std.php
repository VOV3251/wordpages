<?php
session_start();
error_reporting(0);
include('../connect.php');

if(strlen($_SESSION['uemail'])=="")
    {   
    header("Location: login.php"); 
    }
    else{
	}
      
$email = $_SESSION["uemail"];


date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d ');

				
$sql = "select * from admission where email='$email'"; 
$result = $conn->query($sql);
$rowaccess = mysqli_fetch_array($result);

if(isset($_POST["btnedit"]))
{

$fullname = mysqli_real_escape_string($conn,$_POST['txtfullname']);
$sex = mysqli_real_escape_string($conn,$_POST['cmdsex']);
$jamb = mysqli_real_escape_string($conn,$_POST['txtjamb']);
$score = mysqli_real_escape_string($conn,$_POST['txtscore']);
$exam = mysqli_real_escape_string($conn,$_POST['txtexam']);
$phone = mysqli_real_escape_string($conn,$_POST['txtphone']);
$lga = mysqli_real_escape_string($conn,$_POST['txtlga']);
$state = mysqli_real_escape_string($conn,$_POST['txtstate']);
$dept = mysqli_real_escape_string($conn,$_POST['txtdept']);
$faculty = mysqli_real_escape_string($conn,$_POST['txtfaculty']);
$room = mysqli_real_escape_string($conn,$_POST['room']);

// $image= addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
// $image_name= addslashes($_FILES['userImage']['name']);
// $image_size= getimagesize($_FILES['userImage']['tmp_name']);
// move_uploaded_file($_FILES["userImage"]["tmp_name"],"../upload/" . $_FILES["userImage"]["name"]);			
// $location="upload/" . $_FILES["userImage"]["name"];

			
$sql1 = " update admission set fullname='$fullname',sex='$sex',jamb_number='$jamb',jamb_score='$score', room='$room',state='$state',faculty='$faculty',dept='$dept',ssce_details='$exam' where email='$email'";
   
   if (mysqli_query($conn, $sql1)) {

header("Location: index.php");
}else{
$_SESSION['error']='Editing Was Not Successful';


}
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Applications Records | Online Student Admission system</title>
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

  <!-- Place this code inside the <head> section of your HTML -->
 
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
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title text-center">Student infromation</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                  <?php
	$sql = "select * from admission where email='$email'"; 
$result = $conn->query($sql);
$row= mysqli_fetch_array($result);
					
					?>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-6 b-r"><h2 class="m-t-none m-b"><b>ແກ້ໄຂ້ ຫນ້າປົກຂອງຕົວເອງ</b></h2>
             <form  action="" method="POST" enctype="multipart/form-data">
                                    <div class="form-group"><strong>
                                    <label>ຊື່ ແລະນາມສະກຸນ</label></strong>
                                    <input type="text" size="77" name="txtfullname"  value="<?php echo $row['fullname'];   ?>" class="form-control" required="">
                                    </div>
									<div class="form-group"><label>ເພດ</label> 
         <select name="cmdsex" id="select" class="form-control" required="">
 	 <option value="<?php echo $row['sex'];?>"><?php echo $row['sex'];?></option>
    <option value="Male">ຊາຍ</option>
    <option value="Female">ຍິງ</option>
    </select> 
</div>
                     <div class="form-group"><label> ວັນເດືອນ/ປີ ເກີດ </label>
					  <input type="tel" size="77" name="txtjamb" value="<?php echo $row['jamb_number'];   ?>" class="form-control" >
					  </div>

				     <div class="form-group"><label>ເບີໂທຂອງນັກຮຽນ</label>
					  <input type="tel" size="77" name="txtphone" value="<?php echo $row['phone'];   ?>" class="form-control" >
					  </div>
                      <div class="form-group"><label>ບ້ານ</label>
					  <input type="tel" size="77" name="txtdept" value="<?php echo $row['dept'];   ?>" class="form-control" >
					  </div>
					   <div class="form-group"><label>ເມື່ອງ</label>
					  <input type="tel" size="77" name="txtlga" value="<?php echo $row['lga'];   ?>" class="form-control" >
					  </div>
                      
					   <div class="form-group"><label>ແຂວງ</label>
					  <input type="tel" size="77" name="txtstate" value="<?php echo $row['state'];   ?>" class="form-control" >
					  </div>
					  
                      <div class="form-group"><label>ເບີໂທຜູ້ປົກຄອງ</label>
					  <input type="tel" size="77" name="txtscore" value="<?php echo $row['jamb_score'];   ?>" class="form-control" >
					  </div>
                      
					  <div class="form-group"><label>ຊື່ຜູ້ປົກຄອງ</label>
					  <input type="tel" size="77" name="txtfaculty" value="<?php echo $row['faculty'];   ?>" class="form-control" >
					  </div>
                <div class="form-group"><label> ຊັ້ນ</label>
					  <input type="tel" size="77" name="txtexam" value="<?php echo $row['ssce_details'];   ?>" class="form-control" >
					  </div>

            <div class="form-group"><label>ຫ້ອງ</label>
					  <input type="tel" size="77" name="room" value="<?php echo $row['room'];   ?>" class="form-control" >
					  </div>
					   		                   
						  
									 <!-- <div class="col-sm-6">
                                
                                <p class="text-center">
                                    <img src="../<?php echo $row['photo'];   ?>" alt="ritman" width="166" height="147">                                </p>
                                <p class="text-center">
                                  <input name="userImage" type="file" class="inputFile" />
                                </p>
									 </div> -->
                                    <div>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="btnedit">
                                        <div align="centre"><strong><i class="fa fa-paste btn-lg fs-3"></i><h3>ແກ້ໄຂ້ຫນ້າປົກ</h3> </strong></div>
                                        </button>
                                  </div>
                                </form>
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

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>

<script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>
		<link rel="stylesheet" href="popup_style.css">
<?php if(!empty($_SESSION['success'])) {  ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      <strong>Success</strong> 
    </h1>
    <p><?php echo $_SESSION['success']; ?></p>
    <p>
      <button class="button button--success" data-for="js_success-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["success"]);  
} ?>
<?php if(!empty($_SESSION['error'])) {  ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      <strong>Error</strong> 
    </h1>
    <p><?php echo $_SESSION['error']; ?></p>
    <p>
      <button class="button button--error" data-for="js_error-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["error"]);  } ?>
    <script>
      var addButtonTrigger = function addButtonTrigger(el) {
  el.addEventListener('click', function () {
    var popupEl = document.querySelector('.' + el.dataset.for);
    popupEl.classList.toggle('popup--visible');
  });
};

Array.from(document.querySelectorAll('button[data-for]')).
forEach(addButtonTrigger);
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
