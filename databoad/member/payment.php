<?php include('hder.php'); //css 
//query cart detail
$o_id = mysqli_real_escape_string($conn, $_GET['o_id']);
$querycartdetail = "SELECT d.*,p.p_img, p.p_name, p.p_price, h.*
 FROM order_detail as d
 INNER JOIN order_head as h ON d.o_id = h.o_id
 INNER JOIN tbl_prd as p ON d.p_id = p.p_id
 WHERE d.o_id=$o_id AND h.m_id=$m_id";
$rscartdetail = mysqli_query($conn, $querycartdetail);
$rowdetail = mysqli_fetch_array($rscartdetail);
// echo '<pre>';
// print_r($rowdetail);
// echo '</pre>';
$querybank = "SELECT * FROM tbl_bank";
$rsbank = mysqli_query($conn, $querybank);

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
                <h3 align="center"> แจ้งชำระเงิน </h3>
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
                <h4>เลือกธนาคารที่ชำระเงิน/โอนเงิน</h4>
                <form action="payment_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <?php echo '
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <th width="10%" bgcolor="#EAEAEA">เลือกธนาคาร</th>
                        <th width="20%" bgcolor="#EAEAEA">ธนาคาร</th>
                        <th width="30%" bgcolor="#EAEAEA">เลขบัญชี</th>
                        <th width="40%" align="center" bgcolor="#EAEAEA">ชื่อเจ้าของบัญชี</th>
                    </tr> ';
                    foreach ($rsbank as $rsb) {
                        $b_id = $rsb["b_id"];
                        echo '<tr>';
                        echo "<td>" . "<input type='radio' name='b_id' required value='$b_id'>" . "</td>";
                        echo "<td>" . $rsb["b_name"] . "</td>";
                        echo "<td>" . $rsb["b_number"] . "</td>";
                        echo "<td>" . $rsb["b_owner"] . "</td>";
                        echo '</tr>';
                    }
                    echo '</table>'
                    ?>
                    <div class="form-group">
                        <div class="col-md-4">
                            วันที่ชำระเงิน <br>
                            <input type="date" name="o_slip_date" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            จำนวนที่โอน <br>
                            <input type="number" name="o_slip_total" any required min="0" class="form-control" value="<?php echo $total; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">
                            อัพโหลดรูปภาพ <br>
                            <input type="file" name="o_slip" required class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-2">
                            <br>
                            <input type="hidden" name="o_id" value="<?php echo $o_id; ?>">
                            <button type="submit" class="btn btn-primary">แจ้งชำระเงิน</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include('footer.php'); //footer
    ?>
</body>
<?php include('js.php'); //js
?>