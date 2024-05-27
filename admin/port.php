<?php
require_once('../connect.php'); // Assuming connect.php establishes your database connection
require_once("../dompdf/autoload.inc.php");

use Dompdf\Dompdf;
use Dompdf\Options;

// Define the font path for Noto Sans Lao
$notoSansLaoPath = 'fonts/NotoSansLaoLooped-VariableFont_wdth,wght.ttf';

// Check if the font file exists
if (!file_exists($notoSansLaoPath)) {
    echo "Error: Font file does not exist at " . $notoSansLaoPath;
    exit();
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $sql = "SELECT * FROM admission ORDER BY id DESC";

    try {
        $result = $conn->query($sql);

        $html = '';
        $html .= '<!DOCTYPE html><html><head><meta charset="UTF-8">';

        // Declare font-face for Noto Sans Lao
        $html .= '<style>
            @font-face {
                font-family: "NotoSansLao";
                src: url("' . $notoSansLaoPath . '") format("truetype");
                font-weight: normal;
                font-style: normal;
            }
            body {
                font-family: "NotoSansLao", sans-serif;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #6c757d;
                padding: 10px;
                text-align: left;
            }
        </style>';
        $html .= '</head><body>';
        $html .= '<h2 align="center">Export Data to PDF File</h2>';

        $html .= '<table>';
        $html .= '  <tr>
        <th>Id</th>
        <th>ชื่อ (Lao)</th>
        <th>Gender</th>
        <th>Birth</th>
        <th>Address</th>
        <th>Email</th>
        <th>Tel</th>
        <th>Guardian</th>
        <th>Tel_guardian</th>
        <th>Class</th>
        <th>Room</th>
        <th>Photo</th>
          </tr>';

        if ($result->num_rows > 0) {
            $count = 1;
            while ($data = $result->fetch_assoc()) {
                $html .= '  <tr>
                <td>' . htmlspecialchars($count, ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($data["fullname"], ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($data["sex"], ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($data["birth"] ?? '', ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($data["address"] ?? '', ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($data["email"], ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($data["phone"], ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($data["guardian"] ?? '', ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($data["tel_guardian"] ?? '', ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($data["class"] ?? '', ENT_QUOTES, 'UTF-8') . '</td>
                <td>' . htmlspecialchars($data["room"], ENT_QUOTES, 'UTF-8') . '</td>
                <td>
                  <img src="../' . htmlspecialchars($data["photo"], ENT_QUOTES, 'UTF-8') . '" style="max-width: 100px; max-height: 100px;">
                </td>
                </tr>';
                $count++;
            }
        } else {
            $html .= '  <tr>
                <td colspan="12" style="text-align:center;">No data available</td>
              </tr>';
        }

        $html .= '</table>';
        $html .= '</body></html>';

        // Dompdf options
        $options = new Options();
        $options->set('isFontSubsettingEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'NotoSansLao');

        // Create Dompdf instance
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html); // Ensure UTF-8 is used

        // Set paper size and orientation
        $dompdf->setPaper("A2", "portrait");

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF (inline or attachment)
        $dompdf->stream("data.pdf", ["Attachment" => false]);

    } catch (mysqli_sql_exception $e) {
        echo "Error: Database Query Failed - " . $e->getMessage();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
