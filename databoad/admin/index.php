  <?php include('hder.php'); //css 

  //query status

  $querystatus1 = "SELECT o_status, COUNT(o_id) as s1total FROM order_head WHERE o_status = 1 GROUP BY o_status";
  $rs1 = mysqli_query($conn, $querystatus1);
  $rows1 = mysqli_fetch_array($rs1);
  //  echo $querystatus1;

  $querystatus2 = "SELECT o_status, COUNT(o_id) as s2total FROM order_head WHERE o_status = 2 GROUP BY o_status";
  $rs2 = mysqli_query($conn, $querystatus2);
  $rows2 = mysqli_fetch_array($rs2);
  // echo $querystatus2;

  $querystatus3 = "SELECT o_status, COUNT(o_id) as s3total FROM order_head WHERE o_status = 3 GROUP BY o_status";
  $rs3 = mysqli_query($conn, $querystatus3);
  $rows3 = mysqli_fetch_array($rs3);
  // echo $querystatus3;

  $querystatus4 = "SELECT o_status, COUNT(o_id) as s4total FROM order_head WHERE o_status = 4 GROUP BY o_status";
  $rs4 = mysqli_query($conn, $querystatus4);
  $rows4 = mysqli_fetch_array($rs4);
  // echo $querystatus4;
  ?>

  <body>
    <?php include('nav.php'); //menu 
    ?>
    <!-- content -->
    <div class="container">
      <div class="row">
        <div class="col-md-2">
          <?php include('menu_l.php'); ?>
        </div>
        <div class="col-md-10">
          <h3 align="center"> Admin Page
            <br>
            ยินดีต้อนรับคุณ
            <?php echo $m_name; ?>
          </h3>
          <a href="index.php" class="btn btn-warning"> รอชำระเงิน <span class="badge"><?php echo $rows1['s1total']; ?></span></a>
          <a href="index.php?act=paid" class="btn btn-success"> ชำระเงินแล้ว <span class="badge"><?php echo $rows2['s2total']; ?></span></a>
          <a href="index.php?act=ems" class="btn btn-info"> แจ้ง EMS <span class="badge"><?php echo $rows3['s3total']; ?></span></a>
          <a href="index.php?act=cancel" class="btn btn-danger"> ยกเลิก <span class="badge"><?php echo $rows4['s4total']; ?></span></a>

          <?php
          $act = (isset($_GET['act']) ? $_GET['act'] : '');
          if ($act == 'paid') {
            include 'list_order_paid.php';
          } elseif ($act == 'ems') {
            include 'list_order_ems.php';
          } elseif ($act == 'cancel') {
            include 'list_order_cancel.php';
          } else {
            include 'list_order_new.php';
          }

          ?>
        </div>
      </div>
    </div>
    <?php include('footer.php'); //footer
    ?>
  </body>
  <?php include('js.php'); //js
  ?>