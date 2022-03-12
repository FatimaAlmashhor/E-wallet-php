<?php
// session_start();
include './controller/cartClass.php';
include './controller/productsClass.php';
$products = new Products();

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$cartQuery = new Cart(
    $cart
);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['do']) && $_GET['do']   == 'add') {
        $currentProduct = $products->getAllRows();
        // print_r($products);

        $cartQuery->setLineItem($currentProduct[trim($_GET['productid'])]);
        $_SESSION['cart'] =  $cartQuery->getLineItems();
        $_SESSION['total'] =  $cartQuery->totalPrice;

        $_SESSION['alert'] = 'The product added successfuly';
        header('location:index.php');
        // unset($_SESSION['cart']);
    }
    if (isset($_GET['do']) && $_GET['do']   == 'inc') {
        // $currentProduct = $products->getAllRows();
        // print_r($currentProduct[trim($_GET['productid'])]);

        $cartQuery->increaseItemQty(trim($_GET['productid']));
        $_SESSION['cart'] =  $cartQuery->getLineItems();
        $_SESSION['total'] =  $cartQuery->totalPrice;
        header('location:cart.php');
    }
    if (isset($_GET['do']) && $_GET['do']   == 'dec') {
        $cartQuery->descreaseItemQty(trim($_GET['productid']));
        $_SESSION['cart'] =  $cartQuery->getLineItems();
        $_SESSION['total'] =  $cartQuery->totalPrice;
        header('location:cart.php');
    }

    if (isset($_GET['do']) && $_GET['do']   == 'delete') {
        $cartQuery->deleteLineItem(trim($_GET['productid']));
        $_SESSION['cart'] =  $cartQuery->getLineItems();
        $_SESSION['total'] =  $cartQuery->totalPrice;
        header('location:cart.php');
    }
}