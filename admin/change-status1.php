<?php
	include '../includes/conn.php';
    ob_start();

	if(isset($_GET['s'])){
		$status = $_GET['s'];
		$id = $_GET['id'];
        $user = $_GET['user'];
        $date = date("Y-m-d");
        $order = $_GET['order'];
		

			$stmt = mysqli_query($con,"UPDATE orders SET order_status = '$status' WHERE order_id= '$id'");
    if($stmt){
		$_SESSION['success'] = 'Order updated successfully';
        mysqli_query($con,"INSERT into sales(user_id,pay_id,sales_date) VALUES ('$user','$order','$date')");
        
	header('location: orders.php');
    }
	else{
		$_SESSION['error'] = 'Failed to update order';
        header('location: orders.php');
	}

	
}
?>