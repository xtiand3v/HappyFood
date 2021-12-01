<?php 
session_start();
ob_start();
include 'includes/config.php';

if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    $rec = mysqli_query($con,"UPDATE orders SET order_status = 'Completed' WHERE order_id = '$order_id'");
    if($rec){
        $_SESSION['success'] = 'Order Completed. ';
        ?>
        <script>
            window.location.href = "orders.php"
        </script>
        <?php
    } else {
        $_SESSION['error'] = 'Failed to received item';

    } 
}
?>