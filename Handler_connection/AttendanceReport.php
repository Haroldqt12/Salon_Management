<?php
include "../database/connectiondb.php";


if (isset($_POST['submit'])) {
    $role = $_POST['employee'];
    $date = $_POST['date'];

    $sql = "SELECT CONCAT(employees.first_name, ' ', employees.last_name) AS employee_name, 
                   attendance.Date_present, attendance.status
            FROM attendance 
            INNER JOIN employees ON employees.employee_id = attendance.employee_id
            WHERE 1=1";

    if ($role !== 'all') {
        $sql .= " AND employees.role = '$role'";
    }

    if (!empty($date)) {
        $sql .= " AND attendance.Date_present = '$date'";
    }

    $result = $conn->query($sql);
}


?>