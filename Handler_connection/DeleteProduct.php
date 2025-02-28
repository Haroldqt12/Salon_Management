<?php
include "../database/connectiondb.php";

try{

    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM product WHERE productId = ?");
    $stmt->bind_param("i", $id);

    if($stmt->execute()){
        header("Location: ../designforSalon/Product.php");
        exit;
    }else{
        echo "Deleting failed";
    }



}catch(\Exception $e){
    echo "Error" . $e;
}

?>