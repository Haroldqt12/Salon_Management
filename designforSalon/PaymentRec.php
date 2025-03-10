<?php
include "../helpers/authenticated.php";

if ($_SESSION['user_role'] !== 'admin') {
    header("Location: ../BookingSite/HomeBooking.php");
    exit;
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
                        <a href="home.php" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline"><i class="fa-solid fa-house px-2 fa-2x"></i>&nbspDashboard</span>
                        </a>
                    </li>
                    <li class="nav-item mt-2">
                        <a href="User-management.php" class="nav-link align-middle px-0">
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
                        <a href="Employee.php" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-table"></i>
                            <span class="ms-1 d-none d-sm-inline"><i class="fa-solid fa-user-tie px-2 fa-2x"></i>&nbspEmployee</span>
                        </a>
                    </li>
                </ul>

                <!-- PRODUCTS SECTION -->
                <h4 class="lead">PRODUCTS</h4>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start">
                    <li class="nav-item mt-2">
                        <a href="Product.php" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline"><i class="fa-solid fa-store px-2 fa-2x"></i>&nbspProducts</span>
                        </a>
                    </li>
                    <li class="nav-item mt-2">
                        <a href="Inventory.php" class="nav-link px-0">
                            <span class="d-none d-sm-inline"><i class="fa-solid fa-clipboard-list px-2 fa-2x"></i></i>&nbspDaily Inventory</span>
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
            <div class="col py-2">
                <div class="card p-4 shadow">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Customer_ID</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button class="btn btn-success btn-sm">Edit</button>  
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>
