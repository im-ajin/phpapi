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
    if (isset($_GET['id'])) {
        // If id is provided, retrieve multiple products
        $ids = explode(',', $_GET['id']); // Explode IDs string into an array
        $ids = array_map('intval', $ids); // Convert each ID to integer
        
        $idList = implode(',', $ids); // Prepare ID list for SQL query

        $sql = "SELECT * FROM products WHERE PRODUCT_ID IN ($idList)";
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
            echo "No data found for the given IDs";
        }
    } else {
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
}

$conn->close();
?>
