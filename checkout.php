<?php
include ("header.php");
$cartArr=getUserFullCart();
if(count($cartArr)>0){
	
	
}else{
	redirect(FRONT_SITE_PATH.'shop');
}

if(isset($_SESSION['FOOD_USER_ID'])){
	$is_show='';
	$box_id='';
	$final_show='show';
	$final_box_id='payment-2';
}else{
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
	if(isset($_SESSION['COUPON_CODE']) && isset($_SESSION['FINAL_PRICE'])){
		$coupon_code=get_safe_value($_SESSION['COUPON_CODE']);
		$final_price=get_safe_value($_SESSION['FINAL_PRICE']);
	}
	else{
		$coupon_code='';
		$final_price=$totalPrice;
	}
	$added_on=date('Y-m-d h:i:s');
	$sql="insert into order_master(user_id,name,email,mobile,address,zipcode,total_price,order_status,payment_status,added_on,coupon_code,final_price) values('".$_SESSION['FOOD_USER_ID']."','$checkout_name','$checkout_email','$checkout_mobile','$checkout_address','$checkout_zip','$totalPrice','1','pending','$added_on','$coupon_code','$final_price')";
	mysqli_query($con,$sql);
	$insert_id=mysqli_insert_id($con);
	$_SESSION['ORDER_ID']=$insert_id;
	foreach($cartArr as $key=>$val){
		mysqli_query($con,"insert into order_detail(order_id,dish_details_id,price,qty) values('$insert_id','$key','".$val['price']."','".$val['qty']."')");
	}
	emptyCart();
	redirect(FRONT_SITE_PATH.'success');
	
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
                                        <h5 class="panel-title"><span>1.</span> <a data-toggle="collapse" data-parent="#faq" href="#payment-1">Checkout method</a></h5>
                                    </div>
                                    <div id="<?php echo $box_id?>" class="panel-collapse collapse <?php echo $is_show?>">
                                        <div class="panel-body">
                                            <div class="row">
                                                
                                                <div class="col-lg-12">
                                                    <div class="checkout-login">
                                                        <div class="title-wrap">
                                                            <h4 class="cart-bottom-title section-bg-white">LOGIN</h4>
                                                        </div>
                                                        <p>&nbsp;</p>
                                                        <form method="post" id="frmLogin">
                                                            <div class="login-form">
                                                                <label>Email Address * </label>
                                                                <input name="user_email" placeholder="Email" required>
                                                            </div>
                                                            <div class="login-form">
                                                                <label>Password *</label>
                                                                <input type="password" name="user_password" placeholder="Password" required>
																<input type="hidden" name="type" value="login"/>
																<input type="hidden" name="is_checkout" value="yes" id="is_checkout"/>
                                                            </div>
                                                        
                                                         <div class="checkout-login-btn">
                                                            <button type="submit" id="login_submit" class="my_btn">Login</button>
															<a href="<?php echo FRONT_SITE_PATH?>login_register" style="background-color: #e02c2b;color:#fff;">Register Now</a>
                                                        </div>
														</form>
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
																<label>Name</label>
																<input type="text" name="checkout_name" required value="<?php echo $userArr['name']?>">
															</div>
														</div>
														<div class="col-lg-3 col-md-6">
															<div class="billing-info">
																<label>Email Address</label>
																<input type="email"  name="checkout_email" required value="<?php echo $userArr['email']?>">
															</div>
														</div>
														<div class="col-lg-3 col-md-6">
															<div class="billing-info">
																<label>Mobile</label>
																<input type="text"  name="checkout_mobile"
                                                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                            maxlength = "10"
                                                                required value="<?php echo $userArr['mobile']?>">
															</div>
														</div>
														<div class="col-lg-3 col-md-6">
															<div class="billing-info">
																<label>Zip/Postal Code</label>
																<input type="text"  name="checkout_zip" required
                                                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                            maxlength = "6"
                                                                >
															</div>
														</div>
														<div class="col-lg-12 col-md-12">
															<div class="billing-info">
																<label>Address</label>
																<input type="text"  name="checkout_address" required>
															</div>
														</div>
														<div class="col-lg-3 col-md-4">
															<div class="billing-info">
																<label>Have a Coupon Code?</label>
																<input type="text"  name="coupon_code" id="coupon_code">
															</div>
															<div class="remove_coupon"><a class="remove_c" href='checkout'>Remove Coupon</a></div>
															<div id="coupon_code_msg"></div>
														</div>
														<div class="col-lg-3 col-md-12">
														<div class="billing-back-btn">
														<div class="billing-btn">
															<button type="button" name="place_order" onclick="apply_coupon()">Apply Code</button>
														</div>
													</div>
														</div>
													</div>
													<div class="ship-wrapper">
														<div class="single-ship">
															<input type="radio" name="payment_type" value="cod" checked="checked">
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
                                
						   </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="checkout-progress">
                            <div class="shopping-cart-content-box">
								<h4 class="checkout_title">Cart Details</h4>
								<ul>
									<?php foreach($cartArr as $key=>$list){ ?>
									<li class="single-shopping-cart">
										<div class="shopping-cart-img">
											<a href="#"><img alt="" src="<?php echo SITE_DISH_IMAGE.$list['image']?>"></a>
										</div>
										<div class="shopping-cart-title">
											<h4><a href="#"><?php echo $list['dish']?> </a></h4>
											<h6>Qty: <?php echo $list['qty']?></h6>
											<span><?php echo 
														'₹'.$list['qty']*$list['price'];?></span>
										</div>
										
									</li>
									<?php } ?>
								</ul>
								<div class="shopping-cart-total">
									<h4>Total : <span class="shop-total"><?php echo '₹'.$totalPrice?></span></h4>
								</div>
								<div class="shopping-cart-total coupon_price_box">
									<h4>Coupon Code : <span class="shop-total coupon_code_str"></span></h4>
								</div>
								<div class="shopping-cart-total coupon_price_box">
									<h4>Final Price : <span class="shop-total final_price"></span></h4>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

<?php
if(isset($_SESSION['COUPON_CODE'])){
	unset($_SESSION['COUPON_CODE']);
	unset($_SESSION['FINAL_PRICE']);
}
include("footer.php");
?>