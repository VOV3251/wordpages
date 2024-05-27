<?php
include 'db.php';

// Handling POST request to insert transaction data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $fullname = $_POST['fullname'];
    $room_name = $_POST['room'];
    $guardian = $_POST['guardian']; // Added guardian field
    $class = $_POST['class']; // Added class field
    $date = date('Y-m-d'); // Current date
    $total_amount = $_POST['total_amount']; // Added total_amount field

    // Check if there are any previous transactions for the selected guardian
    $sql_check = "SELECT COUNT(*) AS count FROM transactions WHERE guardian = '$guardian'";
    $result_check = mysqli_query($conn, $sql_check);
    $row_check = mysqli_fetch_assoc($result_check);
    $count = $row_check['count'];

    // If there are previous transactions and they are not three, proceed with payment
    if ($count < 3) {
        // SQL query to insert data into transactions table
        $sql = "INSERT INTO transactions (fullname, room, guardian, date, class, total_amount) VALUES ('$fullname', '$room_name', '$guardian', '$date', '$class', '$total_amount')";

        if ($conn->query($sql) === TRUE) {
            echo "Record added successfully";
            header("Location: playmentt.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // If there are three previous transactions for the guardian, display a message indicating that no payment is required
        $message = "You have three cousins, no payment required.";
        header("Location: process.php?message=" . urlencode($message));
        exit();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="shortcut icon" href="images/log.jpg" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/log.jpg">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="../../style.css">
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
            font-family: "Noto Sans Lao", sans-serif;
        }
        ul li{
            font-size:16px;
        }
    </style>
</head>
<body>
	<!-- Start header -->
	<header class="top-navbar sticky-top">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid">
				<a class="navbar-brand" href="../../index.php">
					<img src="../../images/log.jpg" alt="" />
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
						<li class="nav-item"><a class="nav-link fs-4" style="font-family:Noto Sans Lao, sans-serif;" href="../../ty.php">ສຳລັບນັກຮຽນໃຫມ່</a></li>
						<!-- <a href="ty.php" class="nav-link fs-4">ສຳລັບນັກຮຽນໃຫມ່</a> -->
					</li>
					<li class="nav-item"><a class="nav-link fs-4" style="font-family:Noto Sans Lao, sans-serif;" href="../../apply/register.php">ເລື่ອນຊັ້ນ</a></li>
						<!-- <li class="nav-item active"><a class="nav-link fs-4" style="font-family:Noto Sans Lao, sans-serif;"" href="apply/register.php">ເລືອນຊັ້ນ</a></li> -->
                    </ul>
						<li class="nav-item"><a class="nav-link fs-4" style="font-family:Noto Sans Lao, sans-serif;" href="../../user/login.php">Dashboard ຂອງນັກຮຽນ</a></li>
						<!-- <li class="nav-item"><a class="nav-link fs-4" style="font-family:Noto Sans Lao, sans-serif;" target="_blank" href="../login.php">Admin</a></li> -->
						
					</ul>
					
				</div>
			</div>
		</nav>
	</header>
	<!-- End header -->
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-info">
                <h2>Payment</h2>
            </div>
            <div class="card-body">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="form-group">
                        <label for="fullname"><h4>ຊື ແລະນາມສະກຸນ:</h4></label>
                        <select class="form-control" id="fullname" name="fullname" onchange="fetchDetails()" required>
                            <option value="">Select Fullname</option>
                            <?php
                            // Fetch names, room, guardian, and ssce_details from the admission table
                            $sql_names = "SELECT fullname, room, faculty, ssce_details FROM admission";
                            $result_names = mysqli_query($conn, $sql_names);
                            while ($row = mysqli_fetch_assoc($result_names)) {
                                echo "<option value='" . $row['fullname'] . "' data-room='" . $row['room'] . "' data-guardian='" . $row['faculty'] . "' data-class='" . $row['ssce_details'] . "'>" . $row['fullname'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="class"><h4>ຊັ້ນຮຽນ:</h4></label>
                        <input type="text" class="form-control" id="class" name="class" readonly>
                    </div>

                    <div class="form-group">
                        <label for="room"><h4>ຫ້ອງ:</h4></label>
                        <input type="text" class="form-control" id="room" name="room" readonly>
                    </div>
                    <div class="form-group">
                        <label for="guardian"><h4>ຜູ້ປົກຄ້ອງ:</h4></label>
                        <input type="text" class="form-control" id="guardian" name="guardian" readonly>
                    </div>

                    <!-- Display calculated total amount -->
                    <div class="form-group">
                        <label for="total_amount"><h4>ຄ່າຮຽນໝົດປີ:</h4></label>
                        <input type="text" class="form-control" id="total_amount" name="total_amount" readonly>
                    </div>
                    
                    <!-- Date field -->
                    <div class="form-group">
                        <label for="date"><h4>Date:</h4></label>
                        <input type="text" class="form-control" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" readonly>
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary mt-3 text-dark">ໄປທີ່ຫນ້າຈ່າຍເງີນ</button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>

function fetchDetails() {
    var selectedOption = document.getElementById('fullname').options[document.getElementById('fullname').selectedIndex];
    var room = selectedOption.getAttribute('data-room');
    var guardian = selectedOption.getAttribute('data-guardian');
    var classVal = selectedOption.getAttribute('data-class');
    var totalAmount = 250000; // You can adjust this value as needed
    
    // Display calculated total amount
    document.getElementById('room').value = room;
    document.getElementById('class').value = classVal;
    document.getElementById('guardian').value = guardian;
    document.getElementById('total_amount').value = totalAmount;
}

    </script>
</body>
</html>
