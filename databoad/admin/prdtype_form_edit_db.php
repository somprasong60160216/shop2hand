<meta charset="utf-8">
<?php
//condb
include('../condb.php'); 

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

// exit();


	$t_name = mysqli_real_escape_string($conn,$_POST["t_name"]);
	$t_id = mysqli_real_escape_string($conn,$_POST['t_id']);

	//แก้ไขข้อม
	$sql = "UPDATE  tbl_prd_type SET 
	t_name='$t_name'
	WHERE t_id=$t_id
	";

	$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));

 
	// echo $sql;
	// exit;
	
	//ปิดการเชื่อมต่อ database
	mysqli_close($conn);
	//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
	
	if($result){
	echo "<script type='text/javascript'>";
	echo "alert('แก้ไขข้อมูลสำเร็จ');";
	echo "window.location = 'prdtype.php'; ";
	echo "</script>";
	}else{
	echo "<script type='text/javascript'>";
	//echo "alert('Error!!');";
	echo "window.location = 'prdtype.php'; ";
	echo "</script>";
}
?>