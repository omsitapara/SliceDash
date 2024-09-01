<?php
session_start();
include 'top.php';
if(isset($_GET['id']) && $_GET['id']>0){
    $id=get_safe_value($_GET['id']);
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
                       $getOrderDetails=getOrderDetails($id);
                       foreach($getOrderDetails as $list){
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

                    <a href="order" class="btn btn-primary">Back to Orders</a>
<?php
include 'footer.php'
?>

