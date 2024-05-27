<?php
session_start();
error_reporting(0);
include('connect.php');

date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d H:i:s');

if(isset($_POST['btnsubmit']))
{

$pin = $_POST['txtpin'];
$serial = $_POST['txtserial'];

 $sql = "SELECT * FROM scratchcard WHERE pin='" .$pin . "' and serial = '".$serial."' and status = '0'";
     $result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
  // output data of each row
 ($row = mysqli_fetch_assoc($result));
$_SESSION["serial"] = $row['serial'];
	
header("Location: apply/admis.php"); 
    }else { 
?>
<script>
alert('Invalid Scratch Card Details or Has Already been Used');

</script>
<?php 
         }
    
   }

?>
<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
     <!-- Site Metas -->
    <title>Nonsard Secondary School|Online Student Admission System</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
	rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/log.jpg" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/log.jpg">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="css/versions.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!-- Modernizer for Portfolio -->
    <script src="js/modernizer.js"></script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
<!--
.style1 {color: #000000}

-->
body{
	font-family: "Noto Sans Lao", sans-serif;
}
    </style>
    </head>
<body class="host_version"> 

	<!-- Modal -->
	<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header tit-up">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title fs-5" style="font-family:Noto Sans Lao, sans-serif;"> ຖ້ານັກຮຽນຍັງບໍ່ມີລະຫັດ ກະລູນາປອນຊຶ ແລະ ]ລະຫັດຢູ່ຫນ້າ sig up ກ່ອນ  </h4>
			</div>
			<div class="modal-body customer-box">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs">
					<li><a class="active fs-5" style="font-family:Noto Sans Lao, sans-serif;" href="#Login" data-toggle="tab"> ກະລູນາປອນຊຶ ແລະ ]ລະຫັດຕາມທີ່ທ່ານໄດ້ລັອກອິນໄວ້(N5900)</a></li>
									<img src="images/log.jpg" alt="" height="100" width="100"/>

				</ul>
				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane active" id="Login">
					<?php
			include('form.php');
					?>
					</div>
					
				</div>
			</div>
		</div>
	  </div>
	</div>

    <!-- LOADER -->
	<div id="preloader">
		<div class="loader-container">
			<div class="progress-br float shadow">
				<div class="progress__item"></div>
			</div>
		</div>
	</div>
	<!-- END LOADER -->	
	
	<!-- Start header -->
	<header class="top-navbar sticky-top">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid">
				<a class="navbar-brand" href="index.php">
					<img src="images/log.jpg" alt="" />
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-host" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
					<span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbars-host">
					<ul class="navbar-nav ml-auto">
						<!-- <li class="nav-item active"><a class="nav-link fs-4" href="../ty.php">Sign Up</a></li> -->
						<ul class="nav navbar-nav navbar-right sticky-top">
                        <li class="nav-item active">
							<!-- <a class="hover-btn-new log orange" href="#" data-toggle="modal" data-target="#login">
							<span class="fs-4" style="font-family:Noto Sans Lao, sans-serif;">ສຳລັບນັກຮຽນໃຫມ່</span> 
						 </a> -->
						<li class="nav-item"><a class="nav-link fs-4" style="font-family:Noto Sans Lao, sans-serif;" href="ty.php">ສຳລັບນັກຮຽນໃຫມ່</a></li>
						<!-- <a href="ty.php" class="nav-link fs-4">ສຳລັບນັກຮຽນໃຫມ່</a> -->
					</li>
					<li class="nav-item"><a class="nav-link fs-4" style="font-family:Noto Sans Lao, sans-serif;" href="apply/register.php">ເລື่ອນຊັ້ນ</a></li>
						<!-- <li class="nav-item active"><a class="nav-link fs-4" style="font-family:Noto Sans Lao, sans-serif;"" href="apply/register.php">ເລືອນຊັ້ນ</a></li> -->
                    </ul>
						<li class="nav-item"><a class="nav-link fs-4" style="font-family:Noto Sans Lao, sans-serif;" href="user/login.php">Dashboard ຂອງນັກຮຽນ</a></li>
						<li class="nav-item"><a class="nav-link fs-4" style="font-family:Noto Sans Lao, sans-serif;" target="_blank" href="admin/login.php">login</a></li>
						
					</ul>
					
				</div>
			</div>
		</nav>
	</header>
	<!-- End header -->
	
	<div id="carouselExampleControls" class="carousel slide bs-slider box-slider" data-ride="carousel" data-pause="hover" data-interval="false" >
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleControls" data-slide-to="1"></li>
			<li data-target="#carouselExampleControls" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner" role="listbox">
			<div class="carousel-item active">
				<div id="home" class="first-section" style="background-image:url('images/sch1.jpg');">
					<div class="dtab">
						<div class="container">
							<div class="row">
								<div class="col-md-12 col-sm-12 text-right">
									<div class="big-tagline" style="font-family:Noto Sans Lao, sans-serif;">
										<h2><strong>Nonsart </strong>Secondary School, ຄູອາຈານ</h2>
	<p class="lead fs-3">ຄູແມ່ນຜູ້ທີ່ນໍາສະເຫນີຄວາມຮູ້ແລະທັກສະໃຫ້ແກ່ນັກຮຽນ, ໂດຍທົ່ວໄປໃນສະພາບແວດລ້ອມການສຶກສາ. ຄູອາຈານມີບົດບາດສໍາຄັນໃນການສຶກສາແລະການພັດທະນາຂອງນັກຮຽນ. ນໍາ​ທິດ​ໃນ​ການ​ຮຽນ​ຮູ້​,. </p>
											<a target="_blank" href="https://www.facebook.com/NSA.xxy" class="hover-btn-new fs-4"><span>ຕິດຕໍ່ທາງໂຮງຮຽນ</span></a>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<a href="read.php" class="hover-btn-new fs-4"><span>ອ່ານເພີ່ມ</span></a>
									</div>
								</div>
							</div><!-- end row -->            
						</div><!-- end container -->
					</div>
				</div><!-- end section -->
			</div>
			<div class="carousel-item">
				<div id="home" class="first-section" style="background-image:url('images/sch2.jpg');">
					<div class="dtab">
						<div class="container">
							<div class="row">
								<div class="col-md-12 col-sm-12 text-left">
									<div class="big-tagline" style="font-family:Noto Sans Lao, sans-serif;">
										<h2 data-animation="animated zoomInRight">Nonsart <strong>Secondary School, >ນັກຮຽນ:</strong></h2>
										<p class="lead fs-3" data-animation="animated fadeInLeft">ນັກຮຽນແມ່ນຜູ້ທີ່ຮຽນຮູ້ ແລະຖືກສອນ, ໂດຍປົກກະຕິໃນສະພາບແວດລ້ອມຂອງການສຶກສາ. 
										ນັກຮຽນ​ພະຍາຍາມ​ທີ່​ຈະ​ໄດ້​ມາ​ທັງ​ດ້ານ​ວິຊາ​ການ ​ແລະ ຄວາມ​ຮູ້​ທົ່ວ​ໄປ ​ແລະ ທັກ​ສະ. ນັກຮຽນມີບົດບາດໃນການກະຕຸ້ນຕົນເອງໃນການຮຽນຮູ້ ແລະ ພັດທະນາທັກສະໃນເວລາຮຽນຢູ່ໂຮງຮຽນ. 
										ນັກຮຽນມັກຈະມີຄວາມຕ້ອງການການຮຽນຮູ້ແລະການພັດທະນາສ່ວນບຸກຄົນທີ່ສືບຕໍ່ໃນໄລຍະເວລາຂອງການສຶກສາຂອງເຂົາເຈົ້າ.. </p>
											<a target="_blank" href="https://www.facebook.com/NSA.xxy" class="hover-btn-new fs-4"><span> ຕິດຕໍ່ທາງໂຮງຮຽນ </span></a>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<a href="read.php" class="hover-btn-new fs-4"><span> ອ່ານເພີ່ມ </span></a>
									</div>
								</div>
							</div><!-- end row -->            
						</div><!-- end container -->
					</div>
				</div><!-- end section -->
			</div>
			<div class="carousel-item">
				<div id="home" class="first-section" style="background-image:url('images/sch.jpg');">
					<div class="dtab">
						<div class="container">
							<div class="row">
								<div class="col-md-12 col-sm-12 text-center">
									<div class="big-tagline" style="font-family:Noto Sans Lao, sans-serif;">
										<h2 data-animation="animated zoomInRight"><strong>Nonsart </strong>Secondary School, ໂຮງຮຽນ</h2>
										<p class="lead fs-3" data-animation="animated fadeInLeft">ໂຮງຮຽນແມ່ນສະຖານທີ່ການສຶກສາທີ່ສ້າງຕັ້ງຂຶ້ນເພື່ອການຮຽນຮູ້ແລະການສິດສອນ. 
										ໂດຍ​ທົ່ວ​ໄປ​ແລ້ວ​ມີ​ໂຄງ​ປະ​ກອບ​ການ​ສຶກ​ສາ​ແລະ​ຄະ​ນະ​ກໍາ​ມະ​ທີ່​ເບິ່ງ​ແຍງ​ມັນ​. ໂຮງຮຽນມັກຈະມີການສຶກສາຫຼາຍລະດັບ, ເລີ່ມແຕ່ປະຖົມເຖິງມັດທະຍົມ ແລະ ບາງເທື່ອຊັ້ນມັດທະຍົມ, 
										ນອກຈາກນັ້ນ, ໂຮງຮຽນມັກຈະມີບົດບາດສຳຄັນໃນການສົ່ງເສີມການພັດທະນາທາງດ້ານສັງຄົມ ແລະ ຈິດໃຈຂອງນັກຮຽນ. ໂຮງຮຽນສາມາດເປັນທັງພາກລັດ ແລະ ເອກະຊົນ, 
										ແລະມີລັກສະນະວັດທະນະທໍາ ແລະ ວັດທະນະທໍາທີ່ແຕກຕ່າງກັນໃນທົ່ວທຸກປະເພດ.</p>
											<a target="_blank" href="https://www.facebook.com/NSA.xxy" class="hover-btn-new fs-4"><span> ຕິດຕໍ່ທາງໂຮງຮຽນ </span></a>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<a href="read.php" class="hover-btn-new fs-4"><span> ອ່ານເພີ່ມ </span></a>
									</div>
								</div>
							</div><!-- end row -->            
						</div><!-- end container -->
					</div>
				</div><!-- end section -->
			</div>
			<!-- Left Control -->
			<a class="new-effect carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
				<span class="fa fa-angle-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>

			<!-- Right Control -->
			<a class="new-effect carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
				<span class="fa fa-angle-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
	
    <div id="overviews" class="section wb">
        <div class="container" style="font-family:Noto Sans Lao, sans-serif;">
            <div class="section-title row text-center">
                <div class="col-md-8 offset-md-2">
                    <h3> ກ้ຽວກັບໂຮງຮຽນ </h3>
                    <p align="justify" class="lead style1 fs-3">ໂຮງຮຽນມັດທະຍົມສົມບູນໂນນສະອາດ ຕັ້ງຢູ່ ບ້ານໂນນສະອາດ, ເມືອງໄຊທານີ, ນະຄອນຫຼວງວຽງຈັນ ສ້າງຕັ້ງຂຶ້ນໃນວັນທີ 23 ມີຖຸນາ ປີ 1998 
						ເປັນໂຮງຮຽນຂະໜາດໃຫຍ່ເຊິ່ງ ມີຄູ-ອາຈານຈຳນວນ 89 ທ່ານ, ມີນັກຮຽນ 1458 ຄົນ, ມີອາຄາທັງໝົດ 8 ຫຼັງ, ມີຫ້ອງນໍ້າ 23 ຫ້ອງ, ມີຫໍສະມຸດສໍາລັບໄວ້ໃຫ້ນັກຮຽນໄດ້ຄົ້ນຄວ້າອ່ານໜັງສື 
						ແລະ ຊອກຫາຂ້ໍມູນຕ່າງໆຈາກປື້ມໃນຫໍສະໝຸດ ນອກຈາກນັ້ນ ຍັງມີຮ້ານຄ້າຂະໜາດກາງອີກດ້ວຍ. ທ່ານ ບຸນນຳ ໂພຄະສົມບັດ ແມ່ນໄດ້ເປັນຄົນກ່ໍຕັ້ງໂຮງຮຽນມັດທະຍົມສົມບູນໂນນສະອາດ ປະຈຸດບັນແມ່ນ ທ່ານ ອາຈານ ທອງຄຳ ສົມສະນິດ ເປັນຜູ້ອໍານວຍການໂຮງຮຽນ.
            ໂຮງຮຽນມັດທະຍົມສົມບູນໂນນສະອາດ ຍັງໄດ້ມີສ່ວນຫຼຸດໃນການລົງທະບຽນໃຫ້ກັບຄົນທີ່ເປັນອ້າຍເອື້ອຍນ້ອງ ຫຼື ຍາດພີ່ນ້ອງທີ່ໃຊ້ນາມສະກຸນດຽວກັນຄື:
			 ນັກຮຽນ 3 ຄົນທີ່ສຶກສາໃນໂຮງຮຽນເຊິ່ງມີນາມສະກຸນຄືກັນໃຫ້ຈ່າຍຄ່າຮຽນພຽງ 2 ຄົນເທົ່ານັ້ນ. ສະນັ້ນ ໃນປະຈຸບັນຖືວ່າເຕັກໂນໂລຊີແມ່ນມີບົດບາດສໍາຄັນຫຼາຍໃນການເຮັດວຽກຕ່າງໆ 
			 ເພາະຈະຊ່ວຍໃນການຈັດການກັບວຽກງານນັ້ນມີປະສິດທິພາບຫຼາຍຂື້ນ</p>
                </div>
            </div><!-- end title -->
        
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="message-box fs-3">
                        <h4 style="font-size:2rem"> ໂຮງຮຽນ ມັດທະຍົມສົມູນ ໂນນສະອາດ </h4>
                        <h2> ຍິນດີຕອນຮັບເຂົ້າສູ່ ລະບົບລົງທະບຽນ ອອນລາຍ ຂອງ ໂຮງຮຽນ ມັດທະຍົມສົມບູນ ໂນນສະອາດ </h2>
                        <p>&nbsp;</p>

                        <a href="read.php" class="hover-btn-new orange fs-4"><span> ອ່ານເພີ່ມ </span></a>
                    </div><!-- end messagebox -->
                </div><!-- end col -->
				
				<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="post-media wow fadeIn">
                        <img src="images/std.jpg" alt="" width="530" height="420" class="img-fluid img-rounded">                    </div>
                    <!-- end media -->
                </div><!-- end col -->
			</div>
		  <div class="row align-items-center">
				<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="post-media wow fadeIn"></div>
                    <!-- end media -->
                </div><!-- end col -->
              <!-- end col -->
            </div>
			<!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->
    <!-- end section -->
    <!-- end section -->
    <!-- end section -->
    <!-- end section -->
<footer class="footer">
        <div class="container">
            <div class="row">
              <!-- end col -->
              <!-- end col -->
              <!-- end col -->
</div>
            <!-- end row -->
        </div><!-- end container -->
</footer><!-- end footer -->

    <?php
	
	include('footer.php');
	?>

    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

    <!-- ALL JS FILES -->
    <script src="js/all.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/custom.js"></script>
	<script src="js/timeline.min.js"></script>
	<script>
		timeline(document.querySelectorAll('.timeline'), {
			forceVerticalMode: 700,
			mode: 'horizontal',
			verticalStartPosition: 'left',
			visibleItems: 4
		});
	</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
	integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>