<?php
include "../database/connectiondb.php";

try {
    // Check if ID is set and valid
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        die("Invalid request: ID is missing.");
    }

    $id = $_GET['id'];

    // Debugging: Check if ID exists
    $check = $conn->query("SELECT * FROM daily_inventory WHERE inventory_id = $id");
    if ($check->num_rows == 0) {
        die("Error: Inventory ID does not exist.");
    }

    // Prepare statement
    $stmt = $conn->prepare("DELETE FROM daily_inventory WHERE inventory_id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $id);

    // Execute and check for errors
    if ($stmt->execute()) {
        header("Location: ../designforSalon/Inventory.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>