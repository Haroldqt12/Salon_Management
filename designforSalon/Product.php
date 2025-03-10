<?php
include "../database/connectiondb.php";
include "../helpers/authenticated.php";

if ($_SESSION['user_role'] !== 'admin') {
    header("Location: ../BookingSite/HomeBooking.php");
    exit;
}


// 2. Handle the Update Request (Stocks, Date) BEFORE fetching records
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    if (!empty($_POST['stocks']) && !empty($_POST['updated_date']) && !empty($_POST['product_id'])) {
        $newStocks = intval($_POST['stocks']);
        $date = $_POST['updated_date']; 
        $id = intval($_POST['product_id']);

        // Validate date format
        if (empty($date) || $date == "0000-00-00") {
            echo "<script>alert('Invalid Date! Please select a valid date.');</script>";
            exit;
        }
        

        // Fetch previous stock details
        $fetchQuery = $conn->prepare("SELECT productname, brand, stocks, product_date FROM product WHERE product_id = ?");
        $fetchQuery->bind_param("i", $id);
        $fetchQuery->execute();
        $fetchResult = $fetchQuery->get_result();
        $productData = $fetchResult->fetch_assoc();
        $fetchQuery->close();

        if ($productData) {
            $prevStocks = $productData['stocks'];
            $prevDate = $productData['product_date'];
            $productName = $productData['productname'];
            $brand = $productData['brand'];
            $date = !empty($_POST['updated_date']) && $_POST['updated_date'] !== "0000-00-00" ? $_POST['updated_date'] : date("Y-m-d");

            // Insert into productRecord
            $insertHistory = $conn->prepare("INSERT INTO productrecord 
                (product_id, productname, brand, prev_stocks, prev_date, updated_stocks, updated_date) 
                VALUES (?, ?, ?, ?, ?, ?, ?)");
            $insertHistory->bind_param("ississs", $id, $productName, $brand, $prevStocks, $prevDate, $newStocks, $date);

            if (!$insertHistory->execute()) {
                die("Error inserting into productrecord: " . $insertHistory->error);
            }
            $insertHistory->close();

            // Update product table with new total stock and date
            $totalStocks = $prevStocks + $newStocks;
            $updateStmt = $conn->prepare("UPDATE product SET stocks = ?, product_date = ? WHERE product_id = ?");
            $updateStmt->bind_param("isi", $totalStocks, $date, $id);
            if (!$updateStmt->execute()) {
                die("Error updating product: " . $conn->error);
            }
            $updateStmt->close();

            echo "<script>alert('Product updated successfully!'); window.location.href='Product.php';</script>";
            exit;
        } else {
            echo "<script>alert('Product not found. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Invalid input. Please provide all required fields.');</script>";
    }
}


// Pagination Settings
$results_per_page = 5;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$start_limit = ($page - 1) * $results_per_page;

// Get total product count
$total_sql = "SELECT COUNT(*) AS total FROM product";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_pages = ceil($total_row['total'] / $results_per_page);

// Search filter
if (isset($_POST['submit'])) {
    $search = $conn->real_escape_string($_POST['search']);
    $sql = "SELECT * FROM product WHERE productname LIKE '%$search%' OR stocks LIKE '%$search%' OR brand LIKE '%$search%' OR product_date LIKE '%$search%' LIMIT $start_limit, $results_per_page";
} else {
    $sql = "SELECT * FROM product LIMIT $start_limit, $results_per_page";
}

$result = $conn->query($sql);
?>

<!-- Your HTML and Bootstrap layout remains unchanged -->

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

            <!-- RIGHT CONTENT -->
            <div class="col py-3">
                <div class="container">
                    <div class="row">
                        <div class="card py-3">
                            <h3 class="lead">Product Management</h3>
                            <div class="border border-dark"></div>
                            <!-- ADD NEW PRODUCT FORM -->
                            <div class="col py-2">
                                <div class="row justify-content-between">
                                    <div class="col-sm-4">
                                        <h3>Add new Product</h3>
                                    </div>
                                </div>
                            </div>
                            <form action="../Handler_connection/AddProduct.php" method="POST">
                                <div class="col py-3">
                                    <div class="row mt-2">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="product">Product name</label>
                                                <input type="text" class="form-control" id="product" name="product" placeholder="Product" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="stocks">Available Stock</label>
                                            <input type="number" class="form-control" id="stocks" name="stocks" placeholder="Stocks" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="brand">Brand</label>
                                            <input type="text" class="form-control" id="brand" name="brand" placeholder="Brand" required>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-4">
                                            <label for="date">Date</label>
                                            <input type="date" name="date" id="date" class="form-control" placeholder="Date" required>
                                        </div>
                                    </div>
                                    <div class="row mt-5 justify-content-end">
                                        <div class="col-sm-2">
                                            <button class="btn btn-sm btn-primary w-100">Confirm</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- PRODUCT RECORD TABLE -->
                        <div class="col py-3">
                            <div class="container">
                                <div class="row mt-2">
                                    <div class="card py-3"> 
                                        <h3 class="lead">Record</h3>
                                        <div class="border border-dark"></div>
                                        <div class="col py-2">
                                            <div class="row mt-2 justify-content-end">
                                                <div class="col-sm-4">
                                                    <!-- SEARCH FORM -->
                                                    <form method="POST" class="d-flex">
                                                        <input type="text" id="search" name="search" class="form-control" placeholder="Search Employee">
                                                        <button class="btn btn-sm btn-primary ms-2" name="submit">
                                                            <i class="fa-solid fa-magnifying-glass"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col py-2">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Product name</th>
                                                            <th>Available Stock</th>
                                                            <th>Brand</th>
                                                            <th>Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        while ($row = $result->fetch_assoc()) {
                                                            $productDate = ($row['product_date'] == '0000-00-00' || empty($row['product_date'])) 
                                                                ? date('Y-m-d') // Default to today's date
                                                                : $row['product_date'];
                                                        ?>
                                                        <tr>
                                                            <td><?= htmlspecialchars($row['productname']); ?></td>
                                                            <td style="color: <?= ($row['stocks'] < 30) ? 'red' : 'black'; ?>">
                                                                <?= htmlspecialchars($row['stocks']); ?>
                                                            </td>
                                                            <td><?= htmlspecialchars($row['brand']); ?></td>
                                                            <td><?= htmlspecialchars($productDate); ?></td>
                                                            <td>
                                                                <button class="btn btn-primary btn-sm edit-btn"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editModal"
                                                                        data-id="<?= $row['product_id']; ?>"
                                                                        data-stocks="<?= $row['stocks']; ?>"
                                                                        data-date="<?= $productDate; ?>">
                                                                    Update
                                                                </button>
                                                                <a href="../Handler_connection/DeleteProduct.php?id=<?= $row['product_id']; ?>" 
                                                                class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure you want to delete this product?');">
                                                                    Delete
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                </tbody>
                                            </table>
                                    <!-- UPDATE PRODUCT MODAL -->
                                    <form method="POST">
                                        <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title">Update Product Stocks</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Stocks:</label>
                                                            <input type="number" id="stocks" name="stocks" class="form-control" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Update Date:</label>
                                                            <input type="date" class="form-control" id="updated_date" name="updated_date" required>

                                                        </div>
                                                        <input type="hidden" id="product_id" name="product_id">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="update" class="btn btn-success">Update Product</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

    <!-- JS to populate modal fields -->
    <script>
document.querySelectorAll(".edit-btn").forEach(button => {
    button.addEventListener("click", function () {
        document.getElementById("product_id").value = this.getAttribute("data-id");
        document.getElementById("stocks").value = this.getAttribute("data-stocks");

        let dateValue = this.getAttribute("data-date") || new Date().toISOString().split('T')[0];

        console.log("Fetched Date from Button: ", dateValue);

        document.getElementById("updated_date").value = dateValue;
    });
});

</script>
</body>
</html>
