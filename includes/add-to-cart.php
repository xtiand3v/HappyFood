<?php 
session_start();
ob_start();
include 'config.php';

if(isset($_GET['id'])){
    $prod_id = $_GET['id'];
    $user_email = $_SESSION['email'];
    $price = $_GET['price'];
    $order_id = $_SESSION['order'];
    $quantity = '1';
    $check_cart = mysqli_query($con,"SELECT * FROM cart WHERE product_id = '$prod_id' AND order_id = '$order_id'");
    if(mysqli_num_rows($check_cart) >= 1){
        $quan = mysqli_fetch_array($check_cart);
        $add = $quan['quantity'] + 1;
        $cart_id = $quan['cart_id'];
        $update = mysqli_query($con,"UPDATE cart SET quantity = '$add' WHERE cart_id = '$cart_id'");
				$_SESSION['success'] = 'Cart updated! Quantity added.';
        ?>
        <script>
            window.location.href = "../shop.php"
        </script>
        <?php
    } else {

    $insert_cart = mysqli_query($con,"INSERT into cart(order_id,user_email,product_id,quantity,price,checkout) VALUES ('$order_id','$user_email','$prod_id','1','$price','0')");
    if($insert_cart){
        mysqli_query($con,"INSERT into details(sales_id,product_id,quantity) VALUES ('$order_id','$prod_id','$quantity')");
        $_SESSION['success'] = 'Added to cart';
        ?>
        <script>
            window.location.href = "../shop.php"
            </script>
        <?php
    } else {
        $_SESSION['error'] = 'Failed to add to cart.';
        ?>
        <script>
            window.location.href = "../shop.php"
            </script>
        <?php

    }
}
}
?>