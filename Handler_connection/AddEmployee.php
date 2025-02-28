<?php
include "../database/connectiondb.php";


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $contact = $_POST['contact'];
    $age = $_POST['age'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $gender = $_POST['gender'];
    $role = $_POST['role'];


    $sql ="INSERT INTO employees (first_name, last_name, role, contact_number, gender, age, street, city) VALUES (?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);

    if(!$stmt){
        die("Error preparing statement" . $conn->error);

    }

    $stmt->bind_param("sssssiss", $firstname,$lastname, $role, $contact, $gender, $age ,$street,$city);

    if($stmt->execute()){
        header("Location: ../designforSalon/Employee.php");
        exit;
    }else{
        die("Error inserting Data ". $stmt->error);
    }

    $stmt->close();
    $conn->close();
}



?>