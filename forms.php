<?php
session_start();
error_reporting(0);

// Include database connection
include('connect.php');

// Check if the form is submitted
if(isset($_POST['btnsubmit'])) {
    // Retrieve and sanitize form inputs
    $pin = mysqli_real_escape_string($conn, $_POST['txtpin']);
    $serial = mysqli_real_escape_string($conn, $_POST['txtserial']);

    // SQL query to check if the scratchcard details are valid
    $sql = "SELECT * FROM scratchcard WHERE pin=? AND serial=? AND status='0'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $pin, $serial);
    $stmt->execute();
    $result = $stmt->get_result();

    // If valid scratchcard details are found, redirect to admission page
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["serial"] = $row['serial'];
        header("Location: apply/admis.php");
        exit;
    } else { 
        $error_message = "Invalid Scratch Card Details or Already Used";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      
        *{
            font-family:Noto Sans Lao, sans-serif;
        }
        p{
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title text-center fs-2">Login</h3>
                </div>
                <p class="text-center text-warning mt-2">ກະລຸນາປ້ອນຊື່ ແລະ ລະຫັດຂອງນັກຮຽນ</p>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="txtpin" class="form-label fs-3"><b>ຊຶ່</b></label>
                            <input type="text" class="form-control" id="txtpin" name="txtpin" required>
                        </div>
                        <div class="mb-3">
                            <label for="txtserial" class="form-label fs-3"><b>ລະຫັດ</b></label>
                            <input type="text" class="form-control" id="txtserial" name="txtserial" required>
                        </div>
                        <?php if(isset($error_message)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error_message; ?>
                            </div>
                        <?php unset($error_message); } ?>
                        <button type="submit" name="btnsubmit" class="btn btn-primary p-3">Login</button>
                        <a href="index.php" class="btn btn-lg btn-warning p-3">ເຂົ້າໄປສູ່ຫນ້າຫຼັກ</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
