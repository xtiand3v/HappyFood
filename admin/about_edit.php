<?php
	include 'includes/session.php';
	include 'includes/slugify.php';

	if(isset($_POST['edit'])){
		$id = '1';
		$name = $_POST['name'];
		// $slug = slugify($name);
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$description = $_POST['description'];
		$tagline = $_POST['tagline'];

		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("UPDATE system SET name=:name, address=:address, phone=:phone, email=:email, description=:description,tagline=:tagline WHERE id=:id");
			$stmt->execute(['name'=>$name, 'address'=>$address, 'phone'=>$phone, 'email'=>$email, 'description'=>$description, 'tagline'=>$tagline, 'id'=>$id]);
			$_SESSION['success'] = 'System updated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit about form first';
	}

	header('location: about.php');

?>