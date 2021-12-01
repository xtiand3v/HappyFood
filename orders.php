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
                    <h2>Orders</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">My Account</a></li>
                        <li class="breadcrumb-item active">Orders</li>
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
                            <?php
                            if (isset($_GET['order_id'])) {
                                $order_id = $_GET['order_id'];
                            ?>
                                <center>
                                    <h2>Order Details</h2>
                                    <small>Order ID: <?php echo $order_id; ?></small>
                                </center>
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <th>Images</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $q = mysqli_query($con, "SELECT * FROM cart WHERE order_id = '$order_id'");
                                        while ($row = mysqli_fetch_array($q)) {
                                            $product_id = $row['product_id'];
                                            $q1 = mysqli_query($con, "SELECT * FROM products WHERE id = '$product_id'");
                                            $row1 = mysqli_fetch_array($q1);
                                        ?>
                                            <tr>
                                                <td><img src="images/<?php echo $row1['photo']; ?>" width="100px" height="100px"></td>
                                                <td><?php echo $row1['name']; ?></td>
                                                <td><?php echo $row1['price']; ?></td>
                                                <td><?php echo $row['quantity']; ?></td>
                                                <td> Php <?php echo $row1['price'] * $row['quantity']; ?></td>
                                            </tr>
                                        <?php } ?>

                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Grand Total</td>
                                            <td> Php <?php
                                                        $total_q = mysqli_query($con, "SELECT SUM(price * quantity) AS totalsum FROM cart WHERE order_id = '$order_id'");
                                                        $total_g = mysqli_fetch_array($total_q);

                                                        echo number_format($total_g['totalsum'], 2);
                                                        ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-right">
                                    <a href="orders.php" class="btn btn-success">Back</a>
                                </div>
                            <?php
                            } else {

                            ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Order No</th>
                                            <th>Name</th>
                                            <th>Total</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Order Added</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $email = $_SESSION['email'];
                                        $orders = mysqli_query($con, "SELECT * FROM orders WHERE order_email = '$email' ORDER by order_id DESC");

                                        if (mysqli_num_rows($orders) >= 1) {
                                            while ($order = mysqli_fetch_array($orders)) {
                                        ?>

                                                <tr>
                                                    <td class="name-pr">
                                                        <a class="btn-link text-blue" href="orders.php?order_id=<?php echo $order['order_no']; ?>">Order #<?php echo $order['order_no']; ?></a>
                                                    </td>
                                                    <td class="name-pr">
                                                        <?php echo $order['order_name']; ?>
                                                    </td>
                                                    <td class="total-pr">
                                                        <p id="subtotal">Php <?php echo $order['order_total']; ?></p>
                                                    </td>
                                                    <td class="total-pr">
                                                        <p><?php echo $order['order_type']; ?></p>
                                                    </td>
                                                    <td class="total-pr">
                                                        <p>
                                                            <?php
                                                            if ($order['order_status'] == "Done") {
                                                                echo "<button class='btn btn-sm btn-success'>";
                                                            } elseif ($order['order_status'] == "Pending") {
                                                                echo "<button class='btn btn-sm btn-danger'>";
                                                            } elseif ($order['order_status'] == "Cancelled") {
                                                                echo "<button class='btn btn-sm btn-danger'>";
                                                            } else {
                                                                echo "<button class='btn btn-sm btn-info'>";
                                                            }
                                                            ?>
                                                            <?php echo $order['order_status']; ?></button></p>
                                                    </td>
                                                    <td class="total-pr">
                                                        <p><?php echo $order['order_added']; ?></p>
                                                    </td>
                                                    <td class="total-pr">
                                                        <?php
                                                        if ($order['order_status'] == "Done") {
                                                            ?>
                                                                <a href="received.php?order_id=<?php echo $order['order_id']; ?>" class='btn btn-sm btn-info'>Product Received</a>
                                                            <?php
                                                        } elseif ($order['order_status'] == "Pending") {
                                                            echo "<a class='btn btn-sm text-white btn-success disabled'>Product Received</a>";
                                                        } else {
                                                        ?>
                                                            <a disabled class='btn btn-sm btn-info text-white'>Product Received</a>
                                                        <?php
                                                        }
                                                        ?></p>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "<tr><td><center><h3>No orders found.</h3></center></tr></td>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <!-- End Cart -->

    <?php include('includes/footer.php'); ?>