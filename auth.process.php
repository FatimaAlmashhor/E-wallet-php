<?php
include './controller/authClass.php';
session_start();
$authQuery = new Auth;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    unset($_SESSION['auth_alart']);
    if (isset($_GET['do']) &&  $_GET['do'] == 'login') {
        if (isset($_POST['email'])) {
            $password = $_POST['password']; // normal password ;
            $email = $_POST['email'];
            $checkUse = $authQuery->login($email);
            if ($checkUse) {
                $decrypted = password_verify($password, $checkUse['auth_password']);
                $_SESSION['auth'] = $email;
                unset($_SESSION['show_model']);
                unset($_SESSION['payment_state']);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                $_SESSION['auth_alart'] = 'No user found . If you new here you can create new account ';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    }
    if (isset($_GET['do']) &&  $_GET['do'] == 'register') {
        if (isset($_POST['email'])) {
            $password = $_POST['password'];;
            $cpassword = $_POST['cpassword'];;
            $email = $_POST['email'];
            $fullname = $_POST['fullname']; // normal password ;

            if ($password === $cpassword) {
                $crypted = password_hash($password, PASSWORD_DEFAULT);
                $done = $authQuery->register($fullname, $email, $crypted);
                if (!$done) {
                    $_SESSION['auth_alart'] = 'This email already exist';
                } else {
                    $_SESSION['auth'] = $email;
                }
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                unset($_SESSION['show_model']);
                unset($_SESSION['payment_state']);
            }
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['do']) &&  $_GET['do'] == 'logout') {
        echo "<h1>logout</h2>";
        unset($_SESSION['auth']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}