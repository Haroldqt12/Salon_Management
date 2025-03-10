<?php
include "../database/connectiondb.php";


try {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM employees WHERE employee_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $do = $result->fetch_assoc();
        } else {
            die("Record not found");
        }
        $stmt->close();
        

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $contact = $_POST['contact'];
            $age = $_POST['age'];
            $street = $_POST['street'];
            $city = $_POST['city'];
            $gender = $_POST['gender'];
            $role = $_POST['role'];

            $updateStmt = $conn->prepare("UPDATE employees SET first_name = ?, last_name = ?, role = ?, contact_number = ?, gender = ?, age = ?, street = ?, city = ? WHERE employee_id = ?");
            if (!$updateStmt) {
                die("SQL Error: " . $conn->error);
            }
            $updateStmt->bind_param("ssssssssi", $firstname, $lastname, $role, $contact, $gender, $age, $street, $city, $id);

            if ($updateStmt->execute()) {
                header("Location: ../designforSalon/Employee.php");
                exit;
            } else {
                echo "Update failed: " . $updateStmt->error;
            }
        }
    } else {
        die("ID not provided.");
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
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

        <div class="col py-3">
          <div class="container">
            <div class="row">
                <div class="card py-3">
                    <h3 class="lead"> Employee Management</h3>
                    <div class="border border-dark"></div>
                    <div class="col py-2">
                        <div class="row justify-content-between">
                            <div class="col-sm-4">
                            <h3 class="">Edit Employee</h3>
                                </div>
                                </div>
                            </div>
                            <form method="POST"> 
                            <div class="col py-3">
                                <div class="row mt-2 justify-content-between">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="firstname">First name</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?= isset($do['firstname']) ? htmlspecialchars($do['firstname']) : ''; ?>" placeholder="Firstname" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                            <label for="lastname">Last name</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?= isset($do['lastname']) ? htmlspecialchars($do['lastname']) : ''; ?>" placeholder="Lastname" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="contact">Contact No.</label>
                                            <input type="number" class="form-control" id="contact" name="contact" value="<?= isset($do['contact']) ? htmlspecialchars($do['contact']) : ''; ?>" placeholder="Contact" required>
                                        </div>
                                    </div>
                                    <div class="row mt-4 justify-content-between">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="age">Age</label>
                                                <input type="number" class="form-control" id="age" name="age" value="<?= $do['age'] ?>" placeholder="Age" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="street">Street</label>
                                            <input type="text" name="street" id="street" class="form-control" value="<?= $do['street'] ?>" placeholder="Street" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="city">City</label>
                                            <input type="text" name="city" id="city" class="form-control" value="<?= $do['city'] ?>" placeholder="City" required>
                                        </div>
                                        
                                        <div class="col-sm-3">
                                        <label class="mt-2">Gender</label>
                                                <div class="form-group">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" class="form-check-input" name="gender" id="male" value="male" <?= ($do['gender'] == 'male') ? 'checked' : '' ?>>
                                                        <label for="male" class="form-check-label">Male</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" class="form-check-input" name="gender" id="female" value="female" <?= ($do['gender'] == 'female') ? 'checked' : '' ?>>
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
                                                    <select id="job" name="role" class="form-control" required>
                                                        <option value="" disabled <?= empty($do['role']) ? 'selected' : '' ?>>Select Job</option>
                                                        <option value="Hair Stylist" <?= (isset($do['role']) && $do['role'] == 'Hair Stylist') ? 'selected' : '' ?>>Hair Stylist</option>
                                                        <option value="Cashier" <?= (isset($do['role']) && $do['role'] == 'Cashier') ? 'selected' : '' ?>>Cashier</option>
                                                        <option value="Utilities" <?= (isset($do['role']) && $do['role'] == 'Utilities') ? 'selected' : '' ?>>Utilities</option>
                                                        <option value="Assistant" <?= (isset($do['role']) && $do['role'] == 'Assistant') ? 'selected' : '' ?>>Assistant</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-5 justify-content-end">
                                            <div class="col-sm-2">
                                                <a href="../designforSalon/Employee.php" class="btn btn-sm btn-secondary">Cancel</a>
                                                <button class="btn btn-sm btn-primary">Confirm</button>
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
    </div>
</body>
</html>