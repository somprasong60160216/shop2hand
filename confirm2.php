<?php
session_start();

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
// เช็ค ล็อคอิน
if ($_SESSION['m_name'] == '') {
    //echo 'คุณยังไม่ได้ login';
    //header("Location: databoad/login.php");
    echo "<script type='text/javascript'>";
	echo "alert('คุณยังไม่ได้ login');";
	echo "window.location = 'databoad/login.php'; ";
	echo "</script>";
}

include 'connect.php';
include 'header.php';
include 'banner.php';
include 'navbar.php';

?>
<!--start  cart -->
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12">
            <h3> ยืนยันการสั่งซื้อ </h3>
            <form id="frmcart" name="frmcart" method="post" action="saveorder2.php">
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
                    if (!empty($_SESSION['cart'])) {

                        foreach ($_SESSION['cart'] as $p_id => $qty) {
                            $sql = "SELECT * FROM tbl_prd WHERE p_id=$p_id";
                            $query = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($query);
                            $sum = $row['p_price'] * $qty; //เอาราคาสินค้า * จำนวนที่สั่งซื้อ
                            $total += $sum;
                            echo "<tr>";
                            echo "<td>" . @$i += 1 . "</td>";
                            echo "<td>" . "<img src='databoad/pimg/" . $row['p_img'] . "' width='100'>" . "</td>";
                            echo "<td>" . $row["p_name"] . "</td>";
                            echo "<td align='right'>" . number_format($row["p_price"], 2) . "</td>";
                            echo "<td align='right'>";
                            echo "<input type='number' name='amount[$p_id]' value='$qty' class='form-control' readonly/></td>";
                            echo "<td align='right'>" . number_format($sum, 2) . "</td>";
                            //remove product
                            echo "</tr>";
                        } //close foreach
                        echo "<tr>";
                        echo "<td colspan='5' bgcolor='#CEE7FF' align='center'><b>ราคารวม</b></td>";
                        echo "<td align='right' bgcolor='#CEE7FF'>" . "<b>" . number_format($total, 2) . "</b>" . "</td>";
                        echo "</tr>";
                    }

                    ?>


                </table>


                <h3>รายละเอียดที่อยู่สำหรับจัดส่งสินค้า</h3>
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">ชื่อ-นามสกุล</label>
                            <input type="text" class="form-control" id="inputEmail4" name="m_name" value=" <?php echo $_SESSION['m_name']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">ที่อยู่การจัดส่ง</label>
                        <input type="text" class="form-control" id="inputAddress" name="m_address" value=" <?php echo $_SESSION['m_address']; ?>">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCity">อีเมล</label>
                            <input type="email" class="form-control" id="inputCity" name="m_email" value=" <?php echo $_SESSION['m_email']; ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputState">เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" id="inputCity" name="m_phone" value=" <?php echo $_SESSION['m_phone']; ?>">
                        </div>
                    </div>
                    <input type="hidden" name="m_id" value=" <?php echo $_SESSION['m_id']; ?>">
                    <input type="hidden" name="total" value=" <?php echo $total; ?>">
                    <button type="submit" class="btn btn-primary">สั่งซื้อสินค้า</button>
                </form>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>