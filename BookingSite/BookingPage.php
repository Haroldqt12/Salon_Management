<?php 

include '../helpers/authenticated.php'   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="../js/bootstrap.bundle.js"defer></script>
    <script src="../js/bootstrap.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>SALON SERVICE SALES AND INVENTORY SYSTEM </title>
</head>
<style>
    .img{
        border-radius: 50%;
    }
</style>
<body>
    <nav class="navbar navbar-expand-lg bg-secondary navbar-dark">
        <div class="container mb-7">
            <img src="logo.jpg" class="img img-fluid" width="80" height="auto">
            <a class="navbar-brand fw-bold p-4">SALON SERVICE SALES AND INVENTORY SYSTEM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="HomeBooking.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="AboutBooking.php">ABOUT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="BookingPage.php">BOOKING</a>
                    </li>
                </ul>
                <div class="btn-group ms-auto">
                    <button type="button" class="btn btn-secondary dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user me-2"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a href="../Handler_connection/Log-out.php"><button class="dropdown-item" type="button">LOG-OUT</button></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="container">
    <div class="col py-5">
        <div class="card p-4 shadow">
            <h3>BOOKING FORM</h3>
            <form action="save_booking.php" method="POST"> <!-- Form inside the card -->
                <div class="row mt-3">
                    <div class="col-sm-5 offset-1"> <!-- Adjusted column width -->
                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-5 offset-1"> 
                        <div class="form-group">
                            <label for="number">Contact No.</label>
                            <input type="text" name="number" id="number" class="form-control" required minlength="11" maxlength="11">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-5 offset-1"> <!-- Adjusted column width -->
                        <div class="form-group">
                            <label for="hair">Hair History</label>
                            <textarea name="hair" id="hair" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>
                <div class="row mt-5">
                    <div class="col-sm-5 offset-1">
                        <button class="btn btn-sm btn-primary" name="savebook">Confir m</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


</body>
</html>