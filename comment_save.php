<meta charset="utf-8">
<?php

//conn
include('connect.php');

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

// exit();

//รับค่าจากฟอร์ม
$c_detail = $_POST["c_detail"];
$ref_p_id = $_POST["ref_p_id"];

//เพิ่มเข้าไปในฐานข้อมูล
$sql = "INSERT INTO tbl_comment (c_detail,ref_p_id) VALUES ('$c_detail',$ref_p_id)";
$result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));

// echo $sql;
// exit;

//ปิดการเชื่อมต่อ database
mysqli_close($conn);
//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม

if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('แสดงความคิดเห็นสำเร็จ');";
    echo "window.location = 'detail.php?p_id=$ref_p_id'; ";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('Error!!');";
    echo "window.location = 'detail.php?p_id=$ref_p_id'; ";
    echo "</script>";
}
?>