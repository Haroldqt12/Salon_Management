<?php
try {
    $host = "localhost";
    $username = "root"; // Replace with your actual MySQL username
    $password = ""; // Replace with your actual MySQL password
    $database = "salon_db";

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Database Connection unsuccessful: " . $conn->connect_error);
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
