<?php
include 'header.php';
$cartArr=getUserFullCart();
if(count($cartArr)>0){

}
else{
    redirect('shop');
}

if(isset($_SESSION['FOOD_USER_ID'])){
    $is_show='';
    $box_id='';
    $final_show='show';
    $final_box_id='payment-2';
}
else{
    $is_show='show';
    $box_id='payment-1';
    $final_show='';
    $final_box_id='';
}
$userArr=getUserDetailsByid();
if(isset($_POST['place_order'])){
    $checkout_name=get_safe_value($_POST['checkout_name']);
	$checkout_email=get_safe_value($_POST['checkout_email']);
	$checkout_mobile=get_safe_value($_POST['checkout_mobile']);
    $checkout_zip=get_safe_value($_POST['checkout_zip']);
    $checkout_address=get_safe_value($_POST['checkout_address']);
    $payment_type=get_safe_value($_POST['payment_type']);
    $added_on=date('Y-m-d h:i:s');
    $sql="insert into order_master(user_id,name,email,mobile,address,zipcode,total_price,payment_status,order_status,added_on) values('".$_SESSION['FOOD_USER_ID']."','$checkout_name','$checkout_email','$checkout_mobile','$checkout_address','$checkout_zip','$totalPrice','pending','1','$added_on')";
    mysqli_query($con,$sql);
    $insert_id=mysqli_insert_id($con);
    $_SESSION['ORDER_ID']= $insert_id;
    foreach($cartArr as $key=>$val){
        mysqli_query($con,"insert into order_detail(order_id,dish_details_id,price,qty) values('$insert_id','$key','".$val['price']."','".$val['qty']."')");
    }
    emptycart();
    redirect('success');
}
?>

<div class="checkout-area pb-80 pt-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="checkout-wrapper">
                            <div id="faq" class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><span>1.</span> <a data-toggle="collapse" data-parent="#faq" href="#payment-1">User Authentication</a></h5>
                                    </div>
                                    <div id="<?php echo $box_id ?>" class="panel-collapse collapse <?php echo $is_show?>">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="checkout-login">
                                                        <!-- <div class="title-wrap">
                                                            <h4 class="cart-bottom-title section-bg-white">LOGIN</h4>
                                                        </div>
                                                        <p>&nbsp;</p>
                                                        <form>
                                                            <div class="login-form">
                                                                <label>Email Address * </label>
                                                                <input type="email" name="email">
                                                            </div>
                                                            <div class="login-form">
                                                                <label>Password *</label>
                                                                <input type="password" name="email">
                                                            </div> -->
                                                        </form>
                                                         <div class="checkout-login-btn">
                                                            <!-- <a href="#">Login</a> -->
															<a href="login_register" style="background-color: #e02c2b;color:#fff;">Login/Register</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><span>2.</span> <a data-toggle="collapse" data-parent="#faq" href="#payment-2">Other information</a></h5>
                                    </div>
                                    <div id="<?php echo $final_box_id?>" class="panel-collapse collapse <?php echo $final_show?>">
                                        <div class="panel-body">
                                            <form method="post">
                                            <div class="billing-information-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Full Name</label>
                                                            <input type="text" name="checkout_name" required value="<?php echo $userArr['name'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Email Address</label>
                                                            <input type="email" name="checkout_email" required value="<?php echo $userArr['email'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Mobile</label>
                                                            <input type="number" name="checkout_mobile"
                                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                            maxlength = "10" required value="<?php echo $userArr['mobile'] ?>">
                                                        </div>
                                                    </div>
													<div class="col-lg-3 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Zip/Postal Code</label>
                                                            <input type="number" name="checkout_zip"
                                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                            maxlength = "6" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="billing-info">
                                                            <label>Address</label>
                                                            <input type="text" name="checkout_address" required>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="ship-wrapper">
                                                    <div class="single-ship">
                                                        <input type="radio" name="payment_type" value="cod" checked="">
                                                        <label>Cash on Delivery(COD)</label>
                                                    </div>
                                                    <!--<div class="single-ship">
                                                        <input type="radio" name="address" value="dadress">
                                                        <label>Ship to different address</label>
                                                    </div>-->
                                                </div>
                                                <div class="billing-back-btn">
                                                    <div class="billing-btn">
                                                        <button type="submit" name="place_order">Place Your Order</button>
                                                    </div>
                                                </div>
                                            </div>
                                         </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-lg-12">
                                    <div class="cart-shiping-update-wrapper">
                                        <div class="cart-shiping-update">
                                            <a href="cart">Back To Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
						   </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="checkout-progress">
                            <div class="shopping-cart-content-box">
								<h4 class="checkout_title">Cart Details</h4>
								<ul>
                                <?php 
                                foreach($cartArr as $key=>$list){ ?>
									<li class="single-shopping-cart">
										<div class="shopping-cart-img">
											<a href="#"><img alt="" src="<?php echo SITE_DISH_IMAGE.$list['image']?>"></a>
										</div>
										<div class="shopping-cart-title">
											<h4><a href="#"><?php echo $list['dish'] ?> </a></h4>
											<h6>Qty:<?php echo $list['qty']?></h6>
											<span><?php echo "₹".$list['price']*$list['qty'] ?></span>
										</div>
									</li>
                                    <?php } ?>
								</ul>
								<div class="shopping-cart-total">
									<h4>Total : <span class="shop-total"><?php echo "₹".$totalPrice ?></span></h4>
								</div>
								
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
include 'footer.php'
?>