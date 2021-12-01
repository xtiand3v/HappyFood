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
                    <h2>Shop Detail</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Shop Detail </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <?php
                $prod_id = $_GET['id'];

                $prods = mysqli_query($con, "SELECT * FROM products WHERE id = '$prod_id'");
                $products = mysqli_fetch_array($prods);

                $prodid = $products['id'];
                $sale = mysqli_query($con, "SELECT * FROM discounts WHERE product_id = '$prodid'");
                $discount = mysqli_fetch_array($sale);
                $percent = $discount['sale_percent'];
                $subtotaldisc = floatval($percent) / 100.00;
                $totaldisc = $products['price'] * $subtotaldisc;
                $new_price = $products['price'] - $totaldisc;
                ?>
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="images/<?php echo $products['photo']; ?>" alt="First slide">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">
                        <form method="POST">
                            <h2><?php echo $products['name']; ?></h2>
                            <h5>Php <?php
                                    if (mysqli_num_rows($sale) >= 1) {
                                    ?>
                                    <del><?php echo number_format($products['price'], 2); ?></del> <?php
                                                                                                    echo number_format($new_price, 2);
                                                                                                    ?>

                                <?php
                                    } else {
                                        echo number_format($products['price'], 2);
                                    } ?>
                            </h5>
                            <!-- <p class="available-stock"><span> More than 20 available </span> -->
                            <p>
                            <h4>Short Description:</h4>
                            <p><?php echo $products['description']; ?> </p>
                            <ul>
                                <li>
                                    <div class="form-group quantity-box">
                                        <label class="control-label">Quantity</label>
                                        <input name="prodid" value="<?php echo $_GET['id']; ?>" type="hidden">
                                        <input name="price" value="<?php echo $new_price; ?>" type="hidden">
                                        <input class="form-control" min="1" value="1" name="quantity" type="number">
                                    </div>
                                </li>
                            </ul>

                            <div class="price-box-bar">
                                <div class="cart-and-bay-btn">
                                    <?php
                                    if (isset($_SESSION['email'])) {
                                    ?>
                                        <input type="submit" name="add" value="Add to cart" class="btn btn-md p-3 text-white font-weight-bold hvr-hover">
                                    <?php
                                    } else {
                                        echo '<a href="login.php" class="btn p-3 btn-md hvr-hover">Login to Buy</a>';
                                    }
                                    ?>
                                    <a class="btn p-3 btn-md hvr-hover" data-fancybox-close="" href="shop.php">Back to shop</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="card card-outline-secondary my-4 w-100">
                    <div class="card-header">
                        <h2>Product Reviews</h2>
                    </div>
                    <div class="card-body">
                        <?php include('includes/reviews.php'); ?>
                    </div>

                    <div class="text-center mb-3">
                        <?php if (isset($_SESSION['email'])) { ?>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addReview">Leave a Review</button>
                        <?php } else { ?>
                            <p>Please <a class="btn btn-xs btn-success" href="login.php">LOGIN</a> to leave a review</p>
                        <?php } ?>
                    </div>
                </div>
            </div>



        </div>
    </div>
    <!-- End Cart -->


    <?php include('includes/footer.php'); ?>
    <?php include('includes/review_modal.php'); ?>

    <?php

    if (isset($_POST['add'])) {
        $prod_id = $_POST['prodid'];
        $user_email = $_SESSION['email'];
        $price = $_POST['price'];
        $order_id = $_SESSION['order'];
        $quantity = $_POST['quantity'];
        $check_cart = mysqli_query($con, "SELECT * FROM cart WHERE product_id = '$prod_id' AND order_id = '$order_id'");
        if (mysqli_num_rows($check_cart) >= 1) {
            $_SESSION['error'] = "Item already in cart! Head to cart to edit quantity.";
    ?>
            <script>
                location.href = location.href
            </script>
            <?php
        } else {

            $insert_cart = mysqli_query($con, "INSERT into cart(order_id,user_email,product_id,quantity,price,checkout) VALUES ('$order_id','$user_email','$prod_id','$quantity','$price','0')");
            if ($insert_cart) {
                mysqli_query($con, "INSERT into details(sales_id,product_id,quantity) VALUES ('$order_id','$prod_id','$quantity')");
                $_SESSION['success'] = "Item added to cart!";
            ?>
                <script>
                    location.href = location.href
                </script>
            <?php
            } else {
                $_SESSION['error'] = "Error adding item to cart!";
            ?>
                <script>
                    location.href = location.href
                </script>
    <?php

            }
        }
    }
    ?>