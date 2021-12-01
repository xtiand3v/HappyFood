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
    $user_email = $_SESSION['email'];
    $user = mysqli_query($con, "SELECT * FROM users WHERE email = '$user_email'");
    $data = mysqli_fetch_array($user);
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
                    <h2>Checkout</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <form class="needs-validation" method="GET" action="includes/checkout-submit.php" novalidate>
        <div class="cart-box-main">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-6 mb-3">
                        <div class="checkout-address">
                            <div class="title-left">
                                <h3>Billing address</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">First name *</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="<?php echo $data['firstname']; ?>" required readonly>
                                    <div class="invalid-feedback"> Valid first name is required. </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">Last name *</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="<?php echo $data['lastname']; ?>" required readonly>
                                    <div class="invalid-feedback"> Valid last name is required. </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="username">Contact *</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="phone" value="<?php echo $data['contact_info']; ?>" placeholder="" required readonly>
                                    <div class="invalid-feedback" style="width: 100%;"> Your phone is required. </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $data['email']; ?>" placeholder="" readonly>
                                <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Address *</label>
                                <input type="text" class="form-control" id="address" placeholder="" value="<?php echo $data['address']; ?>" required>
                                <div class="invalid-feedback"> Please enter your shipping address. </div>
                            </div>
                            <div class="mb-3">
                                <label for="address2">Order *</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="Pickup">Pickup</option>
                                    <option value="Delivery" id="delivery">Delivery</option>
                                </select>
                            </div>
                            <div class="mb-3" id="limit" style="display: none;">
                                <code>*You need to have a min order of <b>Php 500</b> to select Delivery.</code>
                            </div>
                            <div class="mb-3" id="delivery_address" style="display: none;">
                                <label for="address2">Delivery Address</label>
                                <select name="delivery_address" class="form-control">
                                    <option value="Terra Alta Homes Paliparan I">Terra Alta Homes Paliparan I</option>
                                    <option value="Greenwoods Subdivision Dasmarinas or Greenwoods Village">Greenwoods Subdivision Dasmarinas or Greenwoods Village</option>
                                    <option value="Nostalji Enclave, Governor’s Drive, Dasmarinas">Nostalji Enclave, Governor’s Drive, Dasmarinas</option>
                                    <option value="Kohana Grove, Silang">Kohana Grove, Silang</option>
                                </select>
                            </div>
                            <hr class="mb-4">
                            <div class="title"> <span>Payment</span> </div>
                            <div class="d-flex my-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Cash" name="paymentMethod" id="cod" checked>
                                    <label class="form-check-label" for="cod">
                                        Cash
                                    </label>
                                </div>
                                <div class="form-check ml-5">
                                    <input class="form-check-input" type="radio" value="GCash" name="paymentMethod" id="gcash">
                                    <label class="form-check-label" for="gcash">
                                        GCash
                                    </label>
                                </div>

                            </div>

                            <div class="row" id="gcash_form" style="display: none">
                                <div class="col-md-6 mb-3">
                                    <label for="gcash_name">GCash Name *</label>
                                    <input type="text" class="form-control" id="gcash_name" name="gcash_name" placeholder="Ex. John Doe" required>
                                    <div class="invalid-feedback"> Valid GCash name is required. </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="gcash_num">GCash Number *</label>
                                    <input type="number" class="form-control" id="gcash_num" min="10" max="11" name="gcash_num" placeholder="09xxxxxxxxx" required>
                                    <div class="invalid-feedback"> Valid GCash number is required. </div>
                                </div>
                            </div>
                            <hr class="mb-1">
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6 mb-3">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="odr-box">
                                    <div class="title-left">
                                        <h3>Shopping cart</h3>
                                    </div>
                                    <div class="rounded p-2 bg-light" style="overflow-y: auto;height: 500px;">
                                        <?php include('includes/shopping-cart.php'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="order-box">
                                    <div class="title-left">
                                        <h3>Your order</h3>
                                    </div>
                                    <div class="d-flex">
                                        <div class="font-weight-bold">Product</div>
                                        <div class="ml-auto font-weight-bold">Total</div>
                                    </div>
                                    <hr class="my-1">
                                    <div class="d-flex">
                                        <h4>Sub Total</h4>
                                        <div class="ml-auto font-weight-bold"> Php <?php
                                                                                    $order_id = $_SESSION['order'];
                                                                                    $total_q = mysqli_query($con, "SELECT SUM(price * quantity) AS totalsum FROM cart WHERE order_id = '$order_id'");
                                                                                    $total_g = mysqli_fetch_array($total_q);

                                                                                    echo number_format($total_g['totalsum'], 2);
                                                                                    ?> </div>
                                    </div>
                                    <div id="delivery_fee" style="display: none;">
                                        <h4>Delivery Fee</h4>
                                        <div class="ml-auto font-weight-bold"> FREE </div>
                                    </div>
                                    <hr>
                                    <div class="d-flex gr-total">
                                        <h5>Grand Total</h5>
                                        <div class="ml-auto h5"> <?php
                                                                    $total_q = mysqli_query($con, "SELECT SUM(price * quantity) AS totalsum FROM cart WHERE order_id = '$order_id'");
                                                                    $total_g = mysqli_fetch_array($total_q);

                                                                    echo "<p id='grandtotal'>Php " . number_format($total_g['totalsum'], 2) . "</p>";
                                                                    ?>
                                            <input type="hidden" name="total" id="total" value="<?php echo $total_g['totalsum']; ?>">
                                            <input type="hidden" name="delfee" id="delfee" value="0">
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <div class="tacbox">
                                <input id="checkbox" type="checkbox" required />
                                <label for="checkbox"> I agree to these <a href="termsandcondition.php" class="text-aqua" target="_blank">Terms and Conditions</a>.</label>
                            </div>
                            <div class="col-12 d-flex shopping-box">
                                <input type="submit" name="checkout" id="checkout" disabled value="Place Order" class="ml-auto btn hvr-hover text-white">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
    <!-- End Cart -->
    <?php include('includes/footer.php'); ?>
    <script>
        $(document).ready(function() {
            $('#type').on('change', function() {
                if ($("#type option:selected").val() == 'Delivery') {
                    if ($('#total').val() >= 500) {
                        var grandtotal = parseInt($('#total').val()) + parseInt($('#delfee').val());
                        $('#delivery_address').css("display", "block");
                        $('#delivery_fee').css("display", "flex");
                        $('#limit').css("display", "none");
                        $('#grandtotal').text("Php " + grandtotal + ".00");
                    } else {
                        $('#delivery_address').css("display", "none");
                        $('#delivery_fee').css("display", "none");
                        $('#limit').css("display", "block");

                    }
                } else {
                    var total = parseInt($('#total').val());
                    $('#delivery_address').css("display", "none");
                    $('#delivery_fee').css("display", "none");
                    $('#limit').css("display", "none");
                    $('#grandtotal').text("Php " + total + ".00");
                }
            });
        });
        $(document).ready(function() {

            $("#checkbox").click(function() {
                if ($('#checkbox').is(':checked')) {
                    $('#checkout').prop('disabled', false);
                } else {
                    $('#checkout').prop('disabled', true);
                }
            });

            $('#gcash').click(function() {
                if ($('#gcash').is(':checked')) {
                    $('#gcash_form').css("display", "block");
                } else {
                    $('#gcash_form').css("display", "none");
                }
            });
        });
    </script>