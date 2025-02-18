<?php
include "../database/connectiondb.php";

$pfname=$_POST['firstname'];
$plname=$_POST['lastname'];
$pconnum=$_POST['number'];
$pdate=$_POST['date'];
$phisto=$_POST['hair'];
if(isset($_POST['savebook'])){


$sql = "INSERT INTO customers (first_name, last_name, contact_number, date, Hair_History)
VALUES ('$pfname', '$plname', '$pconnum','$pdate','$phisto')";

if ($conn->query($sql) === TRUE) {

  $messAlert= "<script>alert('Record Successfully Created...')</script>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}

$conn->close();

?>
