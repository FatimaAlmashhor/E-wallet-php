<?php
include './templates/head.php';
?>

<body class="bg-lighter_blue overflow-x-hidden">
    <?php
    session_start();
    include './templates/header.php';
    if (isset($_SESSION['show_model'])) {
        include './model.php';
    }
    include './templates/products.php';
    ?>


</body>

</html>