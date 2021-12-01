<?php
    include ('config.php');
$store = mysqli_query($con, "SELECT * FROM system WHERE id = '1'");
$system = mysqli_fetch_array($store);
$storeName = $system['name'];
$storeAddress = $system['address'];
$storeDesc = $system['description'];
$storeTagline = $system['tagline'];
$storePhone = $system['phone'];
$storeEmail = $system['email'];
?>