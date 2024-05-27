<?php
// Include database connection
include 'db.php';

if (isset($_GET['fullname'])) {
    $fullname = $_GET['fullname'];

    // Fetch room information based on the selected fullname
    $result = $conn->query("SELECT room FROM admission WHERE fullname='$fullname'");

    if ($result->num_rows > 0) {
        // echo "<option value=''>Select Room</option>"; // Adding a default option
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['room']}'>{$row['room']}</option>";
        }
    } else {
        echo "<option value=''>No rooms found</option>";
    }
}

// Close database connection
$conn->close();
?>
