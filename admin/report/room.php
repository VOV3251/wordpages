<?php
require_once('../../connect.php'); // Assuming connect.php establishes your database connection

$select_query = mysqli_query($conn, "SELECT * FROM room");

if (!$select_query) {
    die('Query failed: ' . mysqli_error($conn));
}

// Set headers for the file download
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=room.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Start the table
echo '<table border="1">';
echo '<tr>
<th>ລະຫັດ</th>
<th>ຊື່ຫ້ອງ</th>
<th>ຈຳນວນຄົນ</th>
<th>ຄົນທີ່ເຂົ້າມາແລ້ວ</th>
</tr>';

// Initialize the count variable
$count = 1;

while ($data = mysqli_fetch_array($select_query)) {
    echo '<tr>
    <td>' . $count . '</td>
    <td>' . htmlspecialchars($data['room_name'], ENT_QUOTES, 'UTF-8') . '</td>
    <td>' . htmlspecialchars($data['capacity'], ENT_QUOTES, 'UTF-8') . '</td>
    <td>' . htmlspecialchars($data['current_occupancy'], ENT_QUOTES, 'UTF-8') . '</td>
    </tr>';

    $count++; // Increment the count variable
}

echo '</table>';
?>
