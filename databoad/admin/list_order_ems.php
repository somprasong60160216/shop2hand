<?php

$queryorder = "SELECT * FROM order_head WHERE o_status = 3";
$rsorder = mysqli_query($conn, $queryorder);

?>
<h3>รายการแจ้ง EMS แล้ว</h3>
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
            <th width="5%">
                <center>slip</center>
            </th>
            <th width="5%">view</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rsorder as $row) { ?>
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
                <td>
                    <a href="../imgslip/<?php echo $row['o_slip']; ?>" target="_blank">
                        <img src="../imgslip/<?php echo $row['o_slip']; ?>" width="100%">
                    </a>
                </td>
                <td> <?php $o_id = $row['o_id'];
                        echo "<a href='ems_detail.php?o_id=$o_id&do=ems_detail' class='btn btn-info btn-xs' target='_blank'> เปิดดู </a>";
                        ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>