<?php
	include 'includes/session.php';
	include 'includes/slugify.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$name = $_POST['edit_name'];
		$product = $_POST['edit_products'];

		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("UPDATE featured SET featured_name=:name, product_id=:product WHERE featured_id=:id");
			$stmt->execute(['name'=>$name, 'product'=>$product, 'id'=>$id]);
			$_SESSION['success'] = 'Featured product updated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit featured product form first';
	}

	header('location: featured.php');

?>