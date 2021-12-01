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
                    <h2>Checkout</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row new-account-login">
                <div class="col-sm-6 col-lg-6 mb-3 mx-auto">
                    <div class="title-left">
                        <h3>Account Login</h3>
                    </div>
                    <form class="mt-3 review-form-box" method="POST" id="formLogin">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="InputEmail" class="mb-0">Email Address</label>
                                <input type="email" class="form-control" id="InputEmail" name="email" placeholder="Enter Email"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputPassword" class="mb-0">Password</label>
                                <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Password"> </div>
                        </div>
                        <input type="submit" class="btn hvr-hover float-right text-white" name="login">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->

    <?php 
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $query = mysqli_query($con,"SELECT * FROM users WHERE email = '$email' AND password = '$password'");
        if(mysqli_num_rows($query) >= 1){
            $_SESSION['email'] = $email;
            $_SESSION['order'] = substr(md5(mt_rand()), 0, 6);
            ?>
            <script>
                    window.location.href = "index.php"
            </script>
            <?php
        } else {
            $_SESSION['error'] = 'Incorrect credentials. Please try again';
        }
    }
    ?>
    <?php include ('includes/footer.php'); ?>