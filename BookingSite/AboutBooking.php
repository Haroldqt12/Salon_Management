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
                        <a class="nav-link active" aria-current="page" href="AboutBooking.php">ABOUT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="BookingPage.php">BOOKING</a>
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
    
    <div class="color" style="background-color: aqua; min-height: 100vh; padding: 50px 0;">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-4 mx-auto d-flex flex-column justify-content-center">
                <img src="styles.jpg" class="img-fluid" alt="About Me" style="border-radius: 20%;">
            </div>
            <div class="col-md-6 d-flex flex-column justify-content-center">
                <h1 class="mb-3">About Us</h1>
                <p class="mb-3">
                    Welcome to Beauty Salon, where your beauty and well-being are our top priorities. Established in [Year], we have been providing exceptional beauty services to our clients, making them look and feel their best.
                </p>
            </div>
        </div>
        <div class="mt-5 mb-5">
            <h2 class="text-center mb-4">Our Services</h2>
        </div>

        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mt-5">
                    <div class="card p-3">
                    <img src="hair1.jpg" alt="" class="img-fluid d-block mx-auto" width="auto">
                    <p class="tex-center">"Ensure your hair receives the royal treatment with our luxurious hair care services, designed to nourish, rejuvenate, and add a brilliant shine to every strand."</p>
                    </div>
                </div>
                <div class="col-md-4 mt-5">
                    <div class="card p-3">
                    <img src="hair1.jpg" alt="" class="img-fluid d-block mx-auto" width="auto">
                    <p class="tex-center">"Ensure your hair receives the royal treatment with our luxurious hair care services, designed to nourish, rejuvenate, and add a brilliant shine to every strand."</p>
                    </div>
                </div>
                <div class="col-md-4 mt-5">
                    <div class="card p-3">
                    <img src="hair1.jpg" alt="" class="img-fluid d-block mx-auto" width="auto">
                    <p class="tex-center">"Ensure your hair receives the royal treatment with our luxurious hair care services, designed to nourish, rejuvenate, and add a brilliant shine to every strand."</p>
                    </div>
                </div>
                <div class="col-md-4 mt-5">
                    <div class="card p-3">
                    <img src="hair1.jpg" alt="" class="img-fluid d-block mx-auto" width="auto">
                    <p class="tex-center">"Ensure your hair receives the royal treatment with our luxurious hair care services, designed to nourish, rejuvenate, and add a brilliant shine to every strand."</p>
                    </div>
                </div>
                <div class="col-md-4 mt-5">
                    <div class="card p-3">
                    <img src="hair1.jpg" alt="" class="img-fluid d-block mx-auto" width="auto">
                    <p class="tex-center">"Ensure your hair receives the royal treatment with our luxurious hair care services, designed to nourish, rejuvenate, and add a brilliant shine to every strand."</p>
                    </div>
                </div>
                <div class="col-md-4 mt-5">
                    <div class="card p-3">
                    <img src="hair1.jpg" alt="" class="img-fluid d-block mx-auto" width="auto">
                    <p class="tex-center">"Ensure your hair receives the royal treatment with our luxurious hair care services, designed to nourish, rejuvenate, and add a brilliant shine to every strand."</p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

</body>
</html>