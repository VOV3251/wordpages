<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Details</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        *{
            font-family: "Noto Sans Lao", sans-serif;
        }
        body {
            font-size: 40px; /* Set the default font size */
        }
        h2{
            font-size:60px;
        }
        h2{
            font-size:50px;
        }
        .btn {
            font-size: 20px; /* Increase the font size of buttons */
            padding: 10px 30px; /* Adjust padding for buttons */
        }
        .card {
            width: 60%; /* Set the width of the card */
            margin: 0 auto; /* Center the card horizontally */
            margin-top: 30px; /* Add some top margin */
        }
        .card-title {
            font-size: 30px; /* Increase the font size of the card title */
        }
        .card-text {
            font-size: 30px; /* Increase the font size of the card text */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
    <?php
// Include database connection
include 'db.php';

// Fetch transaction details from the database
$result = $conn->query("SELECT * FROM transactions ORDER BY id DESC LIMIT 1");

if ($result->num_rows > 0) {
    // Output card header with current date
    $currentDate = date("Y-m-d"); // Format the date as needed
    echo "<div class='row'>";
    echo "<div class='col'>";
    echo "<h2 class='mb-4 text-center'>ໃບບິນ:</h2>"; // Displaying current date
    echo "</div>";
    echo "</div>";

    // Output card content
    while ($row = $result->fetch_assoc()) {
        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h4 class='mb-4'>  ວັນທີ່-ເດືອນ-ປີ : $currentDate</h4>";
        echo "<h5 class='card-title'><b>ເລກທີ່:</b> {$row['id']}</h5>";
        echo "<p class='card-text'><b>ຊື ແລະນາມສະກຸນ:</b> {$row['fullname']}</p>";
        echo "<p class='card-text'><b>ຫ້ອງ:</b> {$row['room']}</p>";
        // echo "<p class='card-text'>Quantity: {$row['quantity']}</p>";
        echo "<p class='card-text'><b>ຈຳນວນ: </b> {$row['total_amount']}</p>";
        echo "<a href='../../index.php' class='btn btn-primary'>ສຳເລັດ</a>";
        echo "</div>";
        echo "</div>";
    }
} else {
    // Output message if no transactions found
    echo "<div class='row'>";
    echo "<div class='col'>";
    echo "<p>No transactions found</p>";
    echo "</div>";
    echo "</div>";
}

// Close database connection
$conn->close();
?>


    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
