<?php include 'includes/session.php'; ?>
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
          Orders
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Orders</li>
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
              <div class="box-header with-border">
                <div class="pull-right">
                  <form method="POST" class="form-inline" action="orders_print.php">
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right col-sm-8" id="reservation" name="date_range">
                    </div>
                    <button type="submit" class="btn btn-success btn-sm btn-flat" name="print"><span class="glyphicon glyphicon-print"></span> Print</button>
                  </form>
                </div>
              </div>
              <div class="box-body">
                <table id="example1" class="table table-bordered">
                  <thead>
                    <th class="hidden"></th>
                    <th>Date</th>
                    <th>Buyer Name</th>
                    <th>Order No</th>
                    <th>Total Payment</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Tools</th>
                  </thead>
                  <tbody>
                    <?php
                    $orders = mysqli_query($con, "SELECT * FROM orders ORDER by order_id DESC");

                    if (mysqli_num_rows($orders) >= 1) {
                      while ($order = mysqli_fetch_array($orders)) {
                        $uemail = $order['order_email'];
                        $row = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM users WHERE email = '$uemail'"));
                    ?>

                        <tr>
                          <td class="total-pr">
                            <p><?php echo date("F d, Y",strtotime($order['order_added'])); ?></p>
                          </td>
                          <td class="name-pr">
                            <?php echo $order['order_name']; ?>
                          </td>
                          <td class="name-pr">
                            Order #<?php echo $order['order_no']; ?>
                          </td>
                          <td class="total-pr">
                            <p id="subtotal">Php <?php echo $order['order_total']; ?></p>
                          </td>
                          <td class="total-pr">
                            <p><?php echo $order['order_type']; ?></p>
                          </td>
                          <td class="total-pr">
                            <p><?php echo $order['order_status']; ?></p>
                          </td>
                          <td>
                              <a href="cart.php?user=<?php echo $order['order_email']; ?>" class='btn btn-info btn-sm btn-flat'><i class='fa fa-search'></i> Cart</a>
                              <?php if($order['order_status'] == "Pending"){
                                ?>
                                <a class='btn btn-success btn-sm edit btn-flat' href="change-status.php?s=Approve&id=<?php echo $order['order_id']; ?>">Approve</a>
                                <a class='btn btn-danger btn-sm delete btn-flat' href="change-status.php?s=Declined&id=<?php echo $order['order_id']; ?>">Declined</a>

                                <?php
                              } elseif($order['order_status'] == "Approve") {
                                ?>
                                <a class='btn btn-success btn-sm edit btn-flat' href="change-status1.php?s=Done&id=<?php echo $order['order_id']; ?>&user=<?php echo $row['id']; ?>&order=<?php echo $order['order_no']; ?>">Done</a>

                                <?php
                              } else {
                                ?>
                                <a class='btn btn-info btn-sm edit btn-flat' disabled href="">Done</a>
                                <?php

                              }
                               ?>
                            </td>
                        </tr>
                    <?php
                      }
                    } else {
                      echo "<tr><td><center><h3>No orders found.</h3></center></tr></td>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>

    </div>
    <?php include 'includes/footer.php'; ?>
    <?php include '../includes/profile_modal.php'; ?>

  </div>
  <!-- ./wrapper -->

  <?php include 'includes/scripts.php'; ?>
  <!-- Date Picker -->
  <script>
    $(function() {
      //Date picker
      $('#datepicker_add').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      })
      $('#datepicker_edit').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      })

      //Timepicker
      $('.timepicker').timepicker({
        showInputs: false
      })

      //Date range picker
      $('#reservation').daterangepicker()
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        format: 'MM/DD/YYYY h:mm A'
      })
      //Date range as a button
      $('#daterange-btn').daterangepicker({
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function(start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      )

    });
  </script>
  <script>
    $(function() {
      $(document).on('click', '.transact', function(e) {
        e.preventDefault();
        $('#transaction').modal('show');
        var id = $(this).data('id');
        $.ajax({
          type: 'POST',
          url: 'transact.php',
          data: {
            id: id
          },
          dataType: 'json',
          success: function(response) {
            $('#date').html(response.date);
            $('#transid').html(response.transaction);
            $('#detail').prepend(response.list);
            $('#total').html(response.total);
          }
        });
      });

      $("#transaction").on("hidden.bs.modal", function() {
        $('.prepend_items').remove();
      });
    });
  </script>
</body>

</html>