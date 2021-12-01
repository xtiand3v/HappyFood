<?php
include 'config.php';
if (!isset($_GET['search']) && !isset($_GET['cat'])) {
    $prods = mysqli_query($con, "SELECT * FROM products ORDER by id DESC");
} elseif (isset($_GET['search'])) {
    $search = $_GET['search'];
    $prods = mysqli_query($con, "SELECT * FROM products WHERE name LIKE '%$search%' ORDER by id DESC");
} elseif (isset($_GET['cat'])) {
    $cat = $_GET['cat'];
    $prods = mysqli_query($con, "SELECT * FROM products WHERE category_id = '$cat' ORDER by id DESC");
} else {
    $prods = mysqli_query($con, "SELECT * FROM products ORDER by id DESC");
}
while ($products = mysqli_fetch_array($prods)) {
    $prodid = $products['id'];
    $featured = mysqli_query($con,"SELECT * FROM featured WHERE product_id = '$prodid'");
    if (mysqli_num_rows($featured) >= 1) {
?>

        <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
            <div class="products-single fix">
                <div class="box-img-hover">
                    <div class="type-lb">
                        <?php
                        if (mysqli_num_rows($featured) >= 1) {
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
                    <img src="images/<?php echo $products['photo']; ?>" class="img-fluid" alt="Image">
                    <div class="mask-icon">
                        <ul>
                            <li><a href="shop-detail.php?id=<?php echo $products['id']; ?>" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                        </ul>
                        <?php
                        if (isset($_SESSION['email'])) {
                        ?>
                            <a class="cart" href="includes/add-to-cart.php?id=<?php echo $products['id']; ?>&price=<?php echo $products['price']; ?>">Add to Cart</a>

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
                    <h5>Php <?php echo number_format($products['price'], 2);  ?>
                    </h5>
                </div>
            </div>
        </div>
<?php } else {
        echo "";
    }
} ?>