<?php
include "../database/connectiondb.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = intval($_POST['productId']);
    $quantity = intval($_POST['quantity']);
    $action = $_POST['action'];
    $dateUsed = isset($_POST['dateUsed']) ? $_POST['dateUsed'] : date("Y-m-d"); // Default to today

    if ($action === 'increase') {
        $sql = "UPDATE product SET stocks = stocks + ? WHERE product_id = ?";
    } else {
        $sql = "UPDATE product SET stocks = stocks - ? WHERE product_id = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $quantity, $productId);

    if ($stmt->execute()) {
        if ($action === 'decrease') {
            $insertInventory = $conn->prepare("INSERT INTO daily_inventory (product_id, stock_used, date_used) VALUES (?, ?, ?)");
            $insertInventory->bind_param("iis", $productId, $quantity, $dateUsed);
            $insertInventory->execute();
            $insertInventory->close();
        }

        // Fetch updated inventory data
        $inventoryData = [];
        $result = $conn->query("SELECT d.inventory_id, p.productname, d.stock_used, d.date_used 
                                FROM daily_inventory d 
                                JOIN product p ON d.product_id = p.product_id 
                                ORDER BY d.date_used DESC");

        while ($row = $result->fetch_assoc()) {
            $inventoryData[] = $row;
        }

        echo json_encode(['success' => true, 'inventory' => $inventoryData]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
