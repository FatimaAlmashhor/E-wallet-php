<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_SESSION['auth'])) {
        // header('Location: ' . $_SERVER['HTTP_REFERER']);
        if (isset($_GET['do']) && $_GET['do'] == 'placeOrder') {
            if (isset($_GET['total'])) {
                //   check the use ballence
                // todo 
                // 1- check if the cart is empty ->
                // 2- check if the ballenc >= the actual price
                // if yes  3- ask for more information address and wallet selection
                // if not then ask for add ballence 
                if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                    $message = 'There is enugh items in cart go to the next step';
                    $_SESSION['payment_state'] = ['state' => 'prepare', 'content', $message];
                } else {
                    $message = 'There is not enugh items in cart go to the please add some items ';
                    $_SESSION['payment_state'] = ['state' => 'prepare', 'content', $message];
                }
                if ($_GET['total'] >= 0) {
                    $message = '';
                }
                $_SESSION['payment_state'] = ['state' => 'prepare', 'content', $message];
            }
        }
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