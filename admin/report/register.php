


<?php
require_once('../../connect.php'); // Assuming connect.php establishes your database connection

$select_query = mysqli_query($conn, "SELECT * FROM register");

if (!$select_query) {
    die('Query failed: ' . mysqli_error($conn));
}

// Set headers for the file download
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=register.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Start the table
echo '<table border="1">';
echo '<tr>
<th>ລະຫັດ</th>
<th>ວັນທີ່</th>
<th>ຊື່</th>
<th>ບ້ານ</th>
<th>ເມຶ່ອງ</th>
<th>ແຂວງ</th>
<th>ຜູ້ປົກຄ້ອງ</th>
<th>ເບີຕິດຕໍ່ຜູ້ປົກຄ້ອງ</th>
<th>ຊັ້ນຮຽນ</th>
<th>ຫ້ອງຮຽນ</th>
</tr>';

// Initialize the count variable
$count = 1;

while ($data = mysqli_fetch_array($select_query)) {
    echo '<tr>
    <td>' . $count . '</td>
    <td>' . htmlspecialchars($data['date'], ENT_QUOTES, 'UTF-8') . '</td>
    <td>' . htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8') . '</td>
    <td>' . htmlspecialchars($data['village'], ENT_QUOTES, 'UTF-8') . '</td>
    <td>' . htmlspecialchars($data['city'], ENT_QUOTES, 'UTF-8') . '</td>
    <td>' . htmlspecialchars($data['province'], ENT_QUOTES, 'UTF-8') . '</td>
    <td>' . htmlspecialchars($data['guardian'], ENT_QUOTES, 'UTF-8') . '</td>
    <td>' . htmlspecialchars($data['phone'], ENT_QUOTES, 'UTF-8') . '</td>
    <td>' . htmlspecialchars($data['re_class'], ENT_QUOTES, 'UTF-8') . '</td>
    <td>' . htmlspecialchars($data['re_room'], ENT_QUOTES, 'UTF-8') . '</td>
    </tr>';

    $count++; // Increment the count variable
}

echo '</table>';
?>
