<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_SESSION['auth'])) {
        echo 'authintication';
    } else {
        echo 'Login please';
        $_SESSION['show_model'] = 'login';
        header('location:cart.php');
    }
    if (isset($_GET['do']) && $_GET['do'] == 'closeModel') {
        unset($_SESSION['show_model']);
        // header('location:index.php');
    }
    if (isset($_GET['do']) && $_GET['do'] == 'registerModel') {
        $_SESSION['show_model'] = 'register';
        // header('location:index.php');
    }
    if (isset($_GET['do']) && $_GET['do'] == 'loginModel') {
        $_SESSION['show_model'] = 'login';
        // header('location:index.php');
    }
}