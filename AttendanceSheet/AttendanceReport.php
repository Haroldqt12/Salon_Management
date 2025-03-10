<?php

include "../database/connectiondb.php";

include "../helpers/authenticated.php";

if ($_SESSION['user_role'] !== 'admin') {
    header("Location: ../BookingSite/HomeBooking.php");
    exit;
}


// Initialize variables
$employee_role = "all";
$search = "";
$date_filter = "";

// Check if form is submitted
if (isset($_POST['submit'])) {
    $employee_role = $_POST['employee'];
}

if (isset($_POST['search_btn'])) {
    $search = $conn->real_escape_string($_POST['search']);
}

// Check if a date is selected
if (!empty($_POST['date'])) {
    $date_filter = $conn->real_escape_string($_POST['date']);
}

// Base query to fetch attendance records with employee details
$sql = "SELECT employees.first_name, employees.last_name, attendance.Date_present, attendance.status
        FROM attendance 
        INNER JOIN employees ON employees.employee_id = attendance.employee_id
        WHERE 1=1";  // This ensures the WHERE clause is always present

// Apply role filter
if ($employee_role !== "all") {
    $sql .= " AND employees.role = '$employee_role'";
}

// Apply search filter
if (!empty($search)) {
    $sql .= " AND (employees.first_name LIKE '%$search%' 
                   OR employees.last_name LIKE '%$search%' 
                   OR attendance.Date_present LIKE '%$search%' 
                   OR attendance.status LIKE '%$search%')";
}

// Apply date filter
if (!empty($date_filter)) {
    $sql .= " AND attendance.Date_present = '$date_filter'";
}

// Execute query
$result = $conn->query(query: $sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="../js/bootstrap.bundle.js" defer></script>
    <script src="../js/bootstrap.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<style>
    .dropdown.menu:hover {
        background-color: blue;
        color: white;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    .no-border {
            border: none !important;
            background-color: transparent;
        }
        .sidebar .nav-link, .sidebar h4 {
        color: white !important;  
        }
    
</style>
<body>
<nav class="navbar navbar-expand-lg bg-secondary">
        <div class="container">
            <div class="row justify-content-start">
                <div class="col-12">
                    <h2>
                        SALON SERVICE SALES AND INVENTORY SYSTEM
                        </h2>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        &nbsp; ADMIN
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>
                        <a href="../Handler_connection/Log-out.php"> <button class="dropdown-item" type="button">LOG-OUT</button></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
    <div class="row flex-nowrap">
    <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark sidebar">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-dark min-vh-100">
                <!-- INTERFACE SECTION -->
                <h4 class="lead">INTERFACE</h4>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item mt-2">
                        <a href="../designforSalon/home.php" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline"><i class="fa-solid fa-house px-2 fa-2x"></i>&nbspDashboard</span>
                        </a>
                    </li>
                    <li class="nav-item mt-2">
                        <a href="../designforSalon/User-management.php" class="nav-link px-0">
                            <span class="d-none d-sm-inline"><i class="fa-solid fa-calendar-check px-2 fa-2x"></i>&nbspAppointment</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown mt-2">
                        <a class="nav-link dropdown-toggle px-0 align-middle" href="#" id="attendanceDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fs-4 bi-table"></i>
                            <span class="ms-1 d-none d-sm-inline"><i class="fa-solid fa-clipboard-user px-2 fa-2x"></i>&nbspAttendance</span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="attendanceDropdown">
                            <li><a class="dropdown-item" href="../AttendanceSheet/DailyAttendance.php">Daily Attendance</a></li>
                            <li><a class="dropdown-item" href="../AttendanceSheet/AttendanceReport.php">Attendance Report</a></li>
                        </ul>
                    </li>
                    <li class="nav-item mt-2">
                        <a href="../designforSalon/Employee.php" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-table"></i>
                            <span class="ms-1 d-none d-sm-inline"><i class="fa-solid fa-user-tie px-2 fa-2x"></i>&nbspEmployee</span>
                        </a>
                    </li>
                </ul>

                <!-- PRODUCTS SECTION -->
                <h4 class="lead">PRODUCTS</h4>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start">
                    <li class="nav-item mt-2">
                        <a href="../designforSalon/Product.php" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline"><i class="fa-solid fa-store px-2 fa-2x"></i>&nbspProducts</span>
                        </a>
                    </li>
                    <li class="nav-item mt-2">
                        <a href="../designforSalon/Inventory.php" class="nav-link px-0">
                            <span class="d-none d-sm-inline"><i class="fa-solid fa-clipboard-list px-2 fa-2x"></i></i>&nbspDaily Inventory</span>
                        </a>
                    </li>
                    <li class="nav-item mt-2">
                            <a href="../designforSalon/ProductRecord.php" class="nav-link px-0">
                                <span class="d-none d-sm-inline">
                                <i class="fa-solid fa-pen-to-square px-2 fa-2x"></i>&nbspProduct Records
                                </span>
                            </a>
                        </li>
                </ul>

                <!-- PAYMENT SECTION -->
                <h4 class="lead mt-3">PAYMENT</h4>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start">
                    <li class="nav-item">
                        <a href="../designforSalon/PaymentRec.php" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">Payment Record</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../designforSalon/ShowRecord.php" class="nav-link px-0">
                            <span class="d-none d-sm-inline">Show All Records</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

            <div class="col py-2">
                    <div class="container">
                        <div class="row py-2">
                            <div class="card">
                                <h3 class="py-2">Attendance Report</h3>
                                <div class="border border-black">
                                </div>
                                    <form method="POST">
                                    <div class="col py-2">
                                        <div class="row">
                                            <div class="col-sm-4">
                                            <label for="employee" class="form-label mt-3">Employee</label>
                                            <select name="employee" id="employee" class="form-control mt-2">
                                                <option name="all" value="all">All Employee</option>
                                                <option name="HairStylist" value="HairStylist">Hair Stylist</option>
                                                <option name="Cashier" value="Cashier">Cashier</option>
                                                <option name="Utilities" value="Utilities">Utilities</option>
                                                <option name="Assistant" value="Assistant">Assistant</option>
                                            </select>
                                            </div>
                                            <div class="col-sm-3 mt-5">
                                                <input type="date" name="date" class="form-control mt-2" placeholder="Date">
                                            </div>
                                            <div class="col-sm-2 mt-5">
                                                <button class="btn btn-sm btn-success mt-2" name="submit" id="submit">Show report</button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                                <div class="col py-3">
                                    <div class="container">
                                        <div class="row py-2">
                                            <div class="card">
                                                <h3 class="lead mt-3">Record</h3>
                                                <div class="border border-black mt-2">

                                                </div>
                                                <div class="col py-2">
                                                    <div class="row justify-content-between">
                                                        <div class="col-sm-4">
                                                        </div>
                                                        <div class="col-sm-4">
                                                        <form method="POST" class="d-flex">
                                                            <input type="text" id="search" name="search" class="form-control" placeholder="Search Employee">
                                                            <button class="btn btn-sm btn-primary ms-2" name="search_btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                                                        </form>
                                                    </div>
                                                    </div>
                                                </div>
                                                <form method="POST">
                                                <div class="col py-2">
                                                        <div class="table-responsive">
                                                        <table class="table table-bordered table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>Employee Name</th>
                                                                    <th>Date</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                 <?php if ($result->num_rows > 0) { ?>
                                                                <?php while ($row = $result->fetch_assoc()) { ?>
                                                                    <tr>
                                                                        <td><?php echo $row['first_name']; ?></td> <!-- to indecate the name of employee -->
                                                                        <td><?php echo $row['Date_present']; ?></td>
                                                                        <td><?php echo $row['status']; ?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                                <?php } else { ?>
                                                                    <tr>
                                                                        <td colspan="3" class="text-center text-danger">No records found</td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
</body>
</html>
