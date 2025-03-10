<?php
include "../database/connectiondb.php";

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']); // Convert to integer to prevent SQL injection

    // Check if the product exists before deleting
    $checkQuery = "SELECT * FROM product WHERE product_id = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Delete related records in daily_inventory
        $deleteInventoryQuery = "DELETE FROM daily_inventory WHERE product_id = ?";
        $stmt = $conn->prepare($deleteInventoryQuery);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();

        // Proceed with deletion of the product
        $deleteQuery = "DELETE FROM product WHERE product_id = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $product_id);

        if ($stmt->execute()) {
            // Redirect with success message
            header("Location: ../designforSalon/Product.php?message=Product deleted successfully");
            exit();
        } else {
            die("Error deleting product: " . $stmt->error); 
        }
    } else {
        die("Product not found."); 
    }
} else {
    die("Invalid request."); 
}
?>