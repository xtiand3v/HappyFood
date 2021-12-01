<?php
    session_start();
    ob_start();
    include ('includes/config.php');
    include ('includes/header.php');
    include ('includes/system.php');

    ?>

    <body>
        <?php 
        include ('includes/topnav.php');
        include ('includes/mainnav.php');
        ?>

    <!-- Start Top Search -->
    <div class="top-search">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>
    <!-- End Top Search -->

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Register</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row new-account-login">
                <div class="col-sm-12 col-lg-12 mb-3">
                    <div class="title-left">
                        <h3>Create New Account</h3>
                    </div>
                    <form method="POST" class="mt-3 review-form-box" id="formRegister">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="InputName" class="mb-0">First Name</label>
                                <input type="text" class="form-control" id="InputName" name="firstname" placeholder="First Name"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputLastname" class="mb-0">Last Name</label>
                                <input type="text" class="form-control" id="InputLastname" name="lastname" placeholder="Last Name"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputAddress" class="mb-0">Address</label>
                                <input type="text" class="form-control" id="InputAddress" name="address" placeholder="Address"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputContact" class="mb-0">Contact</label>
                                <input type="number" class="form-control" id="InputContact" name="contact" placeholder="Phone Number"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputEmail1" class="mb-0">Email Address</label>
                                <input type="email" class="form-control" id="InputEmail1" name="email" placeholder="Enter Email"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputPassword1" class="mb-0">Password</label>
                                <input type="password" class="form-control" id="InputPassword1" name="password" placeholder="Password"> </div>
                        </div>
                        <input type="submit" name="register" value="Register" class="btn hvr-hover text-white float-right">
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->
    <?php 
    if(isset($_POST['register'])){
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $password = md5($_POST['password']);
        $date = date("Y-m-d");

        $query = mysqli_query($con,"SELECT * FROM users WHERE email = '$email'");
        if(mysqli_num_rows($query) >= 1){
            $_SESSION['error'] = 'Email address already registered in the database. Please try another email';
        } else {
            $insert = mysqli_query($con,"INSERT into users(email,password,type,firstname,lastname,address,contact_info,photo,status,activate_code,reset_code,created_on) VALUES ('$email','$password','0','$fname','$lname','$address','$contact','cover.jpg','1','','','$date')");
            if($insert){
                $_SESSION['success'] = 'Registered successfully.';
                ?>
                <script>
                    window.location.href = "login.php"
                    </script>
                <?php
            }
        }
    }
    ?>
    <?php include ('includes/footer.php'); ?>