    <!-- Start Main Top -->
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                    <a class="navbar-brand" href="index.php"><img src="images/logo.png" class="logo" alt=""></a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item <?= ($activePage == 'index') ? 'active':''; ?>"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item <?= ($activePage == 'about') ? 'active':''; ?>"><a class="nav-link" href="about.php">About Us</a></li>
                        <li class="nav-item <?= ($activePage == 'shop') ? 'active':''; ?>"><a class="nav-link" href="shop.php">Shop</a></li>
                        <?php 
                        if(isset($_SESSION['email'])){
                            ?>
                            <li class="nav-item <?= ($activePage == 'my-account') ? 'active':''; ?>"><a class="nav-link" href="my-account.php">My Account</a></li>

                            <?php
                        } else {
                            echo "";
                        }
                        ?>
                        <li class="nav-item <?= ($activePage == 'contact-us') ? 'active':''; ?>"><a class="nav-link" href="contact-us.php">Contact Us</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->

                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        <li class="side-menu">
                            <a href="#">
                                <i class="fa fa-shopping-bag"></i>
                        <?php 
                        if(isset($_SESSION['order'])){
                            $order_id = $_SESSION['order'];
                        } else {
                            $order_id = "0";
                        }
                        if(isset($_SESSION['email'])){

                            $user = $_SESSION['email'];
                        } else {
                            $user = '0';
                        }
                        $cart_count = mysqli_query($con, "SELECT * FROM cart WHERE order_id = '$order_id'");
                        ?>
                                <span class="badge"><?php echo mysqli_num_rows($cart_count); ?></span>
                                <p>My Cart</p>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End Atribute Navigation -->
            </div>
            <!-- Start Side Menu -->
            <div class="side">
                <a href="#" class="close-side"><i class="fa fa-times"></i></a>
                <li class="cart-box">
                    <ul class="cart-list">
                        <?php 
                        $cart = mysqli_query($con, "SELECT * FROM cart WHERE order_id = '$order_id' ORDER by cart_id DESC");
                        
                        if(mysqli_num_rows($cart) >= 1){
                            while($cart_desc = mysqli_fetch_array($cart)){
                            $prod_id = $cart_desc['product_id'];
                            $prod = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM products WHERE id = '$prod_id'"));
                            ?>
                            <li>
                                <a href="#" class="photo"><img src="images/<?php echo $prod['photo']; ?>" class="cart-thumb" alt="" /></a>
                                <h6><a href="#"><?php echo $prod['name']; ?> </a></h6>
                                <p><?php echo $cart_desc['quantity']; ?>x - <span class="price">Php <?php echo $prod['price'] * $cart_desc['quantity']; ?></span></p>
                            </li>

                            <?php
                        } } else {
                            echo "<center><h3>No item added in cart.</h3></center>";
                        }
                        ?>
                        <li class="total">
                            <a href="cart.php" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
                            <span class="float-right"><strong>Total</strong>: Php
                            <?php 
                            $total_q = mysqli_query($con,"SELECT SUM(price * quantity) AS totalsum FROM cart WHERE order_id = '$order_id'");
                            $total_g = mysqli_fetch_array($total_q);

                            echo number_format($total_g['totalsum'],2);
                            ?>
                        </span>
                        </li>
                    </ul>
                </li>
            </div>
            <!-- End Side Menu -->
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Main Top -->