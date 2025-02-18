<?php 
include 'connectdb.php'; 

// Initialize variables
$hid = $hfn = $hmn = $hln = $hdid = $hrc = "";

// If user searches for an employee
if (isset($_POST['searchrec'])) {
    $pempID = $_POST['EmpID'];

    if (!empty($pempID)) {
        // Secure query to fetch employee data
        $sql = "SELECT * FROM Employee WHERE TEmpID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $pempID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hid = $row["TEmpID"];
            $hfn = $row["Tfn"];
            $hmn = $row["Tmn"];
            $hln = $row["Tln"];
            $hdid = $row["TdeptID"];
            $hrc = $row["Trankcode"];
        } else {
            echo "<script>alert('ID Not found...');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Please enter an Employee ID!');</script>";
    }
}
$conn->close();
?>
