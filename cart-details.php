                <?php
                $order_id = $_SESSION['order'];
                $cart = mysqli_query($con, "SELECT * FROM cart WHERE order_id = '$order_id' ORDER by cart_id DESC");

                if (mysqli_num_rows($cart) >= 1) {
                    while ($cart_desc = mysqli_fetch_array($cart)) {
                        $prod_id = $cart_desc['product_id'];
                        $prod = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM products WHERE id = '$prod_id'"));

                        $sale = mysqli_query($con, "SELECT * FROM discounts WHERE product_id = '$prod_id'");
                        $discount = mysqli_fetch_array($sale);
                ?>

                        <tr>
                            <td class="thumbnail-img">
                                <a href="#">
                                    <img class="img-fluid" src="images/<?php echo $prod['photo']; ?>" alt="" />
                                </a>
                            </td>
                            <td class="name-pr">
                                <a href="#">
                                    <?php echo $prod['name']; ?>
                                </a>
                            </td>
                            <td class="price-pr">
                                <p>Php <?php
                                        if (mysqli_num_rows($sale) >= 1) {
                                        ?>
                                        <del><?php echo number_format($prod['price'], 2); ?></del> <?php echo number_format($cart_desc['price'], 2);
                                                                                                } else {
                                                                                                    echo number_format($cart_desc['price'], 2);
                                                                                                }
                                                                                                    ?>
                                </p>
                                <input type="hidden" name="cart_id" value="<?php echo $cart_desc['cart_id']; ?>">
                            </td>
                            <td class="quantity-box">
                                <p><?php echo $cart_desc['quantity']; ?> <a href="cart-edit.php?id=<?php echo $cart_desc['cart_id']; ?>" class="btn btn-link"><small>Edit quantity</small></a></p>
                            </td>
                            <td class="total-pr">
                                <p id="subtotal">Php <?php echo $cart_desc['price'] * $cart_desc['quantity']; ?></p>
                            </td>
                            <td class="remove-pr">
                                <a href="cart-delete.php?id=<?php echo $cart_desc['cart_id']; ?>">
                                    <i class="fas fa-times"></i>
                                </a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td><center><h3>No item added in cart.</h3></center></tr></td>";
                }
                ?>