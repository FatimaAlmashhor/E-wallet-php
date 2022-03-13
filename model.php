<div class="  top-0 fixed mode w-screen h-screen flex justify-center items-center bg-black bg-opacity-60 z-50">
    <div class=" relative w-96 h-fil border-4 border-white p-3 rounded-md bg-white">
        <a href='payment.process.php?do=closeModel' style="top:-26px; left:-20px; " class=" absolute z-20 flex justify-center items-center overflow-hidden w-12 h-12
            cursor-pointer bg-red-400 hover:bg-red-300 p-2 rounded-full border-4 border-white transition-all">
            <ion-icon class="text-white font-bold" name="close-outline"></ion-icon>
        </a>
        <?php if (isset($_SESSION['show_model']) && $_SESSION['show_model'] == 'login') { ?>
        <div class="flex w-full flex-col justify-center items-center ">
            <h2 class="text-2xl">Login</h2>
            <form class="flex flex-col w-full" action="auth.process.php?do=login" method="POST">
                <label for='email'>Email</label>
                <input class='p-2 my-1 border border-gray-400 rounded' type="email" name='email'
                    placeholder="Enter your email " required />
                <label for='password'>Password</label>
                <input class='p-2 my-1 border border-gray-400 rounded' type="password" name='password'
                    placeholder="Enter your password " required />
                <?php
                    if (isset($_SESSION['auth_alart'])) {
                    ?>
                <div class="text-sm text-red-500">
                    <?php echo $_SESSION['auth_alart']; ?>
                </div>
                <?php
                    }
                    ?>
                <button class="my-2 p-2 rounded bg-blue-400 text-white" type="submit"> Login</button>
            </form>
            <p>
                You do not have an account ?<a href='payment.process.php?do=registerModel' class="text-blue-400">
                    Register
                </a>
            </p>
        </div>
        <?php } ?>

        <?php if (isset($_SESSION['show_model']) && $_SESSION['show_model'] == 'register') { ?>
        <div class="flex w-full flex-col justify-center items-center ">
            <h2 class="text-2xl">Register</h2>
            <form class="flex flex-col w-full" action='auth.process.php?do=register' method="POST">
                <label for='email'>Full Name</label>
                <input class='p-2 my-1 border border-gray-400 rounded' type="text" name='fullname'
                    placeholder="Enter your full anme " required />
                <label for='email'>Email</label>
                <input class='p-2 my-1 border border-gray-400 rounded' type="email" name='email'
                    placeholder="Enter your email " required />
                <label for='password'>Password</label>
                <input class='p-2 my-1 border border-gray-400 rounded' type="password" name='password'
                    placeholder="Enter your password " required />
                <label for='cpassword'>Confirm Password</label>
                <input class='p-2 my-1 border border-gray-400 rounded' type="password" name='cpassword'
                    placeholder="Enter your password " required />
                <?php
                    if (isset($_SESSION['auth_alart'])) {
                    ?>
                <div class="text-sm text-red-500">
                    <?php echo $_SESSION['auth_alart']; ?>
                </div>
                <?php
                    }
                    ?>
                <button class="my-2 p-2 rounded bg-blue-400 text-white" type="submit"> Login</button>
            </form>
            <p>
                You do not have an account ?<a href='payment.process.php?do=loginModel' class="text-blue-400">
                    login
                </a>
            </p>
        </div>
        <?php } ?>

        <?php
        if (isset($_SESSION['payment_state']) && $_SESSION['payment_state'] == 'prepare') {
        ?>
        <div>
            <h1>The total price = <?php
                                        echo (isset($_SESSION['total']) ? isset($_SESSION['total']) : '0YE');
                                        ?></h1>
        </div>
        <?php
        }
        if (isset($_SESSION['payment_state']) && $_SESSION['payment_state'] == 'setmoney') {
            echo "
                <div>Add money </div>
            ";
        }
        if (isset($_SESSION['payment_state']) && $_SESSION['payment_state'] == 'done') {
            echo "
                <div>Payment done </div>
            ";
        }
        ?>
    </div>
</div>