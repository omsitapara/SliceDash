<?php
session_start();
include('../database.inc.php');
include('../function.inc.php');
$msg="";
if(isset($_POST['submit'])){
	$mobile=get_safe_value($_POST['mobile']);
	$password=get_safe_value($_POST['password']);
	
	$sql="select * from delivery_boy where mobile='$mobile' and password='$password'";
	$res=mysqli_query($con,$sql);
	if(mysqli_num_rows($res)>0){
		$row=mysqli_fetch_assoc($res);
		$_SESSION['DELIVERY_BOY_USER_LOGIN']='yes';
		$_SESSION['DELIVERY_BOY_USER']=$row['name'];
		$_SESSION['DELIVERY_BOY_ID']=$row['id'];
		redirect('index.php');
	}else{
		$msg="Please enter valid login details";
	}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href = "../admin/assets/images/logo.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SliceDash Delivery Buddy</title>
  <link rel="stylesheet" href="../admin/assets/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../admin/assets/css/style.css">
</head>
<body class="sidebar-light">
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo text-center">
                <img src="../admin/assets/images/logo.png" alt="logo">
                <br/>
                <br/>
                <h5 style="color:#667eea">DELIVERY BUDDY PANEL</h5>
              </div>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" method="post">
                <div class="form-group">
                  <input type="textbox" name="mobile" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Mobile" required>
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" required>
                </div>
                <div class="mt-3">
                    <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="SIGN IN" name="submit"/>
                </div>
                <div class="login_msg"><?php echo $msg?></div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <script src="../admin/assets/js/bootstrap-datepicker.min.js"></script>

</body>
</html>