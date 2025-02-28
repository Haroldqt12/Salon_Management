<?php
include "../database/connectiondb.php";

$sql = "SELECT * FROM product"; 
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error); // Debugging line to check errors
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    if (!empty($_POST['stocks']) && !empty($_POST['product_date']) && !empty($_POST['product_id'])) {
        $stocks = intval($_POST['stocks']);
        $date = $_POST['product_date'];
        $id = intval($_POST['product_id']);

        $updateStmt = $conn->prepare("UPDATE product SET stocks = ?, product_date = ? WHERE productId = ?");
        $updateStmt->bind_param('isi', $stocks, $date, $id);

        if ($updateStmt->execute()) {
            echo "<script>alert('Product updated successfully!'); window.location.href='Product.php';</script>";
        } else {
            echo "Error updating record: " . $updateStmt->error;
        }

        $updateStmt->close();
    } else {
        echo "<script>alert('Invalid input. Please provide all required fields.');</script>";
    }
}

$conn->close();
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .dropdown-menu .dropdown-item:hover {
            background-color: blue;
            color: white;
            transition: background-color 0.3s ease, color 0.3s ease;
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
                    <i class="fa-solid fa-user fa-3x"></i>
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        &nbsp; ADMIN
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
                        <a href="User-management.php" class="nav-link px-0">
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
                    <div class="card py-3">
                        <h3 class="lead"> Product Management</h3>
                        <div class="border border-dark"></div>
                     <div class="col py-2">
                  <div class="row justify-content-between">
                      <div class="col-sm-4">
                      <h3 class="">Add new Product</h3>
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
                              </div>
                                  <div class="row mt-5 justify-content-end">
                                      <div class="col-sm-2" >
                                          <button class="btn btn-sm btn-primary w-100">Confirm</button>
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
                                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                                        <tr>
                                                            <td><?= htmlspecialchars($row['productname']); ?></td>
                                                            <td><?= htmlspecialchars($row['stocks']); ?></td>
                                                            <td><?= htmlspecialchars($row['brand']); ?></td>
                                                            <td><?= htmlspecialchars($row['product_date']); ?></td>
                                                            <td>
                                                                <button class="btn btn-secondary btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editModal"
                                                                    data-id="<?= $row['productId']; ?>"
                                                                    data-stocks="<?= $row['stocks']; ?>"
                                                                    data-date="<?= $row['product_date']; ?>">
                                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                                </button>
                                                                <a href="../Handler_connection/DeleteProduct.php?id=<?php echo $row['productId']; ?>" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Update Product Modal -->
                                <form method="POST">
                                    <div class="modal fade" id="editModal" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Stocks</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="stocks">Stocks:</label>
                                                    <input type="number" id="stocks" name="stocks" class="form-control" required>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="date">Date Updating:</label>
                                                    <input type="date" id="date" name="product_date" class="form-control" required>
                                                </div>
                                                <input type="hidden" id="product_id" name="product_id">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="update" class="btn btn-primary">Save changes</button>
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
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".edit-btn").forEach(button => {
            button.addEventListener("click", function () {
                document.getElementById("stocks").value = this.getAttribute("data-stocks");
                document.getElementById("date").value = this.getAttribute("data-date");
                document.getElementById("product_id").value = this.getAttribute("data-id");
            });
        });
    });
    </script>
</body>
</html>
