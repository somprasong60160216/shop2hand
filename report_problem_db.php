<meta charset="utf-8">
<?php
//conn
include('connect.php');

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

// exit();


$p_detail = $_POST["p_detail"];
$p_email = $_POST["p_email"];
$p_phone = $_POST["p_phone"];


//เพิ่มเข้าไปในฐานข้อมูล
$sql = "INSERT INTO tbl_problem
	(p_detail,p_email,p_phone)
	VALUES
	('$p_detail' ,'$p_email', '$p_phone')";
$result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));

// echo $sql;
// exit;

//Line notify

define('LINE_API', "https://notify-api.line.me/api/notify");

$token = "xxx"; //ใส่Token ที่copy เอาไว้
$str =
    'รายละเอียด ' . $p_detail .
    ', เบอร์โทร. ' . $p_phone .
    ' email ' . $p_email; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร

$res = notify_message($str, $token);
print_r($res);
function notify_message($message, $token)
{
    $queryData = array('message' => $message);
    $queryData = http_build_query($queryData, '', '&');
    $headerOptions = array(
        'http' => array(
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                . "Authorization: Bearer " . $token . "\r\n"
                . "Content-Length: " . strlen($queryData) . "\r\n",
            'content' => $queryData
        ),
    );
    $context = stream_context_create($headerOptions);
    $result = file_get_contents(LINE_API, FALSE, $context);
    $res = json_decode($result);
    return $res;
}



$mdate = date('Y-m-d H:i:s');
mail(
    $p_email,
    "ขอบคุณสำหรับแจ้งปัญหาการใช้งานเว็บไซต์ : ",
    $p_detail
        . ' ว/ด/ป '
        . $mdate
);



//exit;


//ปิดการเชื่อมต่อ database
mysqli_close($conn);
//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม

if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('ขอบคุณสำหรับคำแนะนำ !!');";
    echo "window.location = 'index.php'; ";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    //echo "alert('Error!!');";
    echo "window.location = 'index.php'; ";
    echo "</script>";
}

//https://www.w3schools.com/php/func_mail_mail.asp

?>