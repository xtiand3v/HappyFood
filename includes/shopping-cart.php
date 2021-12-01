<?php
$order_id = $_SESSION['order'];
$cart = mysqli_query($con, "SELECT * FROM cart WHERE order_id = '$order_id' ORDER by cart_id DESC");

if (mysqli_num_rows($cart) >= 1) {
    while ($cart_desc = mysqli_fetch_array($cart)) {
        $prod_id = $cart_desc['product_id'];
        $prod = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM products WHERE id = '$prod_id'"));
?>
        <div class="media mb-2 border-bottom">
            <div class="media-body">
                <img src="images/<?php echo $prod['photo']; ?>" width="100" class="img-fluid">
                <a href="shop-detail.php"> Noodles</a>
                <div class="small text-muted">Price: Php  <?php echo $cart_desc['price']; ?> <span class="mx-2">|</span> Qty: <?php echo $cart_desc['quantity']; ?> <span class="mx-2">|</span> Subtotal: Php <?php echo $cart_desc['price'] * $cart_desc['quantity']; ?></div>
            </div>
        </div>

<?php
    }
} else {
    echo "<center><h3>No item added in cart.</h3></center>";
}
?>