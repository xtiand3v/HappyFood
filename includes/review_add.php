<?php 
session_start();
include 'config.php';

if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $content = $_POST['review'];
    $email = $_POST['email'];
    $prodid = $_POST['prodid'];
    
    $sql = mysqli_query($con,"INSERT INTO reviews(user_id,product_id,review_title,review_content,date_added) VALUES ('$email','$prodid','$title','$content',NOW())");
    if($sql){
        $_SESSION['success'] = 'Review added successfully';
        echo "<script>
            window.location.href = '../shop-detail.php?id=".$prodid."'
            </script>";
    } else {
        $_SESSION['error'] = 'Failed to add review';
        echo "<script>
            window.location.href = '../shop-detail.php?id=".$prodid."'
            </script>";
    } 
}
?>