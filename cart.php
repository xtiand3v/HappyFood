<?php
session_start();
ob_start();
include('includes/config.php');
include('includes/header.php');
include('includes/system.php');

?>

<body>
    <?php
    include('includes/topnav.php');
    include('includes/mainnav.php');
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
                    <h2>Cart</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <form method="GET">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-main table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Images</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th class="text-center">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include('cart-details.php');
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row my-5">
                    <div class="col-lg-6 col-sm-6">
                        <div class="coupon-box">
                            <!-- <div class="input-group input-group-sm">
                            <input class="form-control" placeholder="Enter your coupon code" aria-label="Coupon code" type="text">
                            <div class="input-group-append">
                                <button class="btn btn-theme" type="button">Apply Coupon</button>
                            </div>
                        </div> -->
                        </div>
                    </div>
                </div>

                <div class="row my-5">
                    <div class="col-lg-8 col-sm-12"></div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="order-box">
                            <h3>Order summary</h3>
                            <div class="d-flex">
                                <h4>Sub Total</h4>
                                <div class="ml-auto font-weight-bold"> Php <?php
                                                                            $total_q = mysqli_query($con, "SELECT SUM(price * quantity) AS totalsum FROM cart WHERE order_id = '$order_id'");
                                                                            $total_g = mysqli_fetch_array($total_q);

                                                                            echo number_format($total_g['totalsum'], 2);
                                                                            ?> </div>
                            </div>
                            <!-- <div class="d-flex">
                            <h4>Discount</h4>
                            <div class="ml-auto font-weight-bold"> Php 40 </div>
                        </div> -->
                            <hr class="my-1">

                            <div class="d-flex gr-total">
                                <h5>Grand Total</h5>
                                <div class="ml-auto h5"> Php <?php
                                                                $total_q = mysqli_query($con, "SELECT SUM(price * quantity) AS totalsum FROM cart WHERE order_id = '$order_id'");
                                                                $total_g = mysqli_fetch_array($total_q);

                                                                echo number_format($total_g['totalsum'], 2);
                                                                ?></div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="col-12 d-flex shopping-box">
                        <!-- <input type="submit" name="checkout" value="Checkout" class="ml-auto btn hvr-hover text-white btn-lg"> -->
                        <a href="checkout.php" class="ml-auto btn hvr-hover text-white btn-lg">Checkout</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Cart -->

    <?php include('includes/footer.php'); ?>