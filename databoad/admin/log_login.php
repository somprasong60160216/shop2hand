<?php include('hder.php'); //css 
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
        <p>
          <a href="log_login.php?act=byuser" class="btn btn-info"> by user </a>
          <a href="log_login.php?act=bym" class="btn btn-info"> by Monthly </a>
          <a href="log_login.php?act=byyear" class="btn btn-success"> by Yearly </a>
          <a href="log_login.php?act=bydate" class="btn btn-primary"> by date </a>

        </p>

        <?php

        $act = (isset($_GET['act']) ? $_GET['act'] : '');

        if ($act == 'byuser') {
          include('login_list_byuser.php');
        } elseif ($act == 'bym') {
          include('login_list_by_monthly.php');
        } elseif ($act == 'byyear') {
          include('login_list_by_yearly.php');
        } elseif ($act == 'bydate') {
          include('login_list_by_search.php');
        } else {
          include('counter.php');
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