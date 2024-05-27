<?php
session_start();
error_reporting(0);
include('../../connect.php');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Prepare and execute SQL statement to insert data into admin table
    $sql = "INSERT INTO admin (username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "New admin record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch usernames from teacher table
$sql_teacher = "SELECT name FROM teacher";
$result_teacher = $conn->query($sql_teacher);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Add Admin</h2>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <select class="form-control" id="username" name="username" required>
                                    <option value="">Select Username</option>
                                    <?php
                                    if ($result_teacher->num_rows > 0) {
                                        while($row_teacher = $result_teacher->fetch_assoc()) {
                                            echo "<option value='".$row_teacher['name']."'>".$row_teacher['name']."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
