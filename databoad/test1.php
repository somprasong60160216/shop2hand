<?php 
//show data 

echo 'aaaaaaaaa';
echo '<br>';

$a=1000004;
$b=30000;
$c= ($a*$b);

echo $c;

echo '<br>';

echo number_format($c,2);

//text
echo '<hr>';
$fname = 'Mr.';
$name = 'pisit';
$lname= 'bow';
$myname = $fname.$name.' '.$lname;
echo $myname;


//date
echo '<hr>';

echo date('d/m/Y');
echo date('H:i:s');

//Set ว/ด/ป เวลา ให้เป็นของประเทศไทย
    date_default_timezone_set('Asia/Bangkok');

  echo '<br>';
  echo date('H:i:s');


  $mydate = date('Y-m-d H:i:s');

  echo '<br>';

  echo date('d/m/Y',strtotime($mydate));


//condition
echo '<hr>';

$productqty = 0;

if($productqty > 0){
	echo 'Add to cart ';
}else{
	echo 'Out of stock';
}

echo '<hr>';


$mlevel ='M';

if($mlevel=='A'){
	echo 'admin';
}elseif($mlevel=='M'){
	echo 'member';
}elseif($mlevel=='D'){
	echo 'director';
}else{
	echo 'user';
}










 ?>