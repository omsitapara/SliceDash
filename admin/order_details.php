<?php 
include('top.php');
if(isset($_GET['id']) && $_GET['id']>0){
	
	$id=get_safe_value($_GET['id']);
	
	if(isset($_GET['order_status'])){
		$order_status=get_safe_value($_GET['order_status']);
		mysqli_query($con,"update order_master set order_status='$order_status' where id='$id'");
		redirect('order_details.php?id='.$id);
	}
	
	if(isset($_GET['delivery_boy'])){
		$delivery_boy=get_safe_value($_GET['delivery_boy']);
		mysqli_query($con,"update order_master set delivery_boy_id='$delivery_boy' where id='$id'");
		redirect('order_details.php?id='.$id);
	}
	
	$sql="select order_master.*,order_status.order_status as order_status_str from order_master,order_status where order_master.order_status=order_status.id and order_master.id='$id' order by order_master.id desc";
	$res=mysqli_query($con,$sql);
	if(mysqli_num_rows($res)>0){
		$orderRow=mysqli_fetch_assoc($res);
	}else{
		redirect('index.php');
	}
}else{
	redirect('index.php');
}
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
                        Coupon: <?php if($coupon_row['coupon_code']==''){
                          echo 'Not Applied';
                        }else{
                          echo $coupon_row['coupon_code'];
                        }?><br/>
                        FinalPrice: <?php echo '₹'.$coupon_row['final_price']?>
                        </p>
                    </div><br/><br/><br/><br/><br/><br>
                    <?php
                        $orderStatusRes=mysqli_query($con,"select * from order_status order by id");
                        $orderDeliveryBoyRes=mysqli_query($con,"select * from delivery_boy where status=1 order by name");
                    ?>
                    <div style="margin-left:24px">Current Status: <?php echo $orderRow['order_status_str']?></div>
                    <div style="margin:8px; float:left">
                        <select class="form-control wSelect20" style="margin-left:18px; margin-bottom:10px" name="order_status" id="order_status" onchange="updateOrderStatus()">
                            <option val=''>Update Order Status</option>
                            <?php while($row=mysqli_fetch_assoc($orderStatusRes)){
                                echo "<option value=".$row['id'].">".$row['order_status']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div style="margin-right:80px; margin-top:-20px;float:right">    
                        <div style="margin-left: 18px;">Delivery Boy: <?php echo getDeliveryBoyNameById($orderRow['delivery_boy_id']) ?></div>
                        <select class="form-control wSelect20" style="margin-left:18px; margin-bottom:10px" name="delivery_boy" id="delivery_boy" onchange="updateDeliveryBoy()">
                            <option val=''>Assign Delivery Boy</option>
                            <?php while($orderDeliveryBoyRow=mysqli_fetch_assoc($orderDeliveryBoyRes)){
                                echo "<option value=".$orderDeliveryBoyRow['id'].">".$orderDeliveryBoyRow['name']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div style="float:center">
                            <a href="order" class="btn btn-primary">Back to Orders</a>
                    </div>

<script>
    function updateOrderStatus(){
    var order_status = jQuery('#order_status').val();
    if(order_status!=''){
        var oid= "<?php echo $id?>";
        window.location.href='<?php echo FRONT_SITE_PATH?>admin/order_details?id='+oid+'&order_status='+order_status;
    }
}

function updateDeliveryBoy(){
    var delivery_boy = jQuery('#delivery_boy').val();
    if(delivery_boy!=''){
        var oid= "<?php echo $id?>";
        window.location.href='<?php echo FRONT_SITE_PATH?>admin/order_details?id='+oid+'&delivery_boy='+delivery_boy;
    }
}
</script>