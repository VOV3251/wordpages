<?php
// Include database connection
include('../connect.php');

mysqli_set_charset($conn, "utf8mb4");

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $date = $_POST['date'];
    $name = $_POST['name'];
    $village = $_POST['village'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $class = $_POST['class'];
    $room = $_POST['room'];

    // Fetch additional data from admission table based on selected name
    $selected_name = mysqli_real_escape_string($conn, $_POST['name']);
    $sql_admission = "SELECT faculty, jamb_score FROM admission WHERE fullname='$selected_name'";
    $result_admission = mysqli_query($conn, $sql_admission);
    $row_admission = mysqli_fetch_assoc($result_admission);
    $guardian = $row_admission['faculty'];
    $phone = $row_admission['jamb_score'];

    // Check if the room has available capacity
    $sql_room = "SELECT capacity, current_occupancy FROM room WHERE room_name='$room'";
    $result_room = mysqli_query($conn, $sql_room);
    $row_room = mysqli_fetch_assoc($result_room);

    if ($row_room['current_occupancy'] < $row_room['capacity']) {
        // Increment the current occupancy
        $new_occupancy = $row_room['current_occupancy'] + 1;

        // Insert data into register table
        $sql_register = "INSERT INTO register (date, name, village, city, province, re_class, re_room, guardian, phone) 
                        VALUES ('$date', '$name', '$village', '$city', '$province', '$class', '$room', '$guardian', '$phone')";
        
        if (mysqli_query($conn, $sql_register)) {
            // Update the current occupancy in the room table
            $sql_update_room = "UPDATE room SET current_occupancy='$new_occupancy' WHERE room_name='$room'";
            mysqli_query($conn, $sql_update_room);

            echo "<script>alert('Registration successful');</script>";
            header("Location: ../admin/playment/plays.php");
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }

        // Update admission table with ssce_details and room
        $fullname = mysqli_real_escape_string($conn, $_POST['name']);
        $class = mysqli_real_escape_string($conn, $_POST['class']);
        $room = mysqli_real_escape_string($conn, $_POST['room']);

        $sql_update_admission = "UPDATE admission SET ssce_details='$class', room='$room' WHERE fullname='$fullname'";

        if (mysqli_query($conn, $sql_update_admission)) {
            // Set success message or perform other actions if needed
            $msg_success = "Admission details updated successfully";
        } else {
            // Set error message if update fails
            $msg_error = "Error updating admission details: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('The selected room is at full capacity. Please choose another room.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Form</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    *{
        font-family:Noto Sans Lao, sans-serif;
    }
    .form-control {
        font-size: 16px;
        font-weight: bold; /* Make the text thicker */
    }
    .card {
        font-size: 18px;
    }
    /* Darken the label text color */
    label {
        color: #000;
        font-weight: bold; /* Make the label text thicker */
    }
    .btn{
        font-weight: bold;
    }
    .navbar-brand,
    .navbar-nav > li > a {
     font-size: 20px; /* Adjust the font size as needed */
    }
</style>

<style type="text/css">
    body {
        font-family: "Noto Sans Lao", sans-serif;
    }
</style>
</head>
<body>

    <!-- LOADER -->
	<!-- <div id="preloader">
		<div class="loader-container">
			<div class="progress-br float shadow">
				<div class="progress__item"></div>
			</div>
		</div>
	</div> -->
	<!-- END LOADER -->	
	
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
    
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="text-center">Registration Form</h2>
                </div>
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Date:</label>
                            <input type="text" name="date" class="form-control" id="currentDate" readonly>
                        </div>
                        <div class="form-group">
                            <label>ຊື່ແລະນາມສະກຸນ:</label>
                            <select name="name" id="name" class="form-control" required>
                                <option value="">Select Name</option>
                                <?php
                                // Fetch names and departments from admission table
                                $sql_names = "SELECT fullname, dept, lga, faculty, jamb_score, state FROM admission";
                                $result_names = mysqli_query($conn, $sql_names);
                                while ($row = mysqli_fetch_assoc($result_names)) {
                                    echo "<option value='" . $row['fullname'] . "' data-dept='" . $row['dept'] . "' data-city='" . $row['lga'] .  "' data-province='" . $row['state'] . "' data-guardian='" . $row['faculty'] . "' data-phone='" . $row['jamb_score'] . "'>" . $row['fullname'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>ບ້ານ:</label>
                            <input type="text" name="village" id="village" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>ເມື່ອງ:</label>
                            <input type="text" name="city" id="city" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>ແຂວງ:</label>
                            <input type="text" name="province" id="province" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="faculty">ຜູ້ປົກຄ້ອງ:</label>
                            <input type="text" name="faculty" id="faculty" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="jamb_score">ເບີຕິດຕໍ່ຜູ້ປົກຄອງ:</label>
                            <input type="text" name="jamb_score" id="jamb_score" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>ຊັ້ນຮຽນ:</label>
                            <select name="class" class="form-control" required>
                                <option value="">Select Class</option>
                                <?php
                                // Fetch class names from class table excluding "end" class
                                $sql_classes = "SELECT name FROM class WHERE name != 'end'";
                                $result_classes = mysqli_query($conn, $sql_classes);
                                while ($row = mysqli_fetch_assoc($result_classes)) {
                                    echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>ຫ້ອງ:</label>
                            <select name="room" class="form-control" required>
                                <option value="">Select Room</option>
                                <?php
                                // Fetch room names from room table
                                $sql_rooms = "SELECT room_name, capacity, current_occupancy FROM room";
                                $result_rooms = mysqli_query($conn, $sql_rooms);
                                while ($row = mysqli_fetch_assoc($result_rooms)) {
                                    $disabled = ($row['current_occupancy'] >= $row['capacity']) ? "disabled" : "";
                                    $full_text = ($row['current_occupancy'] >= $row['capacity']) ? " (ເຕັມ)" : "";
                                    echo "<option value='" . $row['room_name'] . "' $disabled>" . $row['room_name'] . $full_text . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" name="btnsubmit" class="btn btn-primary p-3">Submit</button>
                        <a href="../index.php" class="btn btn-lg btn-warning p-3">ເຂົ້າໄປສູ່ຫນ້າຫຼັກ</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Function to populate fields based on selected name
document.getElementById('name').addEventListener('change', function() {
    var name = this.value;
    var dept = this.options[this.selectedIndex].getAttribute('data-dept');
    var city = this.options[this.selectedIndex].getAttribute('data-city');
    var province = this.options[this.selectedIndex].getAttribute('data-province');
    var guardian = this.options[this.selectedIndex].getAttribute('data-guardian');
    var phone = this.options[this.selectedIndex].getAttribute('data-phone');
    
    document.getElementById('village').value = dept;
    document.getElementById('city').value = city;
    document.getElementById('province').value = province;
    document.getElementById('faculty').value = guardian; // Updated
    document.getElementById('jamb_score').value = phone; // Updated
});

window.onload = function() {
    var currentDate = new Date().toISOString().slice(0, 10);
    document.getElementById('currentDate').value = currentDate;
};
</script>
</body>
</html>
