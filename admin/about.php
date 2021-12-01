<?php include 'includes/session.php'; ?>
<?php
  $where = '';
  if(isset($_GET['category'])){
    $catid = $_GET['category'];
    $where = 'WHERE category_id ='.$catid;
  }

?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        System Settings
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>About</li>
        <li class="active">System Settings</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <table class="table table-bordered">
                
              <?php
                    $conn = $pdo->open();

                    try{
                      $now = date('Y-m-d');
                      $stmt = $conn->prepare("SELECT * FROM SYSTEM");
                      $stmt->execute();
                     $row = $stmt->fetch();
                       
                      }
                    catch(PDOException $e){
                      echo $e->getMessage();
                    }

                    $pdo->close();
                  ?>
                <thead>
                  <tr>
                  <th>Name</th>
                  <td><?php echo $row['name']; ?></td>
                  </tr>
                  <tr>
                  <th>Tagline / Banner</th>
                  <td><?php echo $row['tagline']; ?></td>
                  </tr>
                  <tr>
                  <th>Description / About Section</th>
                  <td><?php echo $row['description']; ?></td>
                  </tr>
                  <tr>
                  <th>Contact</th>
                  <td><?php echo $row['phone']; ?></td>
                  </tr>
                  <tr>
                  <th>Address</th>
                  <td><?php echo $row['address']; ?></td>
                  </tr>
                  <tr>
                  <th>Email</th>
                  <td><?php echo $row['email']; ?></td>
                  </tr>
                  <tr>
                  <th>Tools</th>
                  <td><button class='btn btn-success btn-sm edit btn-flat' data-id="<?php echo $row['id']; ?>"><i class='fa fa-edit'></i> Edit</button></td>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
     
  </div>
  	<?php include 'includes/footer.php'; ?>
    <?php include 'includes/about_modal.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });


  $("#edit").on("hidden.bs.modal", function () {
      $('.append_items').remove();
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'about_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#edit_address').val(response.address);
      $('#edit_name').val(response.name);
      $('#edit_phone').val(response.phone);
      $('#edit_email').val(response.email);
      CKEDITOR.instances["editor3"].setData(response.description);
      CKEDITOR.instances["editor4"].setData(response.tagline);
    }
  });
}
</script>
</body>
</html>
