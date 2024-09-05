<?php 
include 'database.inc.php';
include 'function.inc.php';
include 'constant.inc.php';

if(isset($_POST['pay_id']) && isset($_POST['payment_status']) && isset($_POST['id'])){
    $pay_id=get_safe_value($_POST['pay_id']);
    $payment_status=get_safe_value($_POST['payment_status']);
    $oid=get_safe_value($_POST['id']);

    $sql="update order_master set payment_id='$pay_id',payment_status='$payment_status' where id='$oid'";
    mysqli_query($con,$sql);
}
?>