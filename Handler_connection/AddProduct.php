<?php
include "../database/connectiondb.php";


if($_SERVER["REQUEST_METHOD"] =="POST"){
    $productname = $_POST['product'];
    $stocks = $_POST['stocks'];
    $brand = $_POST['brand'];
    $date = $_POST['date'];

    $sql = "INSERT INTO product (productname, stocks, brand, product_date) VALUES(?,?,?,?)";
    $stmt = $conn->prepare($sql);

    if(!$stmt){
        die("Error preparing statement" . $conn->error);
    }
    $stmt->bind_param("siss", $productname, $stocks,$brand,$date);

    if($stmt->execute()){
        header("Location: ../designforSalon/Product.php");
        exit;
    }else{
        die("Error inserting Data ". $stmt->error);
    }

}

$stmt->close();
$conn->close();


?>