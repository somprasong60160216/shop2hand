<?php

$queryorder = "SELECT * FROM order_head WHERE o_status = 1";
$rsorder = mysqli_query($conn, $queryorder);

//echo round(abs(strtotime("2021-02-10") - strtotime("2021-02-17"))/60/60/24);

?>
<h3>รายการรอชำระเงิน</h3>
<table id="example" class="display table table-bordered table-hover table-striped">
    <thead class="thead-light">
        <tr class="danger">
            <th width="5%">#</th>
            <th width="40%">ชื่อลูกค้า</th>
            <th width="15%">
                <center>ปี/เดือน/วัน</center>
            </th>
            <th width="10%">
                <center>ราคา</center>
            </th>
            <th width="10%">ผ่านมา</th>
            <th width="5%">view</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rsorder as $row) { 
            $o_id = $row['o_id']; ?>
            <tr>
                <td> <?php echo $row['o_id']; ?> </td>
                <td> <?php
                        echo '<b>';
                        echo $row['o_name'];
                        echo '</b><br>';
                        echo $row['o_addr'];
                        echo '<br>';
                        echo 'เบอร์โทร. ' . $row['o_phone'] . ' email ' . $row['o_email'];
                        ?>
                </td>
                <td> <?php echo $row['o_dttm']; ?> </td>
                <td align="right"> <?php echo number_format($row['o_total'], 2); ?> </td>
                <td align="center">
                    <?php
                    $o_dttm = date('Y-m-d' ,strtotime($row['o_dttm']));
                    $datenow = date('Y-m-d');
                    // echo 'วันที่สั่งซื้อ' .$o_dttm;
                    // echo '<br>';
                    // echo 'วันปัจจุบัน' .$datenow;
                    $caldate = round(abs(strtotime("$o_dttm") - strtotime("$datenow")) / 60 / 60 / 24); 
                    echo $caldate;
                    echo '<br>';
                    if($caldate > 3){
                        echo "<a href='order_detail.php?o_id=$o_id&do=order_cancel' class='btn btn-danger btn-xs'> ยกเลิก </a>";
                    } else{
                        echo '-';
                    }
                    ?>
                </td>
                <td> <?php 
                        echo "<a href='order_detail.php?o_id=$o_id&do=order_detail' class='btn btn-primary btn-xs'>ชำระเงิน</a>";
                    ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>