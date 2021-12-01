<?php
	include 'includes/session.php';

	if(isset($_GET['s'])){
		$status = $_GET['s'];
		$id = $_GET['id'];
		
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("UPDATE orders SET order_status = '$status' WHERE order_id=:id");
			$stmt->execute(['id'=>$id]);

			$_SESSION['success'] = 'Order updated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Failed to update order';
	}

	header('location: orders.php');
	
?>