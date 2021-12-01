<?php 
	session_start();
  ob_start();
	include '../includes/conn.php';
   ?>
<?php
  if(isset($_SESSION['admin'])){
    header('location: home.php');
  }
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition login-page" style="background: linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.4)),  url('../images/all-bg-title.jpg');background-size: cover;background-repeat: no-repeat">
<div class="login-box">
  	<?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='callout callout-danger text-center'>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }
      if(isset($_SESSION['success'])){
        echo "
          <div class='callout callout-success text-center'>
            <p>".$_SESSION['success']."</p> 
          </div>
        ";
        unset($_SESSION['success']);
      }
    ?>
  	<div class="login-box-body">
      <h1 class="display-2 text-center">Admin Login</h1>
    	<p class="login-box-msg">Sign in to start your session</p>

    	<form method="POST">
      		<div class="form-group has-feedback">
        		<input type="email" class="form-control" name="email" placeholder="Email" required>
        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
      		<div class="row">
    			<div class="col-xs-4">
          			<input type="submit" class="btn btn-primary btn-block btn-flat" name="login" value="Sign In">
        		</div>
      		</div>
    	</form>
      <br>
  	</div>
</div>
	
<?php include 'includes/scripts.php' ?>
</body>
</html>
<?php 

if(isset($_POST['login'])){
		
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  
  try{

    $stmt = mysqli_query($con,"SELECT * FROM users WHERE email = '$email' AND password ='$password'");
    $row = mysqli_fetch_array($stmt);
    if(mysqli_num_rows($stmt) > 0){
            $_SESSION['admin'] = $row['id'];
            header('location: home.php');
    }
    else{
      $_SESSION['error'] = 'Incorrect credentials. Please try again';
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