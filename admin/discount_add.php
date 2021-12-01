<?php
	include 'includes/session.php';
	include 'includes/slugify.php';

	if(isset($_POST['add'])){
		$name = $_POST['name'];
		$products = $_POST['products'];
		$sale = $_POST['sale'];
		$expiration = $_POST['expiration'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM discounts WHERE product_id=:products");
		$stmt->execute(['products'=>$products]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Sale/Discount already exist';
		}
		else{
			try{
				$stmt = $conn->prepare("INSERT INTO discounts (sale_name,product_id, sale_percent, sale_expire) VALUES (:name, :products, :sale, :expiration)");
				$stmt->execute(['name'=>$name, 'products'=>$products, 'sale'=>$sale, 'expiration'=>$expiration]);
				$_SESSION['success'] = 'Sale/Discount added successfully';

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

	header('location: discounts.php');

?>