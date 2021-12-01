<?php
	include 'includes/session.php';
	include 'includes/slugify.php';

	if(isset($_POST['add'])){
		$name = $_POST['name'];
		$products = $_POST['products'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM featured WHERE product_id=:products");
		$stmt->execute(['products'=>$products]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Featured product already exist';
		}
		else{
			try{
				$stmt = $conn->prepare("INSERT INTO featured (featured_name,product_id) VALUES (:name, :products)");
				$stmt->execute(['name'=>$name, 'products'=>$products]);
				$_SESSION['success'] = 'Featured Product added successfully';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up product form first';
	}

	header('location: featured.php');

?>