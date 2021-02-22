<?php
$queryprd = " SELECT * FROM tbl_prd 
ORDER BY  p_id DESC"
    or die("Error:" . mysqli_error($conn));
$rsprd = mysqli_query($conn, $queryprd);
//echo $queryprd;
?>

<!--start  product -->
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12">
            <h3>
                ::List Product::
            </h3>
        </div>
        <?php foreach($rsprd as $rsprd) { ?>
        <div class="col-12 col-sm-3 col-md-3" style="margin-bottom: 20px;">
            <div class="card" style="width: 100%;">
                <img src="databoad/pimg/<?php echo $rsprd['p_img'];?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"> <?php echo $rsprd['p_name']. '( ' .$rsprd['p_qty'].' )';?> </h5>
                    <p class="card-text"> <?php echo $rsprd['p_intro'];?> </p>
                    <p class="card-text"> <?php echo 'ราคา ' . $rsprd['p_price'] . ' บาท';?> </p>
                    
                    <a href="detail.php?p_id=<?php echo $rsprd['p_id']; ?>" class="btn btn-primary" role="button">รายละเอียด</a>

                    <?php if($rsprd['p_qty'] > 0 ) { ?>
                    <a href="cart2.php?p_id=<?php echo $rsprd['p_id'];?>&act=add" class="btn btn-primary">ซื้อสินค้า</a>
                    <?php } else {
                        echo '<button class="btn btn-danger" disabled>สินค้าหมด!!</button>';
                    } ?>

                    
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<!--end  product -->