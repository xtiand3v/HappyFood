<?php
$prods = mysqli_query($con, "SELECT * FROM products ORDER by id DESC");
while ($products = mysqli_fetch_array($prods)) {
?>
    <div class="list-view-box">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                <div class="products-single fix">
                    <div class="box-img-hover">
                        <div class="type-lb">
                            <p class="new">New</p>
                        </div>
                        <img src="images/<?php echo $products['photo']; ?>" class="img-fluid" alt="Image">
                        <div class="mask-icon">
                            <ul>
                                <li><a href="shop-detail.php?id=<?php echo $products['id']; ?>" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                <div class="why-text full-width">
                    <h4><?php echo $products['name']; ?></h4>
                    <h5>Php <?php echo number_format($products['price'], 2); ?></h5>
                    <!-- <h5> <del>Php  60.00</del> Php 40.79</h5> -->
                    <p><?php echo $products['description']; ?></p>

                    <a class="btn hvr-hover" href="includes/add-to-cart.php?id=<?php echo $products['id']; ?>&price=<?php echo $products['price']; ?>">Add to Cart</a>
                </div>
            </div>
        </div>
    </div>

<?php } ?>