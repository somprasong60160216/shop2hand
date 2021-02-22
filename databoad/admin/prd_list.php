<?php
//2. query ข้อมูลจากตาราง tb_member: 
$query = " SELECT p.*,m.m_name, t.t_name
FROM tbl_prd as p
LEFT JOIN tbl_member as m ON p.ref_m_id=m.m_id
LEFT JOIN tbl_prd_type as t ON p.ref_t_id=t.t_id
ORDER BY p.p_id ASC" or die("Error:" . mysqli_error($conn));

// echo $query;
// exit; 

//3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result . 
$result = mysqli_query($conn, $query);
//4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล: 

echo "<table id='example' class='display table table-bordered table-hover' cellspacing='0'>";
//หัวข้อตาราง
echo "
<thead>
<tr align='center' class='danger'>
<th width='5%'>รหัส</th>
<th width='15%'>รูปสินค้า</th>
<th width='15%'>ประเภทสินค้า</th>
<th width='15%'>ชื่อสินค้า</th>
<th width='15%'>รายละเอียด</th>
<th width='5%'>ราคา</th>
<th width='5%'>จำนวน</th>
<th width='5%'>เพิ่มโดย</th>
<th width='10%'>ว/ด/ป</th>
<th width='5%'>แก้ไข</th>
<th width='5%'>ลบ</th>
</tr>
</thead>
";
while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td align='center'>" . $row["p_id"] . '.' . "</td> ";
  echo "<td>" . "<img src='../pimg/" . $row['p_img'] . "' width='100'>" . "</td>";
  echo "<td>" . $row["t_name"] .  "</td> ";
  echo "<td>" . $row["p_name"] .  "</td> ";
  echo "<td>" . $row["p_intro"] .  "</td> ";
  echo "<td>" . $row["p_price"] .  "</td> ";
  echo "<td align='center'>" . $row["p_qty"] .  "</td> ";
  // echo "<td align='center'>" . $row["p_view"] .  "</td> ";
  //echo "<td>" .$row["m_name"] .  "</td> ";
  echo "<td>" . $row["m_name"];

  if ($row["p_m_name"] != '') {

    echo '<br>'
      . ' แก้โดย '
      . $row["p_m_name"]
      . '<br>'
      . ' ว/ด/ป '
      . date('d/m/Y H:i:s', strtotime($row["p_m_edit_date"]));
  }

  echo "</td> ";
  echo "<td>" . date('d-m-Y', strtotime($row["p_datesave"])) .  "</td> ";

  //แก้ไขข้อมูล
  echo "<td align='center'>
  <a href='prd.php?ID=$row[0]&act=edit' class='btn btn-warning btn-xs'>แก้ไข</a></td> ";

  //ลบข้อมูล
  echo "<td align='center'>
  <a href='prd_del_db.php?ID=$row[0]' onclick=\"return confirm('ต้องการลบสินค้า? !!!')\" class='btn btn-danger btn-xs'>ลบ</a></td> ";

  echo "</tr>";
}
echo "</table>";
//5. close connection
mysqli_close($conn);
