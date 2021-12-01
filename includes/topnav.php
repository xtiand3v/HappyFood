<!-- Start Main Top -->
<div class="main-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="our-link">
                       <?php 
                       if(isset($_SESSION['email'])){
                           ?>
                        <ul>
                            <li>Welcome, <?php echo $_SESSION['email']; ?></li>
                        </ul>
                           <?php
                       }
                           ?>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="login-box d-inline-flex">
                       <?php 
                       if(isset($_SESSION['email'])){
                           ?>
                           <a class="btn btn-warning text-white" href="my-account.php">My Account</a>  &nbsp&nbsp
                           <?php 
                           if(isset($_SESSION['order'])){
                            $order_id = $_SESSION['order'];
                        } else {
                            $order_id = "0";
                        }
                        $cartcount = mysqli_query($con, "SELECT * FROM cart WHERE order_id = '$order_id'");
                        
                        if(mysqli_num_rows($cartcount) >= 1){
                            ?>
                            <button type="button" class="btn btn-warning text-white" id="logout">Logout</button>
                            <?php
                        } else {
                            ?>
                           <a class="btn btn-warning text-white" href="logout.php">Logout</a>
                            <?php
                        }
                        ?>

                           <?php
                       } else {
                           ?>
                           <a class="btn btn-warning text-white" href="register.php">Register Here</a>  &nbsp&nbsp
                           <a class="btn btn-warning text-white" href="login.php">Sign In</a>

                           <?php
                       }
                       ?>
                    </div>
                    <div class="text-slid-box">
                        <div id="offer-box" class="carouselTicker">
                            <ul class="offer-box">
                                <?php 
    $sale = mysqli_query($con, "SELECT * FROM discounts ORDER by discount_id DESC");
    while($discount = mysqli_fetch_array($sale)){
    $percent = $discount['sale_percent'];
                                ?>
                                <li>
                                    <i class="fab fa-opencart"></i> <?php echo $percent; ?>% off Entire Purchase Promo Name: <?php echo $discount['sale_name']; ?>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Top -->