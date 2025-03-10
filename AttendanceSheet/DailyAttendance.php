<?php

include "../database/connectiondb.php";
include "../helpers/authenticated.php";

if ($_SESSION['user_role'] !== 'admin') {
    header("Location: ../BookingSite/HomeBooking.php");
    exit;
}



$search = "";
$employee_role = "all";

if (isset($_POST['submit'])) {
    $employee_role = $_POST['employee'];
}

if (isset($_POST['search_btn'])) {
    $search = $conn->real_escape_string($_POST['search']); 
}

// Base query to fetch employees
$sql = "SELECT * FROM employees WHERE 1";

// Apply role filter
if ($employee_role !== "all") {
    $sql .= " AND role = '$employee_role'";
}

// Apply search filter
if (!empty($search)) {
    $sql .= " AND (first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR role LIKE '%$search%')";
}

// Fetch total number of filtered employees
$sql_total = "SELECT COUNT(*) AS total FROM employees WHERE 1";
if ($employee_role !== "all") {
    $sql_total .= " AND role = '$employee_role'";
}
if (!empty($search)) {
    $sql_total .= " AND (first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR role LIKE '%$search%')";
}
$result_total = $conn->query($sql_total);
$total_rows = $result_total->fetch_assoc()['total'];

// Pagination logic
$results_per_page = 10;
$page  = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page); 
$total_pages = ceil($total_rows / $results_per_page);
$start_limit = ($page - 1) * $results_per_page;

$sql .= " LIMIT $start_limit, $results_per_page";
$result = $conn->query($sql);

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
                            <h3 class="py-2">Daily Attendance</h3>
                            <div class="border border-black">
                            </div>
                            <form method="POST">
                                <input type="hidden" name="employee" value="<?= $employee_role; ?>">
                                <input type="hidden" name="search" value="<?= $search; ?>">
                            <div class="col py-2">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="employee" class="mt-3">Employee</label>
                                        <select name="employee" id="employee" class="form-control mt-2">
                                            <option name="all" value="all">All Employee</option>
                                            <option name="HairStylist" value="HairStylist">Hair Stylist</option>
                                            <option name="Cashier" value="Cashier">Cashier</option>
                                            <option name="Utilities" value="Utilities">Utilities</option>
                                            <option name="Assistant" value="Assistant">Assistant</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <button class="btn btn-sm btn-success mt-5" name="submit" >Get Employee List</button>
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
                                <p class="lead py-2">Show Record</p>
                                <div class="border border-black"></div>
                                <div class="col py-2">
                                    <div class="row justify-content-between">
                                        <div class="col-sm-4">
                                            <p>Employee Data:</p>
                                        </div>
                                    </div>
                                </div>
                                <form action="../Handler_connection/AttendanceRecord.php" method="POST">
                                    <input type="hidden" name="employee" value="<?= $employee_role; ?>">
                                    <input type="hidden" name="search" value="<?= $search; ?>">
                                <div class="col py-2">
                                    <div class="table">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Assigned/Job</th>
                                                        <th>First name</th>
                                                        <th>Date</th>
                                                        <th>In Time</th>
                                                        <th>Out Time</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                                    <tr>
                                                        <td><?php echo $row['role']; ?></td>
                                                        <td><?php echo $row['first_name'];?></td>
                                                        <td>
                                                            <input type="hidden" name="employee_id[]" value="<?php echo $row['employee_id']; ?>">
                                                            <input type="date" name="date[]" class="form-control" required>
                                                        </td>
                                                        <td>
                                                            <input type="time" name="TimeIn[]" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="time" name="TimeOut[]" class="form-control">
                                                        </td>
                                                        <td>
                                                            <select class="form-control no-border" name="attend[]">
                                                                <option>Present</option>
                                                                <option>Absent</option>
                                                                <option>Late Arrival</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <a href="../Handler_connection/deleteAttendance.php?id=<?php echo $row['employee_id']; ?>" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                    <div class="col">
                                    <nav class="mt-3">
                                        <ul class="pagination justify-content-end">
                                            <li class="page-item <?= ($page <= 1) ? 'disabled' : ''; ?>">
                                                <a class="page-link" href="?page=<?= $page - 1; ?>&employee=<?= $employee_role; ?>&search=<?= $search; ?>">Previous</a>
                                            </li>
                                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                                <li class="page-item <?= ($page == $i) ? 'active' : ''; ?>">
                                                    <a class="page-link" href="?page=<?= $i; ?>&employee=<?= $employee_role; ?>&search=<?= $search; ?>"><?= $i; ?></a>
                                                </li>
                                            <?php endfor; ?>
                                            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : ''; ?>">
                                                <a class="page-link" href="?page=<?= $page + 1; ?>&employee=<?= $employee_role; ?>&search=<?= $search; ?>">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="col py-3">
                                        <div class="row justify-content-end">
                                            <div class="col-sm-1">
                                                <button class="btn btn-sm btn-success">Update</button>
                                            </div>
                                        </div>
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
</body>
</html>
