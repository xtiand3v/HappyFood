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
                    <h2>My Account</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">My Account</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
    <?php 
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $id = $row['id'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $email = $row['email'];
    $phone = $row['contact_info'];
    $address = $row['address'];

    ?>
    <!-- Start My Account  -->
    <div class="my-account-box-main">
        <div class="container">
            <div class="my-account-page">
                <div class="row">
                    <form method="POST" class="mt-3 review-form-box mx-auto" id="formRegister">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="InputName" class="mb-0">First Name</label>
                                <input type="text" class="form-control" id="InputName" name="firstname" value="<?php echo $firstname; ?>" placeholder="First Name"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputLastname" class="mb-0">Last Name</label>
                                <input type="text" class="form-control" id="InputLastname" value="<?php echo $lastname; ?>" name="lastname" placeholder="Last Name"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputAddress" class="mb-0">Address</label>
                                <input type="text" class="form-control" id="InputAddress" value="<?php echo $address; ?>" name="address" placeholder="Address"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputContact" class="mb-0">Contact</label>
                                <input type="number" class="form-control" id="InputContact"  value="<?php echo $phone; ?>"name="contact" placeholder="Phone Number"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputEmail1" class="mb-0">Email Address</label>
                                <input type="email" class="form-control" id="InputEmail1" value="<?php echo $email; ?>" name="email" placeholder="Enter Email"> </div>
                        </div>
                        <input type="submit" name="save" value="Save Changes" class="btn hvr-hover text-white float-right">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End My Account -->

    <?php include ('includes/footer.php'); ?>

    <?php
    if (isset($_POST['save'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];

        $sql = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', email = '$email', contact_info = '$contact', address = '$address' WHERE id = '$id'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $_SESSION['success'] = "Profile Updated Successfully";
            echo "<script>window.open('my-account.php','_self')</script>";
        } else {
            $_SESSION['error'] = "Error updating profile";
        }
    }
    ?>