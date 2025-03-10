<?php
include "../helpers/authenticated.php";

if ($_SESSION['user_role'] !== 'admin') {
    header("Location: ../BookingSite/HomeBooking.php");
    exit;
}

include "../database/connectiondb.php";

$results_per_page = 10;

// Get the current page number from URL, default to 1 if not set
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // Ensure the page number is at least 1

// Calculate the starting limit
$start_limit = ($page - 1) * $results_per_page;

// Fetch total number of employees
$total_sql = "SELECT COUNT(*) AS total FROM employees";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_employees = $total_row['total'];

// Calculate total pages
$total_pages = ceil($total_employees / $results_per_page);

// Search Functionality
if (isset($_POST['submit'])) {
    $search = $conn->real_escape_string($_POST['search']);
    $sql = "SELECT * FROM employees WHERE first_name LIKE '%$search%' 
            OR last_name LIKE '%$search%' 
            OR employee_id LIKE '%$search%' 
            OR street LIKE '%$search%' 
            OR city LIKE '%$search%' 
            OR role LIKE '%$search%' 
            LIMIT $start_limit, $results_per_page";
} else {
    $sql = "SELECT * FROM employees LIMIT $start_limit, $results_per_page";
}
$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="../js/bootstrap.bundle.js"defer></script>
    <script src="../js/bootstrap.min.js"></script>
    
    <script src="../js/bootstrap.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<style>
    .dropdown.menu:hover{
        background-color: blue;
        color: white;
        transition: background-color 0.3s ease, color 0.3s ease;
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
                    </i><button type="button" class="btn btn-secondary dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false">&nbsp;
                        ADMIN
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

        <div class="col py-3">
          <div class="container">
            <div class="row">
                <div class="card py-3">
                    <h3 class="lead"> Employee Management</h3>
                    <div class="border border-dark"></div>
                    <div class="col py-2">
                        <div class="row justify-content-between">
                            <div class="col-sm-4">
                            <h3 class="">Add new Employee</h3>
                                </div>
                                </div>
                            </div>
                            <form action="../Handler_connection/AddEmployee.php" method="POST">
                            <div class="col py-3">
                                <div class="row mt-2 justify-content-between">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="firstname">First name</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                            <label for="lastname">Last name</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="contact">Contact No.</label>
                                            <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact" required>
                                        </div>
                                    </div>
                                    <div class="row mt-4 justify-content-between">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="age">Age</label>
                                                <input type="number" class="form-control" id="age" name="age" placeholder="Age" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="street">Street</label>
                                            <input type="text" name="street" id="street" class="form-control" placeholder="Street" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="city">City</label>
                                            <input type="text" name="city" id="city" class="form-control" placeholder="City" required>
                                        </div>
                                        <div class="col-sm-3">
                                        <label class="mt-2">Gender</label>
                                                <div class="form-group">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" class="form-check-input" name="gender" id="male" value="male">
                                                        <label for="male" class="form-check-label">Male</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" class="form-check-input" name="gender" id="female" value="female">
                                                        <label for="female" class="form-check-label">Female</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                <label for="job" class="form-label">Assigned/Job</label>
                                                    <select id="job" name="role" class="form-control">
                                                        <option value="" disabled selected>Select Job</option>
                                                        <option value="HairStylist">Hair Stylist</option>
                                                        <option value="Cashier">Cashier</option>
                                                        <option value="Utilities">Utilities</option>
                                                        <option value="Assistant">Assistant</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="row mt-5 justify-content-end">
                                            <div class="col-sm-3">
                                                <button class="btn btn-secondary btn-sm">Clear Form</button>
                                                <button class="btn btn-sm btn-primary">Add new Employee</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <div class="col py-3">
                            <div class="container">
                                <div class="row mt-2">
                                    <div class="card py-3">
                                        <h3 class="lead">Record</h3>
                                        <div class="border border-dark"></div>
                                        <div class="col py-2">
                                        <div class="row mt-2 justify-content-end">
                                            <div class="col-sm-4">
                                                <form method="POST" class="d-flex">
                                                    <input type="text" id="search" name="search" class="form-control" placeholder="Search Employee">
                                                    <button class="btn btn-sm btn-primary ms-2" name="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                        <form action="../Handler_connection/searchEmployee.php" method="POST">
                                        <div class="col py-2">
                                        <div class="table-responsive">
                                        <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>First name</th>
                                                <th>Last name</th>
                                                <th>Contact</th>
                                                <th>Age</th>
                                                <th>Street</th>
                                                <th>City</th>
                                                <th>Gender</th>
                                                <th>Assigned/Job</th>
                                                <th>Action</th>
                                            </tr>
                                                </thead>
                                                    <tbody>
                                                        <?php while($row = $result->fetch_assoc()): ?>
                                                        <tr>
                                                            <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['contact_number']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['age']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['street']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['city']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['gender']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['role']); ?></td>
                                                            <td>
                                                                <a href="../Edit/EditEmployee.php?id=<?php echo $row['employee_id']; ?>" class="btn btn-secondary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                                                <a href="../Handler_connection/deleteEmployee.php?id=<?php echo $row['employee_id']; ?>" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                                                
                                                            </td>
                                                        </tr>
                                                        <?php endwhile; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <nav class="mt-5">
                                            <ul class="pagination justify-content-end">
                                                <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                                                    <a class="page-link" href="?page=<?php echo ($page - 1); ?>">Previous</a>
                                                </li>

                                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                                    <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                                                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                                    </li>
                                                <?php endfor; ?>

                                                <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
                                                    <a class="page-link" href="?page=<?php echo ($page + 1); ?>">Next</a>
                                                </li>
                                            </ul>
                                        </nav>
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
    </div>
</body>
</html>

<?php
$conn->close();
?>