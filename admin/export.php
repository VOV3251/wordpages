<?php
require_once('../connect.php'); // Assuming connect.php establishes your database connection

$select_query = mysqli_query($conn, "SELECT * FROM admission");

if (!$select_query) {
    die('Query failed: ' . mysqli_error($conn));
}

$table = '<table>
<tr>
<th>Id</th>
<th>ຊື່(Lao)</th>
<th>ເພດ</th>
<th>ວັນ/ເດືອນ/ປີເກີດ</th>
<th>ທີ່ຢູ່</th>
<th>ອີເມວ</th>
<th>ເບີໂທ</th>
<th>ຜູ້ປົກຄ້ອງ</th>
<th>ເບີໂທຜູ້ປົກຄ້ອງ</th>
<th>ຊັ້ນ</th>
<th>ຫ້ອງ</th>
<th>ຮູບ</th>
</tr>';

$count = 1; // Initialize the count variable

while ($data = mysqli_fetch_array($select_query)) {
    $table .= '<tr>
    <td>' . $count .'</td>
    <td>' . $data['fullname'] . '</td>
    <td>' . $data['sex'] . '</td>
    <td>' . $data["jamb_number"] . '</td>
    <td>' . $data["dept"] . '</td>
    <td>' . $data["email"] . '</td>
    <td>' . $data["phone"] . '</td>
    <td>' . $data["faculty"] . '</td>
    <td>' . $data["jamb_score"] . '</td>
    <td>' . $data["ssce_details"] . '</td>
    <td>' . $data["room"] . '</td>
    <td>
      <img src="../' . $data["photo"] . '" style="max-width: 100px; max-height: 100px;">
    </td>
    </tr>';

    $count++; // Increment the count variable
}

$table .= '</table>';

header("Content-type: application/xls");
header("Content-Disposition: attachment; filename=data.xls");

echo $table;
?>
