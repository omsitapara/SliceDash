<?php
session_start();
include 'header.php';
$id=get_safe_value($_GET['id']);
$uid=$_SESSION['FOOD_USER_ID'];
$sql="select coupon_code,final_price from order_master where id='$id'";
$res=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($res);
?>
<div class="card">
            <div class="card-body">
              <h1 class="grid_title">Order ID <?php echo $id ?> Details</h1>
			  	
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>Item</th>
                            <th>Attribute</th>
                            <th>Quantity</th>
                            <th>Price per Unit</th>
                            <th>Subtotal</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php
                       $totalPrice=0;
                       $getOrderDetails=getOrderDetails($id);
                       $uid=$_SESSION['FOOD_USER_ID'];
                       foreach($getOrderDetails as $list){
                        $totalPrice = $totalPrice +$list['qty']*$list['price']
                        ?>
                        <tr>
                            <td><?php echo $list['dish']?></td>
							<td><?php echo $list['attribute']?></td>
                            <td><?php echo $list['qty']?></td>
							<td><?php echo '₹'.$list['price']?></td>
							<td><?php echo '₹'.$list['qty']*$list['price']?></td>
                        </tr>
                        <?php
                       }
                       ?>
                      </tbody>
                    </table>

                    <div style="float:right; margin-right: 80px;">
                        <p style="
                                margin-top:8px;
                                font-weight:bold;
                                font-size:16px">
                        Total: <?php echo '₹'.$totalPrice?><br/>
                        Coupon: <?php if($row['coupon_code']==''){
                          echo 'Not Applied';
                        }else{
                          echo $row['coupon_code'];
                        }?><br/>
                        FinalPrice: <?php echo '₹'.$row['final_price']?>
                        </p>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div style="float:center">
                            <a href="order_history" class="btn btn-primary">Back to Order History</a>
                    </div>
