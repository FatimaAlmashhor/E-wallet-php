<?php
include './templates/head.php';
?>

<body class="bg-lighter_blue overflow-x-hidden">
    <?php
    session_start();
    include './templates/header.php';
    if (isset($_SESSION['show_model']) || isset($_SESSION['payment_state'])) {
        include './model.php';
    }
    ?>

    <!-- hero section  -->
    <section id='hero' class="relative h-screen w-full ">
        <div class="relative random-element w-4/12 h-32 rounded-full bg-secondary_blue bg-opacity-20" style="
        left: -40px;
        "></div>

        <!-- main part in the hero section -->
        <div class="flex w-full h-fit px-2 md:px-12 lg:px-32 items-center">
            <div class="w-64">
                <h1 class="text-5xl my-3 ">E-Wallet </h1>
                <p class="my-3 text-gray-400"> Here you can shopping without warray about hte BTS </p>

                <button class="bg-primary_blue px-3 py-2 rounded-full border-4 border-white text-white my-3">
                    Get started
                </button>
            </div>
            <div class=" hidden md:flex  flex-col w-full h-full justify-center mx-12">
                <div class=" flex self-end w-6/12 h-52 bg-secondary_blue rounded-full">
                    <img style="height:150%; width:auto; top:-10px;right:0px " class="relative"
                        src='./public/images/Other 19.png' />
                </div>
                <div class="w-5/12 h-48 bg-secondary_blue rounded-full">
                    <img src='./public/images/Other 17.png' />
                </div>
            </div>
        </div>

        <div class="absolute random-element w-5/12 h-32 rounded-full bg-secondary_blue bg-opacity-20" style="
        right: -40px;
        "></div>

    </section>
    <section class="my-10">
        <?php
        include './templates/products.php';
        ?>
    </section>




    </html>