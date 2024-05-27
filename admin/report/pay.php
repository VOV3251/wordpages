<?php
require_once('../../connect.php'); // Assuming connect.php establishes your database connection

$select_query = mysqli_query($conn, "SELECT transactions.*, images.filename AS image_filename, images.filepath AS image_filepath, images.upload_date AS image_upload_date
FROM transactions
LEFT JOIN images ON transactions.id = images.id
ORDER BY transactions.id DESC");

if (!$select_query) {
    die('Query failed: ' . mysqli_error($conn));
}

// Set headers for the file download
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=pays.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Start the table
echo '<table border="1">';
echo '<tr>
<th>ລະຫັດ</th>
<th>ວັນທີ່</th>
<th>ຊື່</th>
<th>ຜູ້ປົກຄ້ອງ</th>
<th>ຊັ້ນ</th>
<th>ຫ້ອງ</th>
<th>ຈຳນວນເງີນ</th>
<th>ສະລິດຈ່າຍເງີນ</th>
</tr>';

// Initialize the count variable
$count = 1;

while ($data = mysqli_fetch_array($select_query)) {
    // Ensure the image path is correct
    $imagePath = htmlspecialchars($data['image_filepath'], ENT_QUOTES, 'UTF-8') . '/' . htmlspecialchars($data['image_filename'], ENT_QUOTES, 'UTF-8');

    echo '<tr>
    <td>' . $count . '</td>
    <td>' . htmlspecialchars($data['date'], ENT_QUOTES, 'UTF-8') . '</td>
    <td>' . htmlspecialchars($data['fullname'], ENT_QUOTES, 'UTF-8') . '</td>
    <td>' . htmlspecialchars($data['guardian'], ENT_QUOTES, 'UTF-8') . '</td>
    <td>' . htmlspecialchars($data['class'], ENT_QUOTES, 'UTF-8') . '</td>
    <td>' . htmlspecialchars($data['room'], ENT_QUOTES, 'UTF-8') . '</td>
    <td>' . htmlspecialchars($data['total_amount'], ENT_QUOTES, 'UTF-8') . '</td>
    <td><img src="../playment/' . $imagePath . '" alt="Transaction Image" style="max-width: 100px;"></td>
    </tr>';

    $count++; // Increment the count variable
}

echo '</table>';
?>
