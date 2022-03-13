<?php

?><nav class="w-screen h-16 fixed top-0 z-40">
    <div class=" px-11 md:px-28 flex w-full h-full justify-between items-center">
        <div class="logo">
            EWALLET
        </div>
        <div class=''>
            <ul class="flex">
                <?php
                if (isset($_SERVER['PHP_SELF']) && $_SERVER['PHP_SELF'] == '/e-wallet/cart.php') {
                ?>
                <a href="index.php"
                    class=" text-white font-bold flex justify-center items-center mx-1 w-fit h-12 cursor-pointer bg-primary_blue hover:bg-blue-400 p-2 px-3 rounded-full border-4 border-white transition-all">
                    Back to shop
                </a>
                <?php
                } else {
                ?>
                <a href="cart.php"
                    class=" flex justify-center items-center mx-1 w-12 h-12 cursor-pointer bg-primary_blue hover:bg-blue-400 p-2 rounded-full border-4 border-white transition-all">
                    <ion-icon class="text-white text-xl" name="bag-handle-outline"></ion-icon>
                </a>
                <?php
                } ?>
                <?php
                if (isset($_SESSION['auth'])) {
                ?>
                <div class="relative">
                    <button onclick="showDropdown()"
                        class=" flex justify-center items-center mx-3 w-12 h-12 cursor-pointer bg-primary_blue hover:bg-blue-400 p-2 rounded-full border-4 border-white transition-all">
                        <ion-icon class="text-white text-xl" name="person-circle-outline"></ion-icon>
                    </button>
                    <div id='auth_dropdown' class="absolute right-0 bottom-0 h-fit w-40  rounded-md bg-white"
                        style="bottom: -100px;">
                        <ul>
                            <li class=" p-2 cursor-pointer border-b border-gray-400 hover:bg-gray-200">Your Ballance
                            </li>
                            <a href='auth.process.php?do=logout'
                                class="w-full p-2 cursor-pointer hover:bg-gray-200">Logout
                            </a>
                        </ul>
                    </div>
                </div>

                <?php
                } else {
                ?>
                <li
                    class=" flex justify-center items-center mx-1 w-fit h-12 cursor-pointer bg-primary_blue hover:bg-blue-400 p-2 px-3 rounded-full border-4 border-white transition-all">
                    <a href='payment.process.php?do=login' class="text-white font-bold">
                        Login
                    </a>
                </li>
                <?php
                }
                ?>

            </ul>
        </div>
    </div>
</nav>
<script>
let dropdown = document.querySelector('#auth_dropdown');

function showDropdown() {
    console.log('clicked me');
    dropdown.style.displey = 'none';
}
</script>