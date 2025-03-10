<?php
include "../helpers/authenticated.php";

if ($_SESSION['user_role'] !== 'admin') {
    header("Location: ../BookingSite/HomeBooking.php");
    exit;
}

include "../database/connectiondb.php";

// Fetch all products from the database
$sql = "SELECT * FROM product";
$result = $conn->query($sql);

if (!$result) {
    die("Error fetching data: " . $conn->error);
}

// Fetch daily inventory data with pagination
$results_per_page_inventory = 10;
$page_inventory  = isset($_GET['page_inventory']) ? (int)$_GET['page_inventory'] : 1;
$page_inventory = max(1, $page_inventory); 
$start_limit_inventory = ($page_inventory - 1) * $results_per_page_inventory;

$sql_inventory = "SELECT d.inventory_id, p.productname, d.stock_used, d.date_used 
        FROM daily_inventory d 
        JOIN product p ON d.product_id = p.product_id 
        ORDER BY d.date_used DESC 
        LIMIT $start_limit_inventory, $results_per_page_inventory";

$result_inventory = $conn->query($sql_inventory);

// Fetch total number of daily_inventory
$sql_total_inventory = "SELECT COUNT(*) AS total FROM daily_inventory";
$result_total_inventory = $conn->query($sql_total_inventory);
$total_rows_inventory = $result_total_inventory->fetch_assoc()['total'];
$total_pages_inventory = ceil($total_rows_inventory / $results_per_page_inventory);

$results_per_page = 8;
$page  = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page); 
$start_limit = ($page - 1) * $results_per_page;

// Fetch total number of daily_inventory
$sql_total = "SELECT COUNT(*) AS total FROM daily_inventory";
$result_total = $conn->query($sql_total);
$total_rows = $result_total->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $results_per_page);

if (isset($_POST['submit'])) {
    $search = $conn->real_escape_string($_POST['search']);
    $sql = "SELECT * FROM product
            WHERE productname LIKE '%$search%' 
               OR stocks LIKE '%$search%' 
               OR brand LIKE '%$search%' 
               OR product_date LIKE '%$search%'";

    // Execute search query
    $result_paginated = $conn->query($sql);
} else {
    // Fetch paginated results
    $sql_paginated = "SELECT * FROM product LIMIT $start_limit, $results_per_page";
    $result_paginated = $conn->query($sql_paginated);
}



// Pagination setup for products
$results_per_page = 8;
$page  = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page); 
$start_limit = ($page - 1) * $results_per_page;

// Fetch total number of products
$sql_total = "SELECT COUNT(*) AS total FROM product";
$result_total = $conn->query($sql_total);
$total_rows = $result_total->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $results_per_page);

if (isset($_POST['submit'])) {
    $search = $conn->real_escape_string($_POST['search']);
    $sql = "SELECT * FROM product
            WHERE productname LIKE '%$search%' 
               OR stocks LIKE '%$search%' 
               OR brand LIKE '%$search%' 
               OR product_date LIKE '%$search%'";

    // Execute search query
    $result_paginated = $conn->query($sql);
} else {
    // Fetch paginated results
    $sql_paginated = "SELECT * FROM product LIMIT $start_limit, $results_per_page";
    $result_paginated = $conn->query($sql_paginated);
}

if (isset($_GET['delete_inventory_id'])) {
    $delete_inventory_id = (int)$_GET['delete_inventory_id'];
    $sql_delete = "DELETE FROM daily_inventory WHERE inventory_id = $delete_inventory_id";
    if ($conn->query($sql_delete) === TRUE) {
        header("Location: Inventory.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="../js/bootstrap.bundle.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet">
    <script src="../js/bootstrap.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
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
    <nav class="navbar navbar-expand-lg bg-secondary">
        <div class="container">
            <div class="row justify-content-start">
                <div class="col-12">
                    <h2>SALON SERVICE SALES AND INVENTORY SYSTEM</h2>
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
                                <span class="ms-1 d-none d-sm-inline"><i class="fa-solid fa-house px-2 fa-2x"></i>&nbsp;Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item mt-2">
                            <a href="User-management.php" class="nav-link align-middle px-0">
                                <span class="d-none d-sm-inline"><i class="fa-solid fa-calendar-check px-2 fa-2x"></i>&nbsp;Appointment</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown mt-2">
                            <a class="nav-link dropdown-toggle px-0 align-middle" href="#" id="attendanceDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fs-4 bi-table"></i>
                                <span class="ms-1 d-none d-sm-inline"><i class="fa-solid fa-clipboard-user px-2 fa-2x"></i>&nbsp;Attendance</span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="attendanceDropdown">
                                <li><a class="dropdown-item" href="../AttendanceSheet/DailyAttendance.php">Daily Attendance</a></li>
                                <li><a class="dropdown-item" href="../AttendanceSheet/AttendanceReport.php">Attendance Report</a></li>
                            </ul>
                        </li>
                        <li class="nav-item mt-2">
                            <a href="Employee.php" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-table"></i>
                                <span class="ms-1 d-none d-sm-inline"><i class="fa-solid fa-user-tie px-2 fa-2x"></i>&nbsp;Employee</span>
                            </a>
                        </li>
                    </ul>

                    <!-- PRODUCTS SECTION -->
                    <h4 class="lead">PRODUCTS</h4>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start">
                        <li class="nav-item mt-2">
                            <a href="Product.php" class="nav-link align-middle px-0">
                                <span class="ms-1 d-none d-sm-inline"><i class="fa-solid fa-store px-2 fa-2x"></i>&nbsp;Products</span>
                            </a>
                        </li>
                        <li class="nav-item mt-2">
                            <a href="Inventory.php" class="nav-link px-0">
                                <span class="d-none d-sm-inline"><i class="fa-solid fa-clipboard-list px-2 fa-2x"></i>&nbsp;Daily Inventory</span>
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

            <!-- MAIN CONTENT AREA -->
            <div class="col py-3">
                <div class="container">
                    <div class="row">
                        <div class="card">
                            <h3 class="lead py-3">INVENTORY</h3>
                            <div class="border border-dark"></div>
                            <div class="col py-5">
            <div class="col-sm-4">
                <form method="POST" class="d-flex">
                    <input type="text" id="search" name="search" class="form-control" placeholder="Search Product">
                    <button class="btn btn-sm btn-primary ms-2" name="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Products Display -->
        <div class="row">
            <?php while ($row = $result_paginated->fetch_assoc()) { ?>
                <div class="col-md-3 mb-3">
                    <div class="card p-3 border">
                        <h5><?= htmlspecialchars($row['productname']); ?></h5>
                        <p>Brand: <?= htmlspecialchars($row['brand']); ?></p>
                        <p style="color: <?= ($row['stocks'] < 30) ? 'red' : 'black'; ?>">
                            Stock: <span id="stock-<?= $row['product_id']; ?>">
                                <?= htmlspecialchars($row['stocks']); ?>
                            </span>
                        </p>
                        <div class="d-flex">
                            <button class="btn btn-success btn-sm me-2 w-100" onclick="updateStock(<?= $row['product_id']; ?>, 1, 'increase')">+</button>
                            <button class="btn btn-danger btn-sm w-100" onclick="openReduceModal(<?= $row['product_id']; ?>)">-</button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Pagination -->
        <nav class="mt-5">
            <ul class="pagination justify-content-end">
                <li class="page-item <?= ($page <= 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?= $page - 1; ?>">Previous</a>
                </li>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= ($page == $i) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?= $page + 1; ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Inventory Table -->
    <div class="container mt-3">
        <div class="row">
            <div class="card py-3">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Stock Used</th>
                                <th>Used Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result_inventory->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= $row['productname']; ?></td>
                                    <td><?= $row['stock_used']; ?></td>
                                    <td><?= $row['date_used']; ?></td>
                                    <td>
                                
                                    <a href="Inventory.php?delete_inventory_id=<?= $row['inventory_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination for daily_inventory -->
                <nav class="mt-5">
                    <ul class="pagination justify-content-end">
                        <li class="page-item <?= ($page_inventory <= 1) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page_inventory=<?= $page_inventory - 1; ?>">Previous</a>
                        </li>
                        <?php for ($i = 1; $i <= $total_pages_inventory; $i++): ?>
                            <li class="page-item <?= ($page_inventory == $i) ? 'active' : ''; ?>">
                                <a class="page-link" href="?page_inventory=<?= $i; ?>"><?= $i; ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= ($page_inventory >= $total_pages_inventory) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page_inventory=<?= $page_inventory + 1; ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Stock Reduction Modal -->
    <div class="modal fade" id="stockReduceModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Product Used</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="reduceStockForm">
                        <input type="hidden" id="modalProductId">
                        <div class="mb-3">
                            <label class="form-label">Date used</label>
                            <input type="date" id="dateused" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stock</label>
                            <input type="number" id="reduceQuantity" class="form-control" value="1" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-danger">Confirm Reduction</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <script>
document.addEventListener("DOMContentLoaded", function () {
    let reduceStockForm = document.getElementById("reduceStockForm");

    if (reduceStockForm) {
        reduceStockForm.addEventListener("submit", function (e) {
            e.preventDefault();
            let productId = document.getElementById("modalProductId").value;
            let quantity = parseInt(document.getElementById("reduceQuantity").value);
            let dateUsed = document.getElementById("dateused").value; // Get selected date

            if (quantity > 0 && dateUsed) {
                updateStock(productId, quantity, "decrease", dateUsed);
                let modal = bootstrap.Modal.getInstance(document.getElementById("stockReduceModal"));
                modal.hide();
            } else {
                alert("Please enter a valid quantity and date.");
            }
        });
    }
});

function updateStock(productId, quantity, action, dateUsed = "") {
    if (action === 'increase' && !confirm(`Are you sure you want to add ${quantity} items?`)) {
        return;
    }

    let requestBody = `productId=${productId}&quantity=${quantity}&action=${action}`;
    if (dateUsed) {
        requestBody += `&dateUsed=${dateUsed}`;
    }

    fetch('../Handler_connection/update_stock.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: requestBody
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            let stockElement = document.getElementById(`stock-${productId}`);
            if (stockElement) {
                let currentStock = parseInt(stockElement.innerText) || 0;
                let newStock = (action === 'increase') ? currentStock + quantity : Math.max(currentStock - quantity, 0);
                stockElement.innerText = newStock;
                stockElement.style.color = (newStock < 30) ? 'red' : 'black';
            }

            // Update inventory table dynamically
            updateInventoryTable(data.inventory);
        } else {
            alert("Failed to update stock: " + (data.error || "Unknown error."));
        }
    })
    .catch(error => console.error("Error:", error));
}

// Function to update inventory table dynamically
function updateInventoryTable(inventoryData) {
    let inventoryTableBody = document.querySelector("tbody");
    if (!inventoryTableBody) return;

    inventoryTableBody.innerHTML = ""; // Clear existing rows

    inventoryData.forEach(row => {
        let tr = document.createElement("tr");
        tr.innerHTML = `
            <td>${row.productname}</td>
            <td>${row.stock_used}</td>
            <td>${row.date_used}</td>
            <td>
                <a href="Inventory.php?delete_inventory_id=${row.inventory_id}" class="btn btn-danger btn-sm">Delete</a>
            </td>
        `;
        inventoryTableBody.appendChild(tr);
    });
}

function openReduceModal(productId) {
    document.getElementById("modalProductId").value = productId;
    let modal = new bootstrap.Modal(document.getElementById("stockReduceModal"));
    modal.show();
}
</script>

</body>
</html>


