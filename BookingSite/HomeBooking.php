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
    .custom-salon-img {
        width: 100%;
        max-height: 500px; 
        object-fit: cover; 
    }

    .text{
        font-size: 20px;
    }

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
                        <a class="nav-link active" href="HomeBooking.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="AboutBooking.php">ABOUT</a>
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
    

    <div class="container mt-5 mb-5">
        <img src="salon.jpg" class="img-fluid d-block mx-auto" alt="Salon Image">
    </div>    
    <div class="container mt-5 ">
        <h1 class="text-center text-lead p-3 mt-5">EXPERIENCE THE BEAUTY WITH US.</h1>
        <p class="text text-center lead">"Our salon is dedicated to making you look and feel your best,<br>
            providing top-notch services with a touch of elegance and care."</p>
    </div>

    <div class="d-flex justify-content-center align-items-center mt-5">
        <a href="BookingPage.php"><button class="btn btn-primary btn-lg">Book now</button></a>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row text-center">
            <div class="col-md-4 mt-5">
                <div class="card p-3">
                    <img src="hair1.jpg" alt="" class="img-fluid d-block mx-auto" width="auto">
                    <p class="tex-center">"Ensure your hair receives the royal treatment with our luxurious hair care services, designed to nourish, rejuvenate, and add a brilliant shine to every strand."</p>
                </div>
            </div>
            <div class="col-md-4 mt-5">
                <div class="card p-3">
                    <img src="hair2.jpg" alt="" class="img-fluid d-block mx-auto" width="auto">
                    <p class="text-center">Our salon team provides personalized attention and exceptional service, making every visit a delightful and memorable experience."</p>
                </div>
            </div>
            <div class="col-md-4 mt-5">
                <div class="card p-3">
                    <img src="emp1.jpg" alt="" class="img-fluid d-block mx-auto" width="auto">
                    <p>"Ensuring our team thrives in a positive and supportive environment, we prioritize ongoing training and development, empowering our employees to deliver exceptional service with confidence and dedication."</p>
                </div>
            </div>
        </div>

</body>
</html>