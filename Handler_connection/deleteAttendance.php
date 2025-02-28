<?php
include "../database/connectiondb.php";

try{

    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM employees WHERE employee_id = ?");
    $stmt->bind_param("i", $id);

    if($stmt->execute()){
        header("Location: ../AttendanceSheet/DailyAttendance.php");
        exit;
    }else{
        echo "Deleting failed";
    }



}catch(\Exception $e){
    echo "Error" . $e;
}

?>