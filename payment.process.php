<?php
session_start();
require('./controller/walletClass.php');
function closeModel()
{
    unset($_SESSION['show_model']);
    unset($_SESSION['payment_state']);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
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
                    if (isset($_SESSION['auth'])) {
                        if ($_SESSION['auth'][0]['wallet_balance'] >= $_GET['total']) {

                            $message = 'you can go to the next step';
                            $_SESSION['payment_state'] = ['state' => 'checkout', 'content' => $message];
                        } else {
                            $_SESSION['payment_state'] = ['state' => 'setmoney', 'content' => $message];
                        }
                    }
                } else {
                    $message = 'There is not enugh items in cart go to the please add some items ';
                    $_SESSION['payment_state'] = ['state' => 'prepare', 'content' => $message];
                }
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                // if ($_GET['total'] >= 0) {
                //     $message = '';
                // }
                // $_SESSION['payment_state'] = ['state' => 'prepare', 'content', $message];
            }
        }
    } else {
        echo 'Login please';
        $_SESSION['show_model'] = 'login';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    if (isset($_GET['do']) && $_GET['do'] == 'closeModel') {

        closeModel();
    }
    if (isset($_GET['do']) && $_GET['do'] == 'registerModel') {
        $_SESSION['show_model'] = 'register';
        // header('location:index.php');
    }
    if (isset($_GET['do']) && $_GET['do'] == 'loginModel') {
        $_SESSION['show_model'] = 'login';
        // header('location:index.php');
    }

    if (isset($_GET['do']) &&  $_GET['do']  == 'showBalance') {

        $_SESSION['payment_state']['state'] = 'setmoney';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    if (isset($_GET['do']) &&  $_GET['do']  == 'checkout') {
        if ($_GET['result'] == 'no') {
            closeModel();
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['do']) &&  $_GET['do']  == 'addBalance') {
        if (isset($_POST['balance']) && isset($_SESSION['auth'][0]['wallet_balance'])) {
            $newPrice = $_POST['balance'] + $_SESSION['auth'][0]['wallet_balance'];
            echo "<p> total price" . $newPrice . "</p>";
            $_SESSION['auth'][0]['wallet_balance'] = $newPrice;
            $walletQuery = new Wallet;
            $walletQuery->setBalance($newPrice, $_SESSION['auth'][0]['wallet_number']);
            print_r($_SESSION['auth']);
            $_SESSION['payment_state']['state'] = 'done';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}