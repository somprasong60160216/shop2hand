<?php include('hder.php'); //css 
//query cart detail
$o_id = mysqli_real_escape_string($conn, $_GET['o_id']);
$querycartdetail = "SELECT d.*,p.p_img, p.p_name, p.p_price, h.*
 FROM order_detail as d
 INNER JOIN order_head as h ON d.o_id = h.o_id
 INNER JOIN tbl_prd as p ON d.p_id = p.p_id
 WHERE d.o_id=$o_id";
$rscartdetail = mysqli_query($conn, $querycartdetail);
$rowdetail = mysqli_fetch_array($rscartdetail);
// echo '<pre>';
// print_r($rowdetail);
// echo '</pre>';
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
                <h3 align="center"> รายละเอียดการสั่งซื้อ </h3>
                <h4>
                    OrderID : <?php echo $rowdetail['o_id']; ?> <br>
                    ส่งไปที่ : <?php echo $rowdetail['o_name']; ?> <br>
                    <?php echo $rowdetail['o_addr']; ?> <br>
                    เบอร์โทร : <?php echo $rowdetail['o_phone']; ?> <br>
                    อีเมล : <?php echo $rowdetail['o_email']; ?> <br>
                    วันที่สั่งซื้อ : <?php echo $rowdetail['o_dttm']; ?> <br>
                    สถานะ : <?php
                            $st = $rowdetail['o_status'];
                            echo '<font color="blue">';
                            if ($st == 1) {
                                echo 'รอการชำระเงิน';
                            } elseif ($st == 2) {
                                echo 'ชำระเงินแล้ว';
                            } elseif ($st == 3) {
                                echo 'ตรวจสอบเลข EMS';
                            } else {
                                echo 'ยกเลิก';
                            }
                            echo '</font>';
                            ?>
                </h4>
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <th width="5%" bgcolor="#EAEAEA">#</th>
                        <th width="10%" bgcolor="#EAEAEA">img</th>
                        <th width="55%" bgcolor="#EAEAEA">สินค้า</th>
                        <th width="10%" align="center" bgcolor="#EAEAEA">ราคา</th>
                        <th width="10%" align="center" bgcolor="#EAEAEA">จำนวน</th>
                        <th width="5%" align="center" bgcolor="#EAEAEA">รวม(บาท)</th>
                    </tr>
                    <?php
                    $total = 0;
                    foreach ($rscartdetail as $row) {
                        $total += $row["d_subtotal"]; //ราคารวมทั้งออเดอร์
                        echo "<tr>";
                        echo "<td>" . @$i += 1 . "</td>";
                        echo "<td>" . "<img src='../pimg/" . $row['p_img'] . "' width='100'>" . "</td>";
                        echo "<td>" . $row["p_name"] . "</td>";
                        echo "<td align='right'>" . number_format($row["p_price"], 2) . "</td>";
                        echo "<td align='right'>" . number_format($row["d_qty"], 2) . "</td>";
                        echo "<td align='right'>" . number_format($row["d_subtotal"], 2) . "</td>";
                        //remove product
                        echo "</tr>";
                    } //close foreach
                    echo "<tr>";
                    echo "<td colspan='5' bgcolor='#CEE7FF' align='center'><b>ราคารวม</b></td>";
                    echo "<td align='right' bgcolor='#CEE7FF'>" . "<b>" . number_format($total, 2) . "</b>" . "</td>";
                    echo "</tr>";
                    ?>
                </table>
                <?php if ($_GET['do'] == 'order_cancel') { ?>
                    <form action="order_cancel.php" method="post">
                        <input type="hidden" name="o_id" value="<?php echo $o_id; ?>">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('ยืนยันการยกเลิก')">ยืนยันการยกเลิกออเดอร์</button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php include('footer.php'); //footer
    ?>
</body>
<?php include('js.php'); //js
?>