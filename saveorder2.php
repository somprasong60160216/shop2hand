<?php
session_start();
// เช็ค ล็อคอิน
if ($_SESSION['m_name'] == '') {
    //echo 'คุณยังไม่ได้ login';
    //header("Location: databoad/login.php");
    echo "<script type='text/javascript'>";
    echo "alert('คุณยังไม่ได้ login');";
    echo "window.location = 'databoad/login.php'; ";
    echo "</script>";
}

include("connect.php");
?>

<meta charset="utf-8">

<!--สร้างตัวแปรสำหรับบันทึกการสั่งซื้อ -->
<?php

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

// echo '<hr>';

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';


// exit;




$name = mysqli_real_escape_string($conn, $_POST["m_name"]);
$address = mysqli_real_escape_string($conn, $_POST["m_address"]);
$email = mysqli_real_escape_string($conn, $_POST["m_email"]);
$phone = mysqli_real_escape_string($conn, $_POST["m_phone"]);
$m_id = mysqli_real_escape_string($conn, $_POST["m_id"]);
//$total_qty = $_POST["total_qty"];
$total = mysqli_real_escape_string($conn, $_POST["total"]); //ราคารวมทั้งตะกร้า
$dttm = Date("Y-m-d G:i:s");
//บันทึกการสั่งซื้อลงใน order_detail
mysqli_query($conn, "BEGIN");
$sql1    = "INSERT INTO order_head VALUES(null, '$m_id', '$dttm', '$name', '$address', '$email', '$phone', '$total', 1, 0, '', '0000-00-00', 0, '', '0000-00-00')";
$query1    = mysqli_query($conn, $sql1) or die("Error in query; $sql1" . mysqli_error($sql1));
//ฟังก์ชั่น MAX() จะคืนค่าที่มากที่สุดในคอลัมน์ที่ระบุ ออกมา หรือจะพูดง่ายๆก็ว่า ใช้สำหรับหาค่าที่มากที่สุด นั่นเอง.

echo $sql1;
//exit;

$sql2 = "SELECT MAX(o_id) AS o_id FROM order_head WHERE m_id='$m_id' AND o_dttm='$dttm' ";
$query2    = mysqli_query($conn, $sql2) or die("Error in query; $sql2" . mysqli_error($sql2));
$row = mysqli_fetch_array($query2);
$o_id = $row["o_id"]; //ออเดอ id ล่าสุดที่อยู่ในตาราง order_head

// echo '<br>';
// echo $sql2;
// echo '<br>';
// echo $o_id;
// echo '<br>';
//exit;

//PHP foreach() เป็นคำสั่งเพื่อนำข้อมูลออกมาจากตัวแปลที่เป็นประเภท array โดยสามารถเรียกค่าได้ทั้ง $key และ $value ของ array
foreach ($_SESSION['cart'] as $p_id => $qty) {
    $sql3    = "SELECT * FROM tbl_prd WHERE p_id=$p_id";
    $query3    = mysqli_query($conn, $sql3) or die("Error in query; $sql3" . mysqli_error($sql3));
    $row3    = mysqli_fetch_array($query3);
    $pricetotal    = $row3['p_price'] * $qty;
    $count = mysqli_num_rows($query3); //นับจำนวนสินค้าที่ส่งมากี่รายการ

    $sql4    = "INSERT INTO order_detail VALUES(null, '$o_id', '$p_id', '$qty', '$pricetotal')";
    $query4    = mysqli_query($conn, $sql4) or die("Error in query; $sql4" . mysqli_error($sql4));
    
    //ตัดสต๊อก
    for ($i = 0; $i < $count; $i++) {
        $instock =  $row3['p_qty']; //จำนวนสินค้าที่มีอยู่

        $updatestock = $instock - $qty; //คำนวนสินค้าที่มีอยู่ลบจำนวนที่สั่งซื้อ

        $sql5 = "UPDATE tbl_prd SET p_qty=$updatestock WHERE  p_id=$p_id ";
        $query5 = mysqli_query($conn, $sql5) or die("Error in query; $sql5" . mysqli_error($sql5));
    }
    /*   stock  */

    // echo '<pre>';
    // echo $sql4;
    // echo '</pre>';
}

//exit;

if ($query1 && $query4) {
    mysqli_query($conn, "COMMIT");
    $msg = "บันทึกข้อมูลเรียบร้อยแล้ว ";
    foreach ($_SESSION['cart'] as $p_id) {
        //unset($_SESSION['cart'][$p_id]);
        unset($_SESSION['cart']);
    }
} else {
    mysqli_query($conn, "ROLLBACK");
    $msg = "บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่ค่ะ ";
}
?>
<script type="text/javascript">
    alert("<?php echo $msg; ?>");
    window.location = 'databoad/member/order_detail.php?o_id=<?php echo $o_id; ?>';
</script>