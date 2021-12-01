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



<style>
.imgContainer {
  display: flex;
  justify-content: center;
  align-items: center;
    width: 100%; 
    height: 250px;
}
.imgContainer img {
    max-width: 50%;
    max-height: 100%;
}
</style>

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

    <!-- Start Slider -->
    <div id="slides-shop" class="cover-slides">
        <ul class="slides-container">
            <li class="text-center">
                <img src="images/banner-01.jpg" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong><?php echo $storeName; ?></strong></h1>
                            <p class="m-b-40"><?php echo $storeTagline; ?></p>
                            <p><a class="btn hvr-hover" href="shop.php">Shop Now</a></p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <!-- End Slider -->

    <!-- Start Categories  -->
    <div class="categories-shop">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Categories</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                    <?php 
                    $category = mysqli_query($con,"SELECT * FROM category ORDER by id DESC");
                    while($cat_details = mysqli_fetch_array($category)){
                        $cat = $cat_details['id'];
                        $prod = mysqli_query($con,"SELECT * FROM products WHERE category_id = '$cat'");
                        $product = mysqli_fetch_array($prod);
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                    <div class="shop-cat-box">
                        <?php 
                        if(mysqli_num_rows($prod) >= 1){
                            ?>
                            <div class='imgContainer'>
                        <img class="img-fluid" src="images/<?php echo $product['photo']; ?>"/>
                </div>
                            <?php
                        } else {
                            ?>
                            <div class='imgContainer'>
                            <img class="img-fluid" src="images/default.jpg"/>
                </div>

                            <?php
                        }
                        ?>
                        <a class="btn hvr-hover" href="shop.php?cat=<?php echo $cat; ?>"><?php echo $cat_details['name']; ?></a>
                    </div>
                </div>
                    <?php 
                    }
                    ?>
            </div>
        </div>
    </div>
    <!-- End Categories -->

    <div class="box-add-products">
        <div class="container">
            <div class="row">
                
            <?php 
                    $market = mysqli_query($con,"SELECT * FROM marketing WHERE marketing_id = '2'");
                    while($marketing = mysqli_fetch_array($market)){
                    ?>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <a href="shop-sale.php">
                    <div class="offer-box-products">
                        <img class="img-fluid" src="images/<?php echo $marketing['marketing_image']; ?>" alt="" />
                    </div>
                    </a>
                </div>
                <?php } ?>
                
                
            <?php 
                    $market = mysqli_query($con,"SELECT * FROM marketing WHERE marketing_id = '1'");
                    while($marketing = mysqli_fetch_array($market)){
                    ?>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <a href="shop-featured.php">
                    <div class="offer-box-products">
                        <img class="img-fluid" src="images/<?php echo $marketing['marketing_image']; ?>" alt="" />
                    </div>
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Start Products  -->
    <div class="products-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Shop</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="special-menu text-center">
                        <div class="button-group filter-button-group">
                            <button class="active" data-filter="*">All</button>
                            <!-- <button data-filter=".featured">Featured</button>
                            <button data-filter=".sale">Sale</button> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="row special-list">
                    <?php 
                    include ('includes/products-index.php');
                    
                    ?>
            </div>
            <div class="text-center">
                <a href="shop.php" class="btn btn-warning text-white">View more</a>
            </div>
        </div>
    </div>
    <!-- End Products  -->

<?php include ('includes/footer.php'); ?>