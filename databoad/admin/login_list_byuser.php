<?php

//2. query ข้อมูลจากตาราง tb_member: 
$query = "
SELECT l.ref_m_id, m.m_name, COUNT(l.ref_m_id) as total 
FROM tbl_login_log as l 
INNER JOIN tbl_member as m ON l.ref_m_id=m.m_id
GROUP BY l.ref_m_id
" or die("Error:" . mysqli_error($conn));

// echo $query;
// exit; 

//3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result . 
$result = mysqli_query($conn, $query); 
//4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล: 
echo '<h4> ประวัติการ Login by user  </h4>';
echo "<table id='example1' class='display table table-bordered table-hover' cellspacing='0'>";
//หัวข้อตาราง
echo "
<thead>
<tr align='center' class='danger'>
<th width='5%'>รหัส</th>
<th width='75%'>ชื่อของผู้ใช้</th>
<th width='20%'><center>รวม (ครั้ง)</center></th>
</tr>
</thead>
";
while($row = mysqli_fetch_array($result)) { 
  echo "<tr>";
  echo "<td align='center'>" .@$i += 1 .'.'. "</td> "; 
  echo "<td>" .$row["m_name"] .  "</td> ";
  echo "<td align='center'>" .$row["total"] .  "</td> "; 
  
  echo "</tr>";
}
echo "</table>";
//5. close connection
mysqli_close($conn);
?>