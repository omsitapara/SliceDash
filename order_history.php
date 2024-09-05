<?php
include ("header.php");
if(!isset($_SESSION['FOOD_USER_ID'])){
	redirect(FRONT_SITE_PATH.'shop');
}
$uid=$_SESSION['FOOD_USER_ID'];
$sql="select order_master.*,order_status.order_status as order_status_str from order_master,order_status where order_master.order_status=order_status.id and order_master.user_id='$uid' and payment_status='success' order by order_master.id desc";

$res=mysqli_query($con,$sql);
?>

<div class="cart-main-area pt-95 pb-100">
            <div class="container">
                <h3 class="page-title">Order History</h3>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <form method="post">
							<div class="table-content table-responsive">
								
                                <table>
                                    <thead>
                                        <tr>
                                            <th width="10%">Order Id</th>
                                            <th width="10%">Price</th>
                                            <th width="25%">Address</th>
                                            <th width="15%">Order Detail</th>
                                            <th width="10%">Payment Method</th>
											<th width="15%">Delivery Boy</th>
                                            <th width="15%">Order Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php if(mysqli_num_rows($res)>0){
										$i=1;
										while($row=mysqli_fetch_assoc($res)){
										?>
										<tr>
                                            <td><?php echo $row['id']?>
											<br/>
											</td>
                                            <td><?php echo '₹'.$row['final_price']?>
                                            </td>
                                            <td><?php echo $row['address']?><br/>
											<?php echo $row['zipcode']?></td>
											<td>
												<a href="order_detail?id=<?php echo $row['id']?>" class="btn btn-primary">Click Here</a>
											</td>
                                            <td><?php echo strtoupper($row['payment_type']) ?></td>
											<td><?php echo getDeliveryBoyNameById($row['delivery_boy_id'])?></td>
											<td><?php echo $row['order_status_str']?></td>
                                        </tr>
										<?php }} ?>
                                    </tbody>
                                </table>
								
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>

<?php
include("footer.php");
?>