<section class="my-20  px-11 md:px-20 ">
    <div class="flex w-full ">

        <!-- filter  -->
        <aside class="w-0 md:w-3/12 h-fit">
            <div class="p-3 mt-1 w-full h-full bg-white rounded-3xl">
                <h2>
                    Filter
                </h2>
            </div>
        </aside>
        <div class="products w-12/12 md:w-9/12 flex justify-start flex-wrap ">
            <?php
            include './controller/productsClass.php';
            $productsQuery = new Products();
            session_start();
            $_SESSION['products'] = $productsQuery->getAllRows();
            $products  = isset($_SESSION['products']) ? $_SESSION['products'] : [];
            foreach ($products as $row) {
            ?>
            <div class=" relative w-72 h-72 mx-2 my-2 rounded-3xl border-8 border-white ">
                <!-- the cart icon -->
                <div style="right:-26px;top:-20px"
                    class="absolute z-20 flex justify-center items-center  overflow-hidden w-12 h-12 cursor-pointer bg-red-400 hover:bg-red-300 p-2 rounded-full border-4 border-white transition-all">
                    <a>
                        <ion-icon class="text-white text-xl" name="cart-outline"></ion-icon>
                    </a>
                </div>
                <div class="w-full h-full relative rounded-3xl ">

                    <div class="w-full h-3/5 ">
                        <img class='w-full h-full object-cover rounded-t-2xl' <?php

                                                                                    if ($row['product_image'] == null)
                                                                                        echo "src='https://images.pexels.com/photos/3018845/pexels-photo-3018845.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500'";
                                                                                    else {
                                                                                        echo "src=uploads/" . $row['product_image'];
                                                                                    }
                                                                                    ?> />

                    </div>
                    <div class='p-2 w-full h-2/5  flex flex-col '>
                        <div class="flex w-full justify-between">
                            <h2 class="text-xl font-bold">
                                <?php
                                    echo $row['product_title'];
                                    ?>
                            </h2>
                            <h2 class="text-xl font-bold text-red-400">$
                                <?php
                                    echo $row['product_price'];
                                    ?>
                            </h2>
                        </div>
                        <p class="text-gray-500">
                            <?php
                                echo $row['product_des'];
                                ?>
                        </p>

                        <div
                            class="flex mx-10 justify-between px-1 py-1 justify-items-end justify-self-end border-2 border-blue-400  rounded-full">
                            <button
                                class="font-bold text-white p-1 w-8 h-8 border-2 border-white bg-blue-400 rounded-full flex justify-center items-center">
                                +
                            </button>
                            <div>4</div>
                            <button
                                class="font-bold text-white p-1 w-8 h-8 border-2 border-white bg-blue-400 rounded-full flex justify-center items-center">
                                -
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }

            ?>
        </div>
    </div>
</section>