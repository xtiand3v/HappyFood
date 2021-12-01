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
        $user_email = $_SESSION['email'];
        $user = mysqli_query($con,"SELECT * FROM users WHERE email = '$user_email'");
        $data = mysqli_fetch_array($user);
        ?>


    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container text-center">
            <div class="row">
                <div class="col-12 mx-auto">
                <h1 class="display-1">Thank you</h1>
                <h4>To view your orders and transactions, go to</h4>
                
            <div class="text-center">
                <a href="my-account.php" class="btn btn-warning text-white">My Account</a>
            </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->

    <?php include ('includes/footer.php'); ?>