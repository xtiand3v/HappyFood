<?php
	include 'includes/session.php';

	if(isset($_POST['login'])){
		
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		
		try{

			$stmt = mysqli_query($con,"SELECT * FROM users WHERE email = '$email' AND password = '$password'");
			$row = mysqli_fetch_array($stmt);
			if($row['numrows'] >= 1){
							$_SESSION['admin'] = $row['id'];
							header('location: home.php');
			}
			else{
				$_SESSION['error'] = 'Incorrect login. Please try again';
			}
		}
		catch(PDOException $e){
			echo "There is some problem in connection: " . $e->getMessage();
		}

	}
	else{
		$_SESSION['error'] = 'Input login credentials first';
	}


?>