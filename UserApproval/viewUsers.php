<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="../js/bootstrap.bundle.js"defer></script>
    <script src="../js/bootstrap.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<style>
    .dropdown.menu:hover{
        background-color: blue;
        color: white;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
</style>
<body>
    <nav class="navbar navbar-expand-lg bg-secondary">
        <div class="container">
            <div class="row justify-content-start">
                <div class="col-12">
                    <h2>
                        SALON SERVICE SALES AND INVENTORY SYSTEM</h2>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="btn-group">
                    <i class="fa-solid fa-user fa-3x"></i><button type="button" class="btn btn-secondary dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false">&nbsp;
                        ADMIN
                    </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <button class="dropdown-item" type="button">Settings</button>
                            </li>
                            <li>
                                <button class="dropdown-item" type="button">LOG-OUT</button>
                            </li>
                        </ul>
                </div>
            </div>
        </div>
    </nav>
    

    
    <div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <!-- INTERFACE SECTION -->
                <h4 class="lead">INTERFACE</h4>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="home.php" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="User-management.php" class="av-link px-0">
                            <span class="d-none d-sm-inline">Appointment</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-0 align-middle" href="#" id="attendanceDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fs-4 bi-table"></i>
                            <span class="ms-1 d-none d-sm-inline">Attendance</span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="attendanceDropdown">
                            <li><a class="dropdown-item" href="../AttendanceSheet/DailyAttendance.php">Daily Attendance</a></li>
                            <li><a class="dropdown-item" href="../AttendanceSheet/AttendanceReport.php">Attendance Report</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="Employee.php" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-table"></i>
                            <span class="ms-1 d-none d-sm-inline">Employee</span>
                        </a>
                    </li>
                </ul>

                <!-- PRODUCTS SECTION -->
                <h4 class="lead mt-3">PRODUCTS</h4>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start">
                    <li class="nav-item">
                        <a href="Product.php" class="nav-link align-middle px-0">
                            <span class="ms-1 d-none d-sm-inline">Products</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="Inventory.php" class="nav-link px-0">
                            <span class="d-none d-sm-inline">Daily Inventory</span>
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
                    <div class="row">
                        <div class="card">
                        <h3 class="lead py-3">Booking Record</h3>
                            <div class="border border-dark"></div>
                            <div class="col py-3">
                                <div class="row justify-content-between">
                                    <div class="col-sm-4">
                                        <a href="../designforSalon/home.php" class="btn btn-sm btn-secondary mt-3">Cancel</a>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="search" placeholder="Search" class="form-control mt-3">
                                    </div>
                                </div>
                                <div class="col py-5">
                                    <div class="row">
                                        <div class="table">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>First name</th>
                                                            <th>Last name</th>
                                                            <th>Date</th>
                                                            <th>Contact</th>
                                                            <th>Hair History</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <?php
                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                echo "<tr>
                                                                    <td>" . htmlspecialchars($row['first_name']) . "</td>
                                                                    <td>" . htmlspecialchars($row['last_name']) . "</td>
                                                                    <td>" . htmlspecialchars($row['date']) . "</td>
                                                                    <td>" . htmlspecialchars($row['contact_number']) . "</td>
                                                                    <td>" . htmlspecialchars($row['Hair_History']) . "</td>
                                                                    <td>
                                                                        <button class='btn btn-sm btn-primary'>Approve</button>
                                                                    </td>
                                                                </tr>";
                                                            }
                                                        } else {
                                                            echo "<tr><td colspan='6' class='text-center'>No records found</td></tr>";
                                                        }
                                                        ?>
                                                        </tr>
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

            </div>
        </div>
    </div>
</body>
</html>