<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admission Data PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Import the custom font */
        @font-face {
            font-family: 'NotoSansLao';
            src: url('fonts/NotoSansLao-Regular.ttf') format('truetype');
        }

        body {
            font-family: 'NotoSansLao', sans-serif; /* Use the custom font */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mt-4 mb-4">View Admission Data</h2>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
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
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $count = 1;
                    while ($data = $result->fetch_assoc()) {
                        echo '<tr>
                            <td>' . htmlspecialchars($count, ENT_QUOTES, 'UTF-8') . '</td>
                            <td>' . htmlspecialchars($data["fullname"], ENT_QUOTES, 'UTF-8') . '</td>
                            <td>' . htmlspecialchars($data["sex"], ENT_QUOTES, 'UTF-8') . '</td>
                            <td>' . htmlspecialchars($data["jamb_number"] ?? '', ENT_QUOTES, 'UTF-8') . '</td>
                            <td>' . htmlspecialchars($data["dept"] ?? '', ENT_QUOTES, 'UTF-8') . '</td>
                            <td>' . htmlspecialchars($data["email"], ENT_QUOTES, 'UTF-8') . '</td>
                            <td>' . htmlspecialchars($data["phone"], ENT_QUOTES, 'UTF-8') . '</td>
                            <td>' . htmlspecialchars($data["faculty"] ?? '', ENT_QUOTES, 'UTF-8') . '</td>
                            <td>' . htmlspecialchars($data["jamb_score"] ?? '', ENT_QUOTES, 'UTF-8') . '</td>
                            <td>' . htmlspecialchars($data["ssce_details"] ?? '', ENT_QUOTES, 'UTF-8') . '</td>
                            <td>' . htmlspecialchars($data["room"], ENT_QUOTES, 'UTF-8') . '</td>
                            <td><img src="' . htmlspecialchars($data["photo"], ENT_QUOTES, 'UTF-8') . '" alt="Photo"></td>
                          </tr>';
                        $count++;
                    }
                } else {
                    echo '<tr>
                        <td colspan="12" class="text-center">No data available</td>
                      </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
