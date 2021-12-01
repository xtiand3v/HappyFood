<?php 
session_start();
ob_start();
include 'includes/config.php';

if(isset($_GET['id'])){
    $cart = $_GET['id'];
    $del_cart = mysqli_query($con,"DELETE FROM cart WHERE cart_id = '$cart'");
    if($del_cart){
        $_SESSION['success'] = 'Item deleted successfully.';
        ?>
        <script>
            window.location.href = "cart.php"
        </script>
        <?php
    } else {
        $_SESSION['error'] = 'Failed to remove item';
        ?>
        <script>
        </script>
        <?php

    } 
}
?>