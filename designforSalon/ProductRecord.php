<?php

include "../database/connectiondb.php";
include "../helpers/authenticated.php";

if ($_SESSION['user_role'] !== 'admin') {
    header("Location: ../BookingSite/HomeBooking.php");
    exit;
}



// Fetch product history with proper date formatting
$historySql = "SELECT productname, prev_stocks, updated_stocks, 
               COALESCE(NULLIF(updated_date, '0000-00-00'), DATE_FORMAT(updated_date, '%Y-%m-%d')) AS formatted_date
               FROM productrecord ORDER BY updated_date DESC";
$historyResult = $conn->query($historySql);

if (!$historyResult) {
    die("Query failed: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon Product Management</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="../js/bootstrap.bundle.js" defer></script>
    <script src="../js/bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous">
    </script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .dropdown-menu .dropdown-item:hover {
            background-color: blue;
            color: white;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .sidebar .nav-link, .sidebar h4 {
            color: white !important;
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-secondary">
        <div class="container">
            <div class="row justify-content-start">
                <div class="col-12">
                    <h2>SALON SERVICE SALES AND INVENTORY SYSTEM</h2>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        &nbsp; ADMIN
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                    <a href="../Handler_connection/Log-out.php"> <button class="dropdown-item" type="button">LOG-OUT</button></a>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <!-- SIDEBAR -->
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark sidebar">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-dark min-vh-100">
                    <!-- INTERFACE SECTION -->
                    <h4 class="lead">INTERFACE</h4>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item mt-2">
                            <a href="home.php" class="nav-link align-middle px-0">
                                <span class="ms-1 d-none d-sm-inline">
                                    <i class="fa-solid fa-house px-2 fa-2x"></i>&nbspDashboard
                                </span>
                            </a>
                        </li>
                        <li class="nav-item mt-2">
                            <a href="User-management.php" class="nav-link align-middle px-0">
                                <span class="d-none d-sm-inline">
                                    <i class="fa-solid fa-calendar-check px-2 fa-2x"></i>&nbspAppointment
                                </span>
                            </a>
                        </li>
                        <li class="nav-item dropdown mt-2">
                            <a class="nav-link dropdown-toggle px-0 align-middle" href="#" id="attendanceDropdown"
                               role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fs-4 bi-table"></i>
                                <span class="ms-1 d-none d-sm-inline">
                                    <i class="fa-solid fa-clipboard-user px-2 fa-2x"></i>&nbspAttendance
                                </span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="attendanceDropdown">
                                <li><a class="dropdown-item" href="../AttendanceSheet/DailyAttendance.php">Daily Attendance</a></li>
                                <li><a class="dropdown-item" href="../AttendanceSheet/AttendanceReport.php">Attendance Report</a></li>
                            </ul>
                        </li>
                        <li class="nav-item mt-2">
                            <a href="Employee.php" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-table"></i>
                                <span class="ms-1 d-none d-sm-inline">
                                    <i class="fa-solid fa-user-tie px-2 fa-2x"></i>&nbspEmployee
                                </span>
                            </a>
                        </li>
                    </ul>

                    <!-- PRODUCTS SECTION -->
                    <h4 class="lead">PRODUCTS</h4>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start">
                        <li class="nav-item mt-2">
                            <a href="Product.php" class="nav-link align-middle px-0">
                                <span class="ms-1 d-none d-sm-inline">
                                    <i class="fa-solid fa-store px-2 fa-2x"></i>&nbspProducts
                                </span>
                            </a>
                        </li>
                        <li class="nav-item mt-2">
                            <a href="Inventory.php" class="nav-link px-0">
                                <span class="d-none d-sm-inline">
                                    <i class="fa-solid fa-clipboard-list px-2 fa-2x"></i>&nbspDaily Inventory
                                </span>
                            </a>
                        </li>
                    <li class="nav-item mt-2">
                            <a href="ProductRecord.php" class="nav-link px-0">
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
                            <a href="PaymentRec.php" class="nav-link align-middle px-0">
                                <span class="ms-1 d-none d-sm-inline">Payment Record</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="ShowRecord.php" class="nav-link px-0">
                                <span class="d-none d-sm-inline">Show All Records</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>        
            <div class="col py-3">
                <div class="container">
                    <div class="row mt-2">
                        <div class="card py-3">
                            <h3 class="lead">Latest Product Records</h3>
                            <div class="border border-dark"></div>
                            <div class="col py-2">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Previous Stock</th>
                                                <th>Latest Added Stock</th>
                                                <th>Date Added</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = $historyResult->fetch_assoc()) { ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($row['productname']); ?></td>
                                                    <td style="color: <?= ($row['prev_stocks'] < 30) ? 'red' : 'black'; ?>;">
                                                        <?= htmlspecialchars($row['prev_stocks']); ?>
                                                    </td>
                                                    <td><?= htmlspecialchars($row['updated_stocks']); ?></td>
                                                    <td><?= htmlspecialchars($row['formatted_date']); ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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
<?php $conn->close(); ?>