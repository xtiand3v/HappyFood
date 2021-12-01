<?php 
session_start();
ob_start();
include 'config.php';

if(isset($_GET['total'])){
    $user_email = $_SESSION['email'];
    $total = number_format($_GET['total'],2);
    $name = $_GET['firstName']." ".$_GET['lastName'];
    $type = $_GET['type'];
    $order_id = $_SESSION['order'];
    $payment = $_GET['paymentMethod'];
    $insert = mysqli_query($con,"INSERT into orders(order_no,order_email,order_name,order_total,order_type,order_payment,order_status,order_added) VALUES ('$order_id','$user_email','$name','$total','$type','$payment','Pending',NOW())");
    if($insert){
        
    if($type == 'Delivery'){
        $delivery = $_GET['delivery_address'];
        mysqli_query($con,"INSERT into delivery(order_no,delivery_address,added) VALUES ('$order_id','$delivery',NOW())");
    }
    if($payment == 'GCash'){
        $gcash_name = $_GET['gcash_name'];
        $gcash_number = $_GET['gcash_num'];
    $totalpay = number_format($_GET['total'],2);
    $date = date('Y-m-d H:i:s');
        mysqli_query($con,"INSERT into gcash(order_no,gcash_name,gcash_no) VALUES ('$order_id','$gcash_name','$gcash_number')");
        
        
    //##########################################################################
    // ITEXMO SEND SMS API - PHP - CURL-LESS METHOD
    // Visit www.itexmo.com/developers.php for more info about this API
    //##########################################################################
    function itexmo($number, $message, $apicode, $passwd)
    {
        $url = 'https://www.itexmo.com/php_api/api.php';
        $itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
        $param = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($itexmo),
            ),
        );
        $context  = stream_context_create($param);
        return file_get_contents($url, false, $context);
    }
    //##########################################################################

    $msg = "You have paid P". $totalpay . " GCash for your order on Happy Food. \n \n";
    $results = itexmo($gcash_number, $msg, "TR-INNOC831344_QH8WX", "f\$ntc574l)");
    }
        unset($_SESSION["order"]);
        $_SESSION['order'] = substr(md5(mt_rand()), 0, 6);
        $_SESSION['success'] = 'Checked out successfully';
        ?>
        <script>
            window.location.href = "../thank-you.php"
            </script>
        <?php
    } else {
        $_SESSION['error'] = 'Failed to place order';
        ?>
        <script>
            window.location.href = "../checkout.php"
            </script>
        <?php

    }
}
?>