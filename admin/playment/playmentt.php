<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online-admission";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['seedImage']) && isset($_FILES['seedImage']['name']) && !empty($_FILES['seedImage']['name'])) {
        $uploadDir = 'uploads/';

        // Create the 'uploads' directory if it doesn't exist
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true); // You may need to adjust the permission based on your server configuration
        }

        $uploadFile = $uploadDir . basename($_FILES['seedImage']['name']);

        // Check if the file is an image
        $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
        if (!in_array($imageFileType, $allowedExtensions)) {
            $uploadError = 'Invalid file format. Only JPG, JPEG, PNG, and GIF files are allowed.';
        } else {
            if (move_uploaded_file($_FILES['seedImage']['tmp_name'], $uploadFile)) {
                $uploadSuccess = 'File uploaded successfully.';
                
                // Save image details to the database
                $filename = $_FILES['seedImage']['name'];
                $filepath = $uploadFile;
                
                // Insert into the database
                $sql = "INSERT INTO images (filename, filepath) VALUES ('$filename', '$filepath')";
                if ($conn->query($sql) === FALSE) {
                    $uploadError = 'Error uploading file to the database: ' . $conn->error;
                }
            
                // Redirect to another page after successful upload and database insertion
                header("Location: process.php");
                exit();
            } else {
                $uploadError = 'Error uploading file.';
            }
        }
    } else {
        $uploadError = 'Please select an image file.';
    }
}

// Handle image deletion
if (isset($_POST['deleteImage'])) {
    $imageIdToDelete = $_POST['deleteImage'];
    $sqlDeleteImage = "DELETE FROM images WHERE id = $imageIdToDelete";

    if ($conn->query($sqlDeleteImage) === FALSE) {
        $deleteError = 'Error deleting image from the database: ' . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="shortcut icon" href="images/log.jpg" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/log.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        *{
            font-family:Noto Sans Lao, sans-serif;
        }
    </style>
</head>
<body>
    <h1>ເລືອກຮູບທີ່ຈະອັບໂຫລດເພື່ອຈ່າຍເງິນ</h1>
    <img src="play.jpg" alt="Payment Image">
    <br><br>
    <a href="../../index.php"><h4>ກັບໄປຫນ້າລັກ</h4></a>
    <a href="file.php"><button class="btn btn-lg btn-primary p-2" style="font-family:Noto Sans Lao, sans-serif;">ອັບໂຫຼດໃບຮັບເງິນ</button></a>
    <hr>
    <h1>ຫຼັງຈາກຊໍາລະແລ້ວ, ກະລຸນາຢືນຢັນການສຳລຳຢູ່ທີ່ນີ້ໂດຍການອັບໂຫລດໃບຮັບເງິນ.</h1>
    <h3>Please select the student's application below </h3>

    <?php
    // Display success or error messages
    if (isset($uploadSuccess)) {
        echo '<div style="color: green;">' . $uploadSuccess . '</div>';
    } elseif (isset($uploadError)) {
        echo '<div style="color: red;">' . $uploadError . '</div>';
    }

    // Display delete error message
    if (isset($deleteError)) {
        echo '<div style="color: red;">' . $deleteError . '</div>';
    }
    ?>

    <!-- Image upload form -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <label for="seedImage">ເລືອກຮູບທີ່ຈະອັບໂຫລດ:</label>
        <br><br>
        <input type="file" id="seedImage" name="seedImage" accept="image/*" required>
        <button type="submit">ອັບໂຫຼດຮູບ</button>
        <br><br><br>
    </form>

    <!-- Display the current images with delete buttons -->
    <hr>
    <h2>Your uploaded images</h2>

    <?php
    // $result = $conn->query("SELECT * FROM images");
    // while ($row = $result->fetch_assoc()) {
    //     echo '<div style="margin-bottom: 10px;">';
    //     echo '<img src="' . $row['filepath'] . '" alt="Uploaded Image" style="max-width: 100%;">';
    //     echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';
    //     echo '<input type="hidden" name="deleteImage" value="' . $row['id'] . '">';
    //     echo '<button type="submit">Delete</button>';
    //     echo '</form>';
    //     echo '</div>';
    // }
    // ?>

    <!-- Optional: Add some styling for better presentation -->
    <style>
        body {
            max-width: 750px;
            margin: auto;
            padding: 20px;
            text-align: center;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
