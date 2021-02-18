<h4> กรุณาเลือกวันที่เริ่มต้นและวันที่สิ้นสุดในการเรียกดูรายงาน </h4>
<form action="" method="get" name="q" class="form-horizontal">
	<div class="form-group">
		<div class="col-sm-1 control-label">
			start
		</div>
		<div class="col-sm-3">
			<input type="date" name="ds" class="form-control" required>
		</div>
		<div class="col-sm-1 control-label">
			end
		</div>
		<div class="col-sm-3">
			<input type="date" name="de" class="form-control" required>
		</div>
		<div class="col-sm-1">
			<button type="submit" class="btn btn-primary" name="act" value="bydate">GET REPORT</button>
		</div>

	</div>

</form>



<?php
$ds = $_GET['ds'];
$de = $_GET['de'];


if($ds==''){

}else{

//2. query ข้อมูลจากตาราง tb_member: 
$query = "
SELECT l.ref_m_id,m.m_name, l.log_date
FROM tbl_login_log as l
INNER JOIN tbl_member  as m ON l.ref_m_id=m.m_id
WHERE l.log_date
BETWEEN '$ds 00:00:00.000000' 
AND '$de 23:59:59.000000' 
ORDER BY l.log_date DESC 
" or die("Error:" . mysqli_error($conn));

// echo $query;
// exit; 

//3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result . 
$result = mysqli_query($conn, $query); 
//4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล: 
echo '<h4> ประวัติการ Login by Yearly  </h4>';
echo "<table id='example1' class='display table table-bordered table-hover' cellspacing='0'>";
//หัวข้อตาราง
echo "
<thead>
<tr align='center' class='danger'>
<th width='10%'><center>ลำดับ</center></th>
<th width='70%'>ผู้ใช้</th>
<th width='30%'><center>ว/ด/ป</center></th>
</tr>
</thead>
";
while($row = mysqli_fetch_array($result)) { 
  echo "<tr>";
  echo "<td align='center'>" .$i += 1 .  "</td> ";
  echo "<td>" .$row["m_name"] .  "</td> ";
  echo "<td align='center'>" .$row["log_date"] .  "</td> "; 
  echo "</tr>";
}
echo "</table>";
}

//5. close connection
mysqli_close($conn);
?>