<?php
include '../controller/productsClass.php';
$productsQuery = new Products();
session_start();
$_SESSION['products'] = $productsQuery->getAllRows();
$products  = isset($_SESSION['products']) ? $_SESSION['products'] : [];

foreach ($products as $row) {
?>
<div class="card">
    <div class="card_warrper ">
        <div class="cart_image">
            <img <?php
                        if ($row['product_image'] == null)
                            echo "src='https://images.pexels.com/photos/3018845/pexels-photo-3018845.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500'";
                        else {
                            echo "src=uploads/" . $row['product_image'];
                        }
                        ?> />

        </div>
        <div>
            <div class="ycenter-xbetween">
                <h2>
                    <?php
                        echo $row['product_title'];
                        ?>
                </h2>
                <div class="actions">
                    <a href="products.php?do=edit&productid= <?php echo $row['product_id']; ?>">
                        <ion-icon class="edit-icon" name="create-outline"></ion-icon>
                    </a>
                    <a class="delete-icon" href='products.php?do=delete&productid= <?php echo $row['product_id']; ?>'>
                        <ion-icon name="close-circle-outline"></ion-icon>
                    </a>
                </div>
            </div>
            <p>
                <?php
                    echo $row['product_des'];
                    ?>
            </p>
            <p>$
                <?php
                    echo $row['product_price'];
                    ?>
            </p>
            <p>Qty :
                <?php
                    echo $row['product_qty'];
                    ?>
            </p>
        </div>
    </div>
</div>
<?php
}

?>