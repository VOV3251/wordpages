

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Admission</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="shortcut icon" href="images/log.jpg" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/log.jpg">

    <style>
        body {
            background: linear-gradient(to right, #ff7e5f, #feb47b, #ffcc8c, #ffd699, #ffe6b3, #d9ead3, #a3d3cc, #85c7f2, #7da7d9, #848cc4); /* Gradient background */
            height: 80vh; /* Full height of the viewport */
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            
        }
*{
    font-family:Noto Sans Lao, sans-serif;
}
        .container {
            max-width: 500px;
            margin: 0 auto;
            margin-top: 100px;
            /* border:  solid #DC3545; Larger border */
            border-radius: 45px; /* Larger border radius */
            padding: 30px; /* More padding */
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1); /* Larger box shadow */
        }

        h2 {
            text-align: center;
            font-size:3rem;
            margin-bottom: 60px;
        }
        h3{
            font-size: 1.5rem;
        }

        .form-group {
            margin-bottom: 50px;
        }
        label{
            font-size:1.3rem;
        }
        p{
            border: 4px solid #DC3545;
            font-size:1.5rem;
        }

        input.form-control {
        background-color: rgba(169, 169, 169, 0.5); /* Transparent gray */
    }

    </style>

</head>
<body>


<div class="container mt-5">
    <h2><b> ສະໝັກເຂົ້າໃຊ້ </b> </h2>
    <h3>ກະລູນາປອນຊື່ ແລະ ລະຫັດ ຫຼືວັນເດືອນປີເກີດຂອງນັກຮຽນ</h3>

    <!-- Form to add scratchcard information -->
    <form action="process.php" method="post">
        <div class="form-group">
            <label for="pin"><B>ຊື່:</B></label>
            <input type="text" class="form-control" id="pin" name="pin" required>
        </div>

        <div class="form-group">
            <label for="serial"><B>ລະຫັດ:</B></label>
            <input type="text" class="form-control" id="serial" name="serial" required>
        </div>

        <button type="submit" class="btn btn-lg btn-primary p-3">ສະຫມັກເຂົ້າ</button>
        <a href="index.php" class="btn btn-lg btn-warning p-3">ເຂົ້າໄປສູ່ຫນ້າຫຼັກ</a>
    </form>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
