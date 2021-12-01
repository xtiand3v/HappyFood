<!-- Modal -->
<div class="modal fade" id="addReview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="includes/review_add.php">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Review Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Add Review Title">
                        <div class="form-group">
                            <label for="review">Review Content</label>
                            <textarea class="form-control" name="review" id="review" rows="3"></textarea>
                        </div>
                        <input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">
                        <input type="hidden" name="prodid" value="<?php echo $_GET['id']; ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Submit Review</button>
                    </div>

            </form>
        </div>
    </div>
</div>