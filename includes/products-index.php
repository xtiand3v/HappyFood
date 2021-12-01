<?php 
$prods = mysqli_query($con,"SELECT * FROM products ORDER by id DESC LIMIT 4");
while($products = mysqli_fetch_array($prods)) {
    $prodid = $products['id'];
    $sale = mysqli_query($con,"SELECT * FROM discounts WHERE product_id = '$prodid'");
    $discount = mysqli_fetch_array($sale);
    $percent = $discount['sale_percent'];
    
    $featured = mysqli_query($con,"SELECT * FROM featured WHERE product_id = '$prodid'");
    $subtotaldisc = floatval($percent) / 100.00;
    $totaldisc = $products['price'] * $subtotaldisc;
    $new_price = $products['price'] - $totaldisc;

    if(mysqli_num_rows($sale) >= 1){
        $tag = "sale";   
        $final_price = $new_price;
    } elseif(mysqli_num_rows($featured) >= 1){
        $tag = "featured";
        $final_price = $products['price'];
    } else {
        $tag = "all";
        $final_price = $products['price'];
    }
?>

                <div class="col-lg-3 col-md-6 special-grid <?php echo $tag; ?>">
                    <div class="products-single fix">
                        <div class="box-img-hover">
                            <div class="type-lb">
                                <?php 
                                if(mysqli_num_rows($sale) >= 1){
                                    ?>
                                    <p class="sale">Sale <?php echo $discount['sale_percent']."% off"; ?></p>
                                    <?php

                                } elseif(mysqli_num_rows($featured) >= 1){
                                    ?>
                                    <p class="sale">Featured</p>
                                    <?php
                                    
                                } else {
                                    ?>
                                    <p class="sale">&nbsp</p>
                                    <?php
                                }
                                ?>
                            </div>
                            <img src="images/<?php echo $products['photo']; ?>" class="img-fluid" width="200" alt="Image">
                            <div class="mask-icon">
                                <ul>
                                    <li><a href="shop-detail.php?id=<?php echo $products['id']; ?>" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                </ul>
                                <?php 
                                if(isset($_SESSION['email'])){
                                    ?>
                                    <a class="cart" href="includes/add-to-cart.php?id=<?php echo $products['id']; ?>&price=<?php echo $final_price; ?>">Add to Cart</a>

                                    <?php
                                } else {
                                    ?>
                                    
                                <a class="cart" href="login.php">Login to order</a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="why-text">
                            <h4><?php echo $products['name']; ?></h4>
                            <h5>Php <?php 
                                if(mysqli_num_rows($sale) >= 1){ 
                                    ?>
                                    <del><?php echo number_format($products['price'],2); ?></del> <?php
                        echo number_format($new_price, 2);
                                    ?>

                                    <?php
                                 } 
                                 else { echo number_format($products['price'],2); } ?></h5>
                        </div>
                    </div>
                    </div>
                    <?php } ?>