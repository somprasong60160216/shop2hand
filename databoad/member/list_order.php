<?php

$queryorder = "SELECT * FROM order_head WHERE m_id=$m_id";
$rsorder = mysqli_query($conn, $queryorder);

?>
<h3>ประวัติการสั่งซื้อ</h3>
<table id="example" class="display table table-bordered table-hover table-striped">
    <thead class="thead-light">
        <tr class="danger">
            <th width="5%">#</th>
            <th width="10%">สถานะ</th>
            <th width="10%">วันเดือนปี</th>
            <th width="10%">
                <center>ราคา</center>
            </th>
            <th width="5%">สลีป</th>
            <th width="10%">EMS</th>
            <th width="5%">view</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rsorder as $row) { ?>
            <tr>
                <td> <?php echo $row['o_id']; ?> </td>
                <td> <?php $st = $row['o_status'];
                        if ($st == 1) {
                            echo "<font color='#1100ff'>";
                            echo 'รอการชำระเงิน';
                            echo "</font>";
                        } elseif ($st == 2) {
                            echo "<font color='orange'>";
                            echo 'ชำระเงินแล้ว';
                            echo "</font>";
                        } elseif ($st == 3) {
                            echo "<font color='green'>";
                            echo 'ตรวจสอบเลข EMS';
                            echo "</font>";
                        } else {
                            echo "<font color='red'>";
                            echo 'ยกเลิก';
                            echo "</font>";
                        } ?> </td>
                <td> <?php echo $row['o_dttm']; ?> </td>
                <td align="right"> <?php echo number_format($row['o_total'], 2); ?> </td>
                <td> slip </td>
                <td> <?php echo $row['o_ems']; ?> </td>
                <td> <?php $o_id = $row['o_id'];
                        if ($st == 1) {
                            echo "<a href='payment.php?o_id=$o_id&do=payment' class='btn btn-primary btn-xs'>ชำระเงิน</a>";
                        } elseif ($st == 2) {
                            echo "<a href='payment_detail.php?o_id=$o_id&do=payment_detail' class='btn btn-info btn-xs'>เปิดดู</a>";
                        } elseif ($st == 3) {
                            echo "<a href='payment_detail.php?o_id=$o_id&do=payment_detail' class='btn btn-success btn-xs'>ดูเลขEMS</a>";
                        } else {
                            echo "<a href='order_detail.php?o_id=$o_id&do=order_detail' class='btn btn-danger btn-xs'>เปิดดู</a>";
                        } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>