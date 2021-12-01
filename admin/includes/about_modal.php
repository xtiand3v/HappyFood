
<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit About</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="about_edit.php">
                <input type="hidden" class="prodid" name="id">
                <div class="form-group">
                  <label for="edit_name" class="col-sm-1 control-label">Name</label>

                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="edit_name" name="name">
                  </div>

                  <label for="edit_address" class="col-sm-1 control-label">Address</label>

                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="edit_address" name="address">
                  </div>
                </div>
                <div class="form-group">
                  <label for="edit_phone" class="col-sm-1 control-label">Phone</label>

                  <div class="col-sm-5">
                    <input type="number" class="form-control" id="edit_phone" name="phone">
                  </div>
                  <label for="edit_email" class="col-sm-1 control-label">Email</label>

                  <div class="col-sm-5">
                    <input type="email" class="form-control" id="edit_email" name="email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="tagline" class="col-sm-1 control-label">Tagline</label>
                  <div class="col-sm-12 mx-auto">
                    <textarea id="editor4" name="tagline" rows="10" cols="10"></textarea>
                  </div>
                  
                </div>
                <div class="form-group">
                  <label for="description" class="col-sm-1 control-label">Description</label>
                  <div class="col-sm-12 mx-auto">
                    <textarea id="editor3" name="description" rows="10" cols="80"></textarea>
                  </div>
                  
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>

