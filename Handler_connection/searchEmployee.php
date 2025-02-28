<?php
include "../database/connectiondb.php";



$id = isset($_POST['EmpID']) ? $_POST['EmpID'] : '';

$firstname = '';
$lastname = '';
$contact = '';
$age = '';
$street = '';
$city = '';
$gender ='';

if (isset($_POST['search'])) {
    $sql = "SELECT * FROM employees WHERE first_name LIKE '%$searchq%' OR last_name LIKE '%$searchq%' OR street LIKE '%$searchq%' OR city LIKE '%$searchq%' OR gender LIKE '%$searchq%'";
    $result = $conn->query($sql); 

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $hid = $row["TEmpID"];
            $hfn = $row["Tfn"];
            $hmn = $row["Tmn"];
            $hln = $row["Tln"];
            $hdid = $row["TdeptID"];
            $hrc = $row["Trankcode"];
        }
    } else {
        echo "<script>alert('ID Not found...')</script>";
    }
  }
?>
