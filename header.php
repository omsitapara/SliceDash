<?php
session_start();
include 'function.inc.php';
include 'database.inc.php';
include 'constant.inc.php';
if(isset($_POST['update_cart'])){
    foreach($_POST['qty'] as $key=>$val){
    if(isset($_SESSION['FOOD_USER_ID'])){
        if($val[0]==0){
            mysqli_query($con,"delete from dish_cart set qty='".$val[0]."' where dish_detail_id='$key' and user_id=".$_SESSION['FOOD_USER_ID']."");
        }
        else{
            mysqli_query($con,"update dish_cart set qty='".$val[0]."' where dish_detail_id='$key' and user_id=".$_SESSION['FOOD_USER_ID']."");
        }
    }else{
        if($val[0]==0){
            unset($_SESSION['cart'][$key]['qty']);
        }
        else{
            $_SESSION['cart'][$key]['qty']=$val[0];
        }
        }
    }
}
$cartArr=getUserFullCart();
$totalCartDish=count($cartArr);
$totalPrice=0;
foreach($cartArr as $list){
    $totalPrice=$totalPrice+($list['qty']*$list['price']);
}
// prx($cartArr)
?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo FRONT_SITE_NAME?></title>
        <link rel="icon" href="assets/logo.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/slick.css">
        <link rel="stylesheet" href="assets/css/chosen.min.css">
        <link rel="stylesheet" href="assets/css/ionicons.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/simple-line-icons.css">
        <link rel="stylesheet" href="assets/css/jquery-ui.css">
        <link rel="stylesheet" href="assets/css/meanmenu.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!-- header start -->
        <header class="header-area">
            <div class="header-top black-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12 col-sm-4">
                            <div class="welcome-area">
                                <p></p>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-12 col-sm-8">
                            <div class="account-curr-lang-wrap f-right">
                                                <?php
                                                if(isset($_SESSION['FOOD_USER_NAME'])){
                                                    ?>
                                        <ul>
                                    
                                    
                                    <li class="top-hover"><a href="#"><?php echo "Welcome <span id='user_top_name'>".$_SESSION['FOOD_USER_NAME']?></span><i class="ion-chevron-down"></i></a>
                                        <ul>
                                            <li><a href="profile">Profile </a></li>
                                            <li><a href="order_histroy">Order History</a></li>
                                            <li><a href="logout">Logout</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-middle">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-12 col-sm-4">
                            <div class="logo">
                                <a href="shop">
                                    <img alt="" src="assets/img/logo/slice_main.png" height="50px">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8 col-12 col-sm-8">
                            <div class="header-middle-right f-right">
                                <div class="header-login">
                                                <?php
                                                if(!isset($_SESSION['FOOD_USER_NAME'])){
                                                    ?>
                                         <a href="login_register">
                                        <div class="header-icon-style">
                                            <i class="icon-user icons"></i>
                                        </div>
                                        <div class="login-text-content">
                                            
                                        <p>Register <br> or <span>Sign in</span></p>                                            
                                        </div>
                                    </a>
                                    <?php } ?>
                                </div>
                                <div class="header-wishlist">
                                   &nbsp;
                                </div>
                                <div>
                                    <a href="cart">
                                        <div class="header-icon-style">
                                            <i class="icon-handbag icons"></i>
                                            <span class='badge badge-warning' id='totalCartDish'><?php echo $totalCartDish?></span>
                                        </div>
                                        <div class="cart-text">
                                            <span class="digit">My Cart</span><br>
                                            <span class="cart-digit-bold" id="totalPrice">
                                            <?php 
                                            if($totalPrice!=0){
                                            echo '₹'.$totalPrice;
                                            }?>  </span>
                                        </div>
                                        </a>
							    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom transparent-bar black-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="main-menu">
                                <nav>
                                    <ul>
                                        <li><a href="shop">Home</a></li>
                                        <li><a href="about-us">About</a></li>
                                        <li><a href="contact-us">Contact us</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- mobile-menu-area-start -->
			<div class="mobile-menu-area">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="mobile-menu">
								<nav id="mobile-menu-active">
									<ul class="menu-overflow" id="nav">
										<li><a href="shop">Home</a></li>
										<li><a href="about-us">About</a></li>
										<li><a href="contact-us">Contact us</a></li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- mobile-menu-area-end -->
        </header>