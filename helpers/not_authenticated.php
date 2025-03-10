<?php
session_start();

if (isset($_SESSION['access_token']) || isset($_COOKIE['access_token'])) {
    if ($_SESSION['user_role'] == 'admin' && basename($_SERVER['PHP_SELF']) !== 'home.php') {
        header("Location: ../designforSalon/home.php");
    } elseif ($_SESSION['user_role'] !== 'admin' && basename($_SERVER['PHP_SELF']) !== 'HomeBooking.php') {
        header("Location: ../BookingSite/HomeBooking.php");
    }
    exit;
}
?>