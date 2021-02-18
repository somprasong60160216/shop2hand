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
                <h3 align="center"> ระบบรายงานยอดขาย </h3>
                <a href="report.php" class="btn btn-warning"> รายวัน </a>
                <a href="report.php?act=m" class="btn btn-success"> รายเดือน </a>
                <a href="report.php?act=y" class="btn btn-info"> รายปี </a>
                <a href="report.php?act=date" class="btn btn-danger"> เรียกดูตามวัน </a>

                <?php
                $act = (isset($_GET['act']) ? $_GET['act'] : '');

                if ($act == 'm') {
                    include('report_m.php'); 
                } elseif ($act == 'y') {
                    include('report_y.php');
                } elseif ($act == 'date') {
                    include('report_d.php');
                } elseif ($act == 'rangedate') {
                    include('report_rangedate.php');
                } else {
                    include('report_d.php');
                }
                // } elseif ($act=='y') {
                //     include ('report_m.php');
                // } elseif ($act=='date') {
                //     include ('report_m.php');
                // } else {
                //     include ('report_d.php');
                // }
                // // if ($act == 'paid') {
                // //     include 'list_order_paid.php';
                // // } elseif ($act == 'ems') {
                // //     include 'list_order_ems.php';
                // // } elseif ($act == 'cancel') {
                // //     include 'list_order_cancel.php';
                // // } else {
                // //     include 'list_order_new.php';
                // // }
                // include ('report_d.php');
                ?>
            </div>
        </div>
    </div>
    <?php include('footer.php'); //footer
    ?>
</body>
<?php include('js.php'); //js
?>