<?php 
include "../helpers/not_authenticated.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../js/bootstrap.bundle.js" defer>
    <link rel="stylesheet" href="../js/bootstrap.js">
    <title>Login</title>
</head>
<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Registration</h2>
                                <p class="text-white-50 mb-5">Create your Account</p>
                                <?php if (isset($_SESSION['errors'])): 
                                ?>
                                <div class="alert alert-danger">
                                                 <?php
                                                     echo $_SESSION['errors'];
                                                     unset($_SESSION['errors']);
                                                ?>
                                </div>
                                <?php 
                                     endif; 
                                 ?>
                                <form action="../Handler_connection/Register_handler.php" method="POST">
                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="user" class="form-control form-control-lg" name="username" placeholder="Username" required/>
                                        <label class="form-label" for="user">Username</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="Password" class="form-control form-control-lg" name="password" placeholder="Password" required/>
                                        <label class="form-label" for="Password">Password</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="Confirm" class="form-control form-control-lg" name="confirm_password" placeholder="Confirm Password" required/>
                                        <label class="form-label" for="Confirm">Confirm Password</label>
                                    </div>

                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Register</button>
                            </div>  
                        </form>
                            <div>
                                <p class="mb-0">I have Account
                                    <a href="log-in.php" class="text-white-50 fw-bold">Log-in</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
