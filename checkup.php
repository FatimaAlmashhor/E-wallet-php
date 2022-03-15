<?php
include('./templates/head.php');
?>

<body class="bg-lighter_blue overflow-x-hidden">
    <?php
    session_start();

    include './templates/header.php';
    if (isset($_SESSION['show_model']) || isset($_SESSION['payment_state'])) {
        include './model.php';
    }
    ?>
    <section class="px-2 md:px-32 my-32 flex flex-col justify-center items-center">
        <h1 class="text-2xl my-5">
            Choose how to take your order ?!
        </h1>
        <div class="flex ">
            <div
                class="p-2 text-white cursor-pointer hover:bg-blue-400 bg-blue-300 w-44 h-32  rounded-md mx-3 flex justify-center items-center">
                Delivery </div>
            <div
                class="p-2 text-white cursor-pointer hover:bg-blue-400 bg-blue-300 w-44 h-32  rounded-md mx-3 flex justify-center items-center">
                Pick up </div>
        </div>
        <div class="my-12 w-full flex justify-center">
            <form class="flex flex-col w-2/5" action="payment.process.php?do=checkout&verfiy" method="POST">
                <lable>Phone number </lable>
                <input class='p-2 ' type="phone" placeholder="Enter phone" name='phone' />
                <lable>City </lable>
                <input class='p-2' type="text" placeholder="Enter city name" name='city' />
                <lable>State </lable>
                <input class='p-2' type="text" placeholder="Enter state name" name='state' />
                <lable>Address </lable>
                <input class='p-2' type="text" placeholder="Enter address " name='address' />
                <button class="bg-blue-300 p-2 my-4 hover:bg-blue-400" type="submit">Checkout</button>
            </form>
        </div>
    </section>

</body>

</html>