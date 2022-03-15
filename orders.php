<?php
include('./templates/head.php');
include('./controller/walletClass.php');
$sql = new Wallet();
?>

<body class="bg-lighter_blue overflow-x-hidden">
    <?php
    session_start();

    include './templates/header.php';
    if (isset($_SESSION['show_model']) || isset($_SESSION['payment_state'])) {
        include './model.php';
    }


    ?>
    <section class="px-2 md:px-12 lg:px-32 w-full  mt-32 flex flex-col justify-center items-center">

        <h1 class="text-2xl my-3">All your orders</h1>
        <div class="border border-gray-300 w-full p2 -">
            <?php
            $rows = $sql->getOrders();
            ?>

            <div class="w-full flex border-b border-gray-400 p-3">
                <div class="w-4/12 font-bold">
                    Date
                </div>
                <div class="w-4/12 font-bold">
                    Cost
                </div>
                <div class="w-4/12 font-bold">
                    your balance
                </div>
            </div>

            <?php
            foreach ($rows as $row) {
            ?>
            <div class="w-full flex border-b border-gray-400 p-3">
                <div class="w-4/12">
                    <?php echo $row['created_at'] ?>
                </div>
                <div class="w-4/12">
                    $<?php echo $row['total_price'] ?>
                </div>
                <div class="w-4/12">
                    $<?php echo $row['current_balance'] ?>
                </div>
            </div>
            <?php
            } ?>

        </div>
    </section>
</body>

</html>