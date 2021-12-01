<?php 
include 'config.php';
$id = $_GET['id'];
$sql = mysqli_query($con,"SELECT * FROM reviews as r INNER JOIN products as p ON r.product_id = p.id WHERE r.product_id = '$id'");
if(mysqli_num_rows($sql) > 0){
while($row = mysqli_fetch_array($sql)){
    $product_id = $row['product_id'];
    $review_id = $row['review_id'];
    $user_id = $row['user_id'];
    $review_title = $row['review_title'];
    $review_content = $row['review_content'];
    $review_added = $row['date_added'];
    $user = mysqli_query($con,"SELECT * FROM users WHERE email = '$user_id'");
    $user_row = mysqli_fetch_array($user);
?>

<div class="media mb-3">
    <div class="media-body">
        <h4>"<?php echo $review_title; ?>"</h4>
        <p><?php echo $review_content; ?></p>
        <small class="text-muted">Posted by <?php echo $user_row['firstname']." ".$user_row['lastname']; ?> on <?php echo date("Y-m-d",strtotime($review_added)); ?></small>
    </div>
</div>
<hr>
<?php 
} 
} else {
    ?>
    <div class="media">
        <div class="media-body">
            <p>No reviews yet.</p>
        </div>

    <?php
}
?>