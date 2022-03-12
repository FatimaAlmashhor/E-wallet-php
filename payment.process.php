<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_SESSION['auth'])) {
        //   check the use ballence
        $_SESSION['payment_state'] = 'prepare';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        echo 'Login please';
        $_SESSION['show_model'] = 'login';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    if (isset($_GET['do']) && $_GET['do'] == 'closeModel') {
        unset($_SESSION['show_model']);
        unset($_SESSION['payment_state']);
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