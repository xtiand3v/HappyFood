<?php
	include 'includes/session.php';
	include 'includes/slugify.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$product = $_POST['edit_products'];
		$sale = $_POST['edit_sale'];
		$expiration = $_POST['edit_expiration'];

		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("UPDATE discounts SET sale_name=:name, product_id=:product, sale_percent=:sale, sale_expire=:expiration WHERE discount_id=:id");
			$stmt->execute(['name'=>$name, 'product'=>$product, 'sale_percent'=>$sale, 'expiration'=>$expiration, 'id'=>$id]);
			$_SESSION['success'] = 'Discount updated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit discount form first';
	}

	header('location: discounts.php');

?>