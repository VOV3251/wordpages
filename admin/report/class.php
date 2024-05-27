<?php
require_once('../../connect.php'); // Assuming connect.php establishes your database connection

$select_query = mysqli_query($conn, "SELECT * FROM class");

if (!$select_query) {
    die('Query failed: ' . mysqli_error($conn));
}

// Set headers for the file download
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=class.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Start the table
echo '<table border="1">';
echo '<tr>
<th>ລະຫັດ</th>
<th>ຊື່ຊັ້ນ</th>
</tr>';

// Initialize the count variable
$count = 1;

while ($data = mysqli_fetch_array($select_query)) {
    echo '<tr>
    <td>' . $count . '</td>
    <td>' . htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8') . '</td>
    </tr>';

    $count++; // Increment the count variable
}

echo '</table>';
?>
