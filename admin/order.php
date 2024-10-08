<?php 
include('top.php');

$sql="select order_master.*,order_status.order_status as order_status_str from order_master,order_status where order_master.order_status=order_status.id and payment_status='success' order by order_master.id desc";
$res=mysqli_query($con,$sql);

?>
  <div class="card">
            <div class="card-body">
              <h1 class="grid_title">Order Master</h1>
			  	
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th width="5%">Order Id</th>
                            <th width="15%">Name/Mobile</th>
                            <th width="23%">Address</th>
							<th width="15%">Delivery Boy</th>
							<th width="12%">Order Status</th>
                            <th width="10%">Order Details</th>
                            <th width="10%">Payment Method</th>
							<th width="15%">Ordered On</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(mysqli_num_rows($res)>0){
						$i=1;
						while($row=mysqli_fetch_assoc($res)){
						?>
						<tr>
                            <td><?php echo $row['id']?></td>
                            <td><?php echo $row['name']?>
                                <br><br><?php echo $row['mobile']?>
                            </td>
							<td><?php echo $row['address']?>
                                <br><br><?php echo $row['zipcode']?>
                            </td>
                            <td><?php echo getDeliveryBoyNameById($row['delivery_boy_id'])?></td>
							<td><?php echo ucfirst($row['order_status_str'])?></td>
                            <td>
								<a href="order_details?id=<?php echo $row['id']?>">Click Here</a>
							</td>
                            <td><?php echo strtoupper($row['payment_type'])?></td>
							<td><?php 
							$dateStr= strtotime($row['added_on']);
							echo date('d-m-Y h:i',$dateStr);
							?></td>
                        </tr>
                        <?php 
						$i++;
						} } else { ?>
						<tr>
							<td colspan="5">No data found</td>
						</tr>
						<?php } ?>
                      </tbody>
                    </table>
                  </div>
				</div>
              </div>
            </div>
          </div>
        
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/template.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/todolist.js"></script>
