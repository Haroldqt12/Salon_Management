<?php
include "../database/connectiondb.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productname = $_POST['product'];
    $stocks = $_POST['stocks'];
    $brand = $_POST['brand'];
    $date = $_POST['date'];

    $sql = "CALL add_product(?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("sssi", $productname, $brand, $date, $stocks);

    if ($stmt->execute()) {
        header("Location: ../designforSalon/Product.php");
        exit;
    } else {
        die("Error inserting Data: " . $stmt->error);
    }

    $stmt->close();
}

$conn->close();
?>