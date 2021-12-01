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
                    <h2>Contact Us</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"> Contact Us </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Contact Us  -->
    <div class="contact-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="contact-form-right">
                        <h2>GET IN TOUCH</h2>
                        <div class="text-center">
                            <h3>You can send messages to our Facebook Account:<br>
                            <a href="https://www.facebook.com/EMSHappyFood" target="_blank" class="text-underlined btn-link">EMinistore: Happyfood</a><br>
                        or using the chat on the bottom right.</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="contact-info-left">
                        <h2>CONTACT INFO</h2>
                        <p>We are glad to serve you during our business hours (9am - 5pm).</p>
                        <ul>
                            <li>
                                <p><i class="fas fa-map-marker-alt"></i>Address: <?php echo $storeAddress; ?> </p>
                            </li>
                            <li>
                                <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:<?php echo $storePhone; ?>"><?php echo $storePhone; ?></a></p>
                            </li>
                            <li>
                                <p><i class="fas fa-envelope"></i>Email: <a href="mailto:<?php echo $storeEmail; ?>"><?php echo $storeEmail; ?></a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->


    <?php include ('includes/footer.php'); ?>