
<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Discount</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="discount_add.php" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="name" class="col-sm-1 control-label">Name</label>

                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="name" name="name" required>
                  </div>

                  <label for="products" class="col-sm-1 control-label">Product List</label>

                  <div class="col-sm-5">
                    <select class="form-control" id="products" name="products" required>
                      <option value="" selected>- Select -</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="sale" class="col-sm-1 control-label">Sale</label>

                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="sale" name="sale" placeholder="ex. 10 or 20. No need to put %" required>
                  </div>

                  <label for="expiration" class="col-sm-1 control-label">Expiration</label>

                  <div class="col-sm-5">
                    <input type="date" class="form-control" id="expiration" name="expiration" min="<?php echo date("Y-m-d"); ?>" placeholder="ex. 10 or 20. No need to put %" required>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>
