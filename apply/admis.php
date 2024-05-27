<?php
session_start();
error_reporting(1);
include('../connect.php');

mysqli_set_charset($conn, "utf8");
date_default_timezone_set('Africa/Lagos');

if (isset($_POST["btnsubmit"])) {
    function applicationID()
    {
        $string = uniqid(rand(), true);
        return substr($string, 0, 5);
    }

    $applicationID = "NSA/" . date("Y") . "/" . applicationID();

    $fullname = mysqli_real_escape_string($conn, $_POST['txtfullname']);
    $sex = mysqli_real_escape_string($conn, $_POST['cmdsex']);
    $phone = mysqli_real_escape_string($conn, $_POST['txtphone']);
    $email = mysqli_real_escape_string($conn, $_POST['txtemail']);
    $lga = mysqli_real_escape_string($conn, $_POST['txtlga']);
    $state = mysqli_real_escape_string($conn, $_POST['txtstate']);
    $jambno = mysqli_real_escape_string($conn, $_POST['txtjambno']);
    $jambscore = mysqli_real_escape_string($conn, $_POST['txtjambscore']);
    $faculty = mysqli_real_escape_string($conn, $_POST['txtfaculty']);
    $dept = mysqli_real_escape_string($conn, $_POST['txtdept']);
    $photo = 'upload/default.jpg';
    $credential = 'upload/Result-Report-card-software.png';
    $status = '0';

    $sql_u = "SELECT * FROM admission WHERE email='$email'";
    $res_u = mysqli_query($conn, $sql_u);
    if (mysqli_num_rows($res_u) > 0) {
        $msg_error = "ຈີເມວນີ້ມີຄົນໃຊ້ແລ້ວ";
    } else {
        $sql = "INSERT INTO admission (fullname, sex, phone, email, lga, state, jamb_number, jamb_score, faculty, dept, ssce, status, photo, date_admission, applicationID) VALUES ('$fullname', '$sex', '$phone', '$email', '$lga', '$state', '$jambno', '$jambscore', '$faculty', '$dept', '$credential', '$status', '$photo', '" . date('Y-m-d') . "', '$applicationID')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['email'] = $email;
            $_SESSION['fullname'] = $fullname;
            $_SESSION['ApplicationID'] = $applicationID;
            header("Location: upload.php");
            exit();
        } else {
?>
            <script>
                alert('Problem Occurred, Try Again');
            </script>
<?php
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/log.jpg" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/log.jpg">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="../style.css">
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="css/versions.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!-- Modernizer for Portfolio -->
    <script src="js/modernizer.js"></script>
    <style>
        * {
            font-family: Noto Sans Lao, sans-serif;
        }

        /* Custom styles */
        .form-label {
            font-weight: bold;
            margin-bottom: 8px;
            /* Increase the spacing between label and input */
        }

        label {
            font-size: 18px;
        }

        h5 {
            font-size: 20px;
        }

        .container {
            max-width: 1500px; /* Adjust the maximum width of the container */
        }
        .card {
            border: 1px solid #ccc; /* Add border */
            border-radius: 10px; /* Add border-radius for rounded corners */
            box-shadow: 0 4px 8px rgba(2, 0, 0, 1.5); /* Add shadow */
        }
        .card-header {
            background-color: #007bff; /* Change header background color */
            color: #fff; /* Change header text color */
            border-bottom: none; /* Remove bottom border from header */
            border-radius: 10px 10px 0 0; /* Add border-radius for rounded corners */
        }
        .card-body {
            padding: 35px; /* Add padding to the card body */
        }

        .form-control {
            width: 100%; /* Make the form controls full width */
        }
    </style>
</head>

<body>

	<!-- Start header -->
	<header class="top-navbar sticky-top">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid">
				<a class="navbar-brand" href="../index.php">
					<img src="../images/log.jpg" alt="" />
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
						<li class="nav-item"><a class="nav-link fs-4" style="font-family:Noto Sans Lao, sans-serif;" href="../ty.php">ສຳລັບນັກຮຽນໃຫມ່</a></li>
						<!-- <a href="ty.php" class="nav-link fs-4">ສຳລັບນັກຮຽນໃຫມ່</a> -->
					</li>
					<li class="nav-item"><a class="nav-link fs-4" style="font-family:Noto Sans Lao, sans-serif;" href="register.php">ເລື่ອນຊັ້ນ</a></li>
						<!-- <li class="nav-item active"><a class="nav-link fs-4" style="font-family:Noto Sans Lao, sans-serif;"" href="apply/register.php">ເລືອນຊັ້ນ</a></li> -->
                    </ul>
						<li class="nav-item"><a class="nav-link fs-4" style="font-family:Noto Sans Lao, sans-serif;" href="../user/login.php">Dashboard ຂອງນັກຮຽນ</a></li>
						<!-- <li class="nav-item"><a class="nav-link fs-4" style="font-family:Noto Sans Lao, sans-serif;" target="_blank" href="../admin/login.php">Admin</a></li>
						 -->
					</ul>
					
				</div>
			</div>
		</nav>
	</header>
	<!-- End header -->
	

<!-- <div class="container mt-2">
  <div class="page-header text-center">
    <h1><img src="../images/log.jpg" alt="Daily Earnings" width="200" height="140"><span class="style1"></span></h1>
  </div>
</div> -->


    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8"> <!-- Increased width to col-md-8 -->
                <div class="card">
                <div class="card-header bg-info text-white">
                        <h2 class="text-center">Admission Form</h2>
                    </div>
                    <div class="card-body">
                        <!-- <div class="bg-info fs-2">
                            <h5 class="card-title text-center text-warning"></h5>
                        </div> -->

                        <form class="form-horizontal contactform" action="" method="post" name="f">
                            <div class="form-group">
                                <label class="col-lg-12 form-label" for="pass1">ຊື້ ແລະນາມສະກຸນ:</label>
                                <input type="text" id="pass1" class="form-control" name="txtfullname" value="<?php if (isset($_POST['txtfullname'])) echo $_POST['txtfullname']; ?>" required="">
                            </div>
                            <!-- Add more form fields here -->
                            <div class="form-group">
                                <label class="col-lg-12 form-label" for="gender">ເພດ:</label>
                                <select name="cmdsex" id="gender" class="form-control" required="">
                                    <option value="">--ເລືອກ ເພດ--</option>
                                    <option value="Male">ຊາຍ</option>
                                    <option value="Female">ຍິງ</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-12 form-label" for="pass1">ວັນເດືອນປີເກີດ:</label>
                                <input type="text" id="pass1" class="form-control" name="txtjambno" value="<?php if (isset($_POST['txtjambno'])) echo $_POST['txtjambno']; ?>" required="">
                            </div>
                            <div class="form-group">
                                <label class="col-lg-12 form-label" for="pass1">ເບີໂທ:</label>
                                <input type="text" id="pass1" class="form-control" name="txtphone" value="<?php if (isset($_POST['txtphone'])) echo $_POST['txtphone']; ?>" required="">
                            </div>
                            <div class="form-group">
                                <label class="col-lg-12 form-label" for="uemail">ຈີເມວ:</label>
                                <input type="email" name="txtemail" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="<?php if (isset($_POST['txtemail'])) echo $_POST['txtemail']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-12 form-label" for="pass1">ບາ້ນ:</label>
                                <input type="text" id="pass1" class="form-control" name="txtdept" value="<?php if (isset($_POST['txtdept'])) echo $_POST['txtdept']; ?>" required="">
                            </div>
                            <div class="form-group">
                                <label class="col-lg-12 form-label" for="pass1">ເມື່ອງ :</label>
                                <input type="text" id="pass1" class="form-control" name="txtlga" value="<?php if (isset($_POST['txtlga'])) echo $_POST['txtlga']; ?> " required="">
                            </div>
                            <div class="form-group">
                                <label class="col-lg-12 form-label" for="pass1">ແຂວງ:</label>
                                <input type="text" id="pass1" class="form-control" name="txtstate" value="<?php if (isset($_POST['txtstate'])) echo $_POST['txtstate']; ?>" required="">
                            </div>
                            <div class="form-group">
                                <label class="col-lg-12 form-label" for="pass1">ຊື່ຜູ້ປົກຄ້ອງ:</label>
                                <input type="text" id="pass1" class="form-control" name="txtfaculty" value="<?php if (isset($_POST['txtfaculty'])) echo $_POST['txtfaculty']; ?>" required="">
                            </div>
                            <div class="form-group">
                                <label class="col-lg-12 form-label" for="pass1">ເບີຕິດຕໍ່ຜູ້ປົກຄອງ :</label>
                                <input type="text" id="pass1" class="form-control" name="txtjambscore" value="<?php if (isset($_POST['txtjambscore'])) echo $_POST['txtjambscore']; ?>" required="">
                            </div>
                            <!-- Add more form fields here -->
                            <div style="height: 10px;clear: both"></div>
                            <div class="form-group">
                                <div class="col-lg-10">
                                    <button class="btn btn-lg fs-3 btn-primary" type="submit" name="btnsubmit">Submit</button>
                                </div>
                            </div>
                        </form>
                        <!-- Insert the error message display section here -->
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php if(isset($msg_error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $msg_error; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

