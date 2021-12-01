<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("DELETE FROM featured WHERE featured_id=:id");
			$stmt->execute(['id'=>$id]);

			$_SESSION['success'] = 'Featured product deleted successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Select featured product to delete first';
	}

	header('location: featured.php');
	
?>