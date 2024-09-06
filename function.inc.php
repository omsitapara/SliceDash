<?php
function pr($arr){
    echo '<pre>';
    print_r($arr);
}

function prx($arr){
    echo '<pre>';
    print_r($arr);
    die();
}

function get_safe_value($str){
    global $con;
    $str=mysqli_real_escape_string($con,$str);
    return $str;
}
function redirect($link){
    ?>
    <script>
    window.location.href='<?php echo $link?>';
    </script>
    <?php
    die();
}

function getUserCart(){
	global $con;
	$arr=array();
	$id=$_SESSION['FOOD_USER_ID'];
	$res=mysqli_query($con,"select * from dish_cart where user_id='$id'");
	while($row=mysqli_fetch_assoc($res)){
		$arr[]=$row;
	}
	return $arr;
}

function manageUserCart($uid,$qty,$attr){
	global $con;
	$res=mysqli_query($con,"select * from dish_cart where user_id='$uid' and dish_detail_id='$attr'");
	if(mysqli_num_rows($res)>0){
		$row=mysqli_fetch_assoc($res);
		$cid=$row['id'];
		mysqli_query($con,"update dish_cart set qty='$qty' where id='$cid'");
	}else{
		$added_on=date('Y-m-d h:i:s');
		mysqli_query($con,"insert into dish_cart(user_id,dish_detail_id,qty,added_on) values('$uid','$attr','$qty','$added_on')");
	}
}

function getUserFullCart($attr_id=''){
	$cartArr=array();
	if(isset($_SESSION['FOOD_USER_ID'])){
		$getUserCart=getUserCart();
		$cartArr=array();
		foreach($getUserCart as $list){
			$cartArr[$list['dish_detail_id']]['qty']=$list['qty'];
			$getDishDetail=getDishDetailById($list['dish_detail_id']);
			$cartArr[$list['dish_detail_id']]['price']=$getDishDetail['price'];
			$cartArr[$list['dish_detail_id']]['dish']=$getDishDetail['dish'];
			$cartArr[$list['dish_detail_id']]['image']=$getDishDetail['image'];
		}
	}else{
		if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0){
			foreach($_SESSION['cart'] as $key=>$val){
				$cartArr[$key]['qty']=$val['qty'];
				$getDishDetail=getDishDetailById($key);
				$cartArr[$key]['price']=$getDishDetail['price'];
				$cartArr[$key]['dish']=$getDishDetail['dish'];
				$cartArr[$key]['image']=$getDishDetail['image'];
			}
		}
	}
	if($attr_id!=''){
		return $cartArr[$attr_id]['qty'];
	}else{
		return $cartArr;
	}
}

function getDishDetailById($id){
	global $con;
	$res=mysqli_query($con,"select dish.dish,dish.image,dish_details.price from dish_details,dish where dish_details.id='$id' and dish.id=dish_details.dish_id");
	$row=mysqli_fetch_assoc($res);
	return $row;
}

function removeDishFromCartByid($id){
	if(isset($_SESSION['FOOD_USER_ID'])){
		global $con;
		$res=mysqli_query($con,"delete from dish_cart where dish_detail_id='$id' and user_id=".$_SESSION['FOOD_USER_ID']);
	}else{
		unset($_SESSION['cart'][$id]);
	}
}

function getUserDetailsByid(){
	global $con;
	$data['name']='';
	$data['email']='';
	$data['mobile']='';
	if(isset($_SESSION['FOOD_USER_ID'])){
	$uid = $_SESSION['FOOD_USER_ID'];
	$row=mysqli_fetch_assoc(mysqli_query($con,"select * from user where id='$uid'"));
	$data['name']=$row['name'];
	$data['email']=$row['email'];
	$data['mobile']=$row['mobile'];
	}
	return $data;
}

function emptycart(){
	if(isset($_SESSION['FOOD_USER_ID'])){
		global $con;
		$res=mysqli_query($con,"delete from dish_cart where user_id=".$_SESSION['FOOD_USER_ID']);
	}else{
		unset($_SESSION['cart']);
	}
}

function getOrderDetails($oid){
	global $con;
	$sql="select order_detail.price,order_detail.qty,dish_details.attribute,dish.dish
	from order_detail,dish_details,dish
	WHERE
	order_detail.order_id=$oid AND
	order_detail.dish_details_id=dish_details.id AND
	dish_details.dish_id=dish.id";
	$data=array();
	$res=mysqli_query($con,$sql);
	while($row=mysqli_fetch_assoc($res)){
		$data[]=$row;
	}
	return $data;	
}

function getOrderById($oid){
	global $con;
	$sql="select * from order_master where id='$oid'";
	$data=array();
	$res=mysqli_query($con,$sql);
	while($row=mysqli_fetch_assoc($res)){
		$data[]=$row;
	}
	return $data;	
}

function getDeliveryBoyNameById($id){
	global $con;
	$sql="select name,mobile from delivery_boy where id='$id'";
	$res=mysqli_query($con,$sql);
	if(mysqli_num_rows($res)>0){
	$row=mysqli_fetch_assoc($res);
	return $row['name'].'('.$row['mobile'].')';
	}else{
		return 'Not Assigned';
	}
}

function getcartTotalPrice(){
	$cartArr=getUserFullCart();
	$totalPrice=0;
	foreach($cartArr as $list){
		$totalPrice=$totalPrice+($list['qty']*$list['price']);
	}
	return $totalPrice;
}

function getSale($start,$end){
	global $con;
	$sql="select sum(final_price) as final_price from order_master where added_on between '$start' and '$end' and order_status=4";
	$res=mysqli_query($con,$sql);
	
	while($row=mysqli_fetch_assoc($res)){
		return '₹'.(int)$row['final_price'];
	}
}
?>
