
<h4> Form Reset Password </h4>
<form action="member_form_rwd_db.php" method="post" class="form-horizontal">
  <div class="form-group">
    <div class="col-sm-2 control-label">
      Username :
    </div>
    <div class="col-sm-4">
      <input type="text" name="m_username" required class="form-control" autocomplete="off" value="<?php echo $row['m_username'];?>" disabled>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      New Password :
    </div>
    <div class="col-sm-4">
      <input type="password" name="m_password1" required class="form-control">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      Confirm Password :
    </div>
    <div class="col-sm-4">
      <input type="password" name="m_password2" required class="form-control">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-4">
      <input type="hidden" name="m_id" value="<?php echo $row['m_id'];?>">
      <button type="submit" class="btn btn-primary">Reset Password</button>
    </div>
  </div>
</form>