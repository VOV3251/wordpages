<!-- <?php
//     session_start();
//     error_reporting(0);
//     include('../../connect.php');

//     if(isset($_POST['btnlogin'])) {
//         //Get Date
//         date_default_timezone_set('Africa/Lagos');
//         $current_date = date('Y-m-d h:i:s');

//         $email = $_POST['txtemail'];
//         $applicationID = $_POST['txtapplicationID'];

//         $sql = "SELECT * FROM admission WHERE email='".$email."' and applicationID = '".$applicationID."'";
//         $result = mysqli_query($conn, $sql);

//         if (mysqli_num_rows($result) > 0) {
//             // output data of each row
//             $row = mysqli_fetch_assoc($result);
//             $_SESSION["uemail"] = $row['email'];
//             header("Location: ../edit-std.php");
//             exit(); // Add exit after header redirect to prevent further execution
//         } else { 
//             $_SESSION['error'] = 'Wrong Email Address or Application ID';
//         }
//     }
// ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Bootstrap CSS -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="../images/log.jpg" type="image/x-icon" />
    <style>
        * {
            font-family: Noto Sans Lao, sans-serif;
        }
        .form-group {
            font-size: 3rem;
        }
        .form-group .form-control {
            font-size: 2rem;
        }
        a {
            font-size: 2rem;
        }
    </style>
</head> -->

<!-- <body class="gray-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="middle-box text-center loginscreen animated fadeInDown">
                    <div>
                        <img src="../images/log.jpg" alt="Online student admission form" width="176" height="164">
                        <h1 class="logo-name"></h1>
                        <h3>&nbsp;</h3>
                        <form class="m-t" role="form" method="POST" action="">
                            <div class="form-group">
                                <input type="email" name="txtemail" class="form-control" placeholder="ຈີເມວ ຂອງນ້ອງນັກຮຽນ" required="">
                            </div>
                            <div class="form-group">
                                <input type="text" name="txtapplicationID" class="form-control" placeholder=" ລະຫັດຂອງນັກຮຽນ (N5900) " required="">
                            </div>
                            <button type="submit" name="btnlogin" class="btn btn-primary btn-lg fs-3 block full-width m-b">Login</button>
                            <a class="btn btn-info btn-lg fs-5 block full-width m-b" href="../index.php">ກັບໄປຫນ້າລັກ</a>
                            <p class="text-muted text-center">&nbsp;</p>
                        </form>
                        <p class="m-t"></p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Mainly scripts -->

    <!-- <script src="js/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="popup_style.css">
    <?php if(!empty($_SESSION['success'])) {  ?>
        <div class="popup popup--icon -success js_success-popup popup--visible">
            <div class="popup__background"></div>
            <div class="popup__content">
                <h3 class="popup__content__title">
                    <strong>ສຳເລັດ</strong> 
                </h1>
                <p><?php echo $_SESSION['success']; ?></p>
                <p>
                    <button class="button button--success" data-for="js_success-popup">ປິດອອກ</button>
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
                    <strong>ບໍສຳເລັດ</strong> 
                </h1>
                <p><?php echo $_SESSION['error']; ?></p>
                <p>
                    <button class="button button--error" data-for="js_error-popup">ປິດອອກ</button>
                </p>
            </div>
        </div>
        <?php unset($_SESSION["error"]);  
    } ?>
    <script>
        var addButtonTrigger = function addButtonTrigger(el) {
            el.addEventListener('click', function () {
                var popupEl = document.querySelector('.' + el.dataset.for);
                popupEl.classList.toggle('popup--visible');
            });
        };
        Array.from(document.querySelectorAll('button[data-for]')).forEach(addButtonTrigger);
    </script>
</body>
</html>
 --> 



<!--  -->
<?php
    session_start();
    error_reporting(0);
    include('../../connect.php');

    if(isset($_POST['btnlogin'])) {
        //Get Date
        date_default_timezone_set('Africa/Lagos');
        $current_date = date('Y-m-d h:i:s');

        $email = $_POST['txtemail'];
        $applicationID = $_POST['txtapplicationID'];

        $sql = "SELECT * FROM admission WHERE email='".$email."' and applicationID = '".$applicationID."'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $row = mysqli_fetch_assoc($result);
            $_SESSION["uemail"] = $row['email'];
            header("Location: ../edit-std.php");
            exit(); // Add exit after header redirect to prevent further execution
        } else { 
            $_SESSION['error'] = 'Wrong Email Address or Application ID';
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
  <link rel="shortcut icon" href="../images/log.jpg" type="image/x-icon" />
    <style>
        * {
            font-family: Noto Sans Lao, sans-serif;
        }
        .form-group {
            font-size: 3rem;
        }
        .form-group .form-control {
            font-size: 2rem;
        }
        a {
            font-size: 2rem;
        }
    </style>

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
            include('../sidebar.php');
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
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    
                <div class="card-header">
                        <h2>Edit-std Infromation</h2>
                    </div>

                    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="middle-box text-center loginscreen animated fadeInDown">
                    <div>
                        <!-- <img src="../images/log.jpg" alt="Online student admission form" width="176" height="164"> -->
                        <h1 class="logo-name"></h1>
                        <h3>&nbsp;</h3>
                        <form class="m-t" role="form" method="POST" action="">
                            <div class="form-group">
                                <input type="email" name="txtemail" class="form-control" placeholder="ຈີເມວ ຂອງນ້ອງນັກຮຽນ" required="">
                            </div>
                            <div class="form-group">
                                <input type="text" name="txtapplicationID" class="form-control" placeholder=" ລະຫັດຂອງນັກຮຽນ (N5900) " required="">
                            </div>
                            <button type="submit" name="btnlogin" class="btn btn-primary btn-lg fs-3 block full-width m-b">Login</button>
                            <!-- <a class="btn btn-info btn-lg fs-5 block full-width m-b" href="../index.php">ກັບໄປຫນ້າລັກ</a> -->
                            <p class="text-muted text-center">&nbsp;</p>
                        </form>
                        <p class="m-t"></p>
                    </div>
                </div>
            </div>
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

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
    <!-- Mainly scripts -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="popup_style.css">
    <?php if(!empty($_SESSION['success'])) {  ?>
        <div class="popup popup--icon -success js_success-popup popup--visible">
            <div class="popup__background"></div>
            <div class="popup__content">
                <h3 class="popup__content__title">
                    <strong>ສຳເລັດ</strong> 
                </h1>
                <p><?php echo $_SESSION['success']; ?></p>
                <p>
                    <button class="button button--success" data-for="js_success-popup">ປິດອອກ</button>
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
                    <strong>ບໍສຳເລັດ</strong> 
                </h1>
                <p><?php echo $_SESSION['error']; ?></p>
                <p>
                    <button class="button button--error" data-for="js_error-popup">ປິດອອກ</button>
                </p>
            </div>
        </div>
        <?php unset($_SESSION["error"]);  
    } ?>
    <script>
        var addButtonTrigger = function addButtonTrigger(el) {
            el.addEventListener('click', function () {
                var popupEl = document.querySelector('.' + el.dataset.for);
                popupEl.classList.toggle('popup--visible');
            });
        };
        Array.from(document.querySelectorAll('button[data-for]')).forEach(addButtonTrigger);
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


