<?php
$m_phone = $_GET['m_phone'];
$query = "
SELECT * FROM tbl_member 
WHERE m_phone='$m_phone'
" or die("Error:" . mysqli_error($conn));
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
    <th>รหัส</th>
    <th>IMG</th>
    <th>Username</th>
    <th>ชื่อ-นามสกุล</th>
    <th>อีเมล์</th>
    <th>เบอร์โทร</th>
    <th>ว/ด/ป</th>
  </tr>
  </thead>
  ";
  //$i=1;
  while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
    //echo "<td>" .$i .  "</td> ";
    echo "<td align='center'>" .$row["m_id"] .'.'  ."</td> ";
    echo "<td>"."<img src='mimg/".$row['m_img']."' width='100'>"."</td>";
    echo "<td>" .$row["m_username"] .  "</td> ";
    //echo "<td>" .$row["m_password"] .  "</td> ";
    echo "<td>"
      .$row["m_fname"].$row["m_name"]
      .' '
      .$row["m_lname"];
      echo '<br/>';
      echo 'Level = '.$row["m_level"];
    echo "</td> ";
    echo "<td>" .$row["m_email"] .  "</td> ";
    echo "<td>" .$row["m_phone"] .  "</td> ";
    echo "<td>" .date('d/m/Y',strtotime($row["m_datesave"])) .  "</td> ";
    echo "</tr>";
    //$i++;
    }
  echo "</table>";
  //5. close connection
  mysqli_close($conn);
  ?>