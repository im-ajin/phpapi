<?php

// MySQL database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "akecommerce";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// API endpoint to get data
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        // Set response header to JSON
        header('Content-Type: application/json');
        // Encode the data array to JSON and output it
        echo json_encode($data);
    } else {
        echo "No data found";
    }
}

$conn->close();
?>
