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
                    <h2>Cart Update</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Cart</a></li>
                        <li class="breadcrumb-item active">Cart Edit</li>
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
                
$cart = mysqli_query($con,"SELECT * FROM cart WHERE cart_id = '$prod_id'");
$carts = mysqli_fetch_array($cart);
$prodid = $carts['product_id'];
$products = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM products WHERE id = '$prodid'"));
                ?>
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active"> 
                                <img class="d-block w-100" src="images/<?php echo $products['photo']; ?>" alt="First slide"> </div>
                           
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">
                        <form method="POST">
                        <h2><?php echo $products['name']; ?></h2>
                        <h5> Php <?php echo number_format($products['price'],2); ?></h5>
                            <p>
                                <h4>Short Description:</h4>
                                <p><?php echo $products['description']; ?> </p>
                                <ul>
                                    <li>
                                        <div class="form-group quantity-box">
                                            <label class="control-label">Quantity</label>
                                            <input name="cart_id" value="<?php echo $carts['cart_id']; ?>" type="hidden">

                                            <input class="form-control" name="quantity" value="<?php echo $carts['quantity']; ?>" min="1" value="1" type="number">
                                        </div>
                                    </li>
                                </ul>

                                <div class="price-box-bar">
                                    <div class="cart-and-bay-btn">
                                        <input type="submit" name="update" value="Update cart" class="btn btn-md p-3 text-white font-weight-bold hvr-hover">
                                        <a class="btn p-3 btn-md hvr-hover" data-fancybox-close="" href="cart.php">Back to cart</a>
                                    </div>
                                </div>
                                </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- End Cart -->


    <?php include ('includes/footer.php'); ?>
    <?php 
    if(isset($_POST['update'])){
        $cart_id = $_POST['cart_id'];
        $qty = $_POST['quantity'];

        $update = mysqli_query($con,"UPDATE cart SET quantity = '$qty' WHERE cart_id = '$cart_id'");
        if($update){
            $_SESSION['success'] = 'Cart updated successfully';
            ?>
            <script>
                window.location.href = "cart.php"
                </script>
            <?php
        } else {
            $_SESSION['error'] = 'Failed to update cart';
            ?>
            <script>
                </script>
            <?php

        }
    }
    ?>