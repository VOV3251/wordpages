<?php
// Process the form submission and add scratchcard information to the database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
    $pin = $_POST["pin"];
    $serial = $_POST["serial"];

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "online-admission";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert scratchcard information into the database
    $sql = "INSERT INTO scratchcard (pin, serial, status) VALUES ('$pin', '$serial', 0)";

    if ($conn->query($sql) === TRUE) {
        echo "Scratchcard added successfully!";
        header("Location: forms.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
