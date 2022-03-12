<?php
include './templates/head.php';
session_start();
$cart = isset($_SESSION['cart']) ? isset($_SESSION['cart']) : [];
?>

<body class="bg-lighter_blue overflow-x-hidden">
    <?php
    include './templates/header.php';
    ?>
    <div class="my-20 w-screan h-full  px-11 md:px-20">
        <div class="w-full h-full flex">
            <div class=" w-0 hidden lg:block lg:w-4/12 mx-4 mt-12">
                <div class="p-3   rounded-full border-8 border-white none_border__top_left">
                    <div class="flex justify-between">
                        <h1 class="text-2xl">Total Price : </h1>
                        <p class="text-2xl ">$456</p>
                    </div>
                </div>
            </div>

            <!-- here the line Items  -->
            <div class="w-12/12 lg:w-8/12 mx-7">
                <h1 class="text-3xl text-right mb-3">Cart Items</h1>
                <?php
                foreach ($cart as $key => $row) {
                ?>

                <div class="p-3   rounded-full my-4 border-8 border-white <?php
                                                                                if ($key % 2 == 0)  echo 'none_border__top_left';
                                                                                else echo 'none_border__top_right';
                                                                                ?>">
                    <div class="flex justify-between 
                    <?php
                    if ($key % 2 == 0)  echo '';
                    else echo 'flex-row-reverse';
                    ?>">
                        <!-- right part -->
                        <div>
                            <p class="text-xl text-red-400 font-bold">
                                $<?php echo $row['product_price'] ?>
                            </p>
                            <div
                                class="flex  justify-between px-1 py-1 justify-items-end justify-self-end border-2 border-blue-400  rounded-full">
                                <a href='cart.process.php?do=inc&productid=<?php
                                                                                echo $row['product_id'];
                                                                                ?>'
                                    class="font-bold text-white p-1 w-8 h-8 border-2 border-white bg-blue-400 rounded-full flex justify-center items-center">
                                    +
                                </a>
                                <div>
                                    <?php

                                        echo  $row['qty'];
                                        ?>
                                </div>
                                <a
                                    class="font-bold texae p-1 w-8 h-8 border-2 border-white bg-blue-400 rounded-full flex justify-center items-center">
                                    -
                                </a>
                            </div>
                        </div>
                        <div class="flex <?php
                                                if ($key % 2 == 0)  echo 'flex-row-reverse';
                                                else echo '';
                                                ?> ">
                            <div class="rounded-full border-4 border-blue-400  overflow-hidden  w-24 h-24">
                                <img class='w-full h-fit object-contain' <?php

                                                                                if ($row['product_image'] == null)
                                                                                    echo "src='https://images.pexels.com/photos/3018845/pexels-photo-3018845.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500'";
                                                                                else {
                                                                                    echo "src=uploads/" . $row['product_image'];
                                                                                }
                                                                                ?> />

                            </div>
                            <div>
                                <h2 class="text-xl">
                                    <?php
                                        echo $row['product_title'];
                                        ?>
                                </h2>

                            </div>
                        </div>
                    </div>
                </div>
                <?php }; ?>
            </div>
        </div>
    </div>
</body>

</html>