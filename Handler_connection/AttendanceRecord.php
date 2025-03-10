<?php
include "../database/connectiondb.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $employeeIds = $_POST['employee_id']; // Get employee IDs
    $dates = $_POST['date'];
    $timeIns = $_POST['TimeIn'];
    $timeOuts = $_POST['TimeOut'];
    $attendances = $_POST['attend'];

    $sql = "INSERT INTO attendance (employee_id, Date_present, time_In, time_Out, status) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error in preparing statement: " . $conn->error);
    }

    for ($i = 0; $i < count($dates); $i++) {
        $employeeId = $employeeIds[$i];
        $date = $dates[$i];
        $timeIn = $timeIns[$i];
        $timeOut = $timeOuts[$i];
        $attendance = $attendances[$i];

        $stmt->bind_param("issss", $employeeId, $date, $timeIn, $timeOut, $attendance);

        if (!$stmt->execute()) {
            die("Error inserting data: " . $stmt->error);
        }
    }

    $stmt->close();
    $conn->close();

    header("Location: ../AttendanceSheet/DailyAttendance.php");
    exit;
}
?>
