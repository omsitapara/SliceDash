jQuery('#frmRegister').on('submit',function(e){
	jQuery('.error_field').html('');
	jQuery('#register_submit').attr('disabled',true);
	jQuery('#form_msg').html('Please wait...');
	jQuery.ajax({
		url:'login_register_submit.php',
		type:'post',
		data:jQuery('#frmRegister').serialize(),
		success:function(result){
			jQuery('#form_msg').html('');
			jQuery('#register_submit').attr('disabled',false);
			var data=jQuery.parseJSON(result);
			if(data.status=='error'){
				jQuery('#'+data.field).html(data.msg);
			}
			if(data.status=='success'){
				jQuery('#'+data.field).html(data.msg);
				jQuery('#frmRegister')[0].reset();
			}
		}
		
	});
	e.preventDefault();
});	



jQuery('#frmLogin').on('submit',function(e){
	jQuery('#login_submit').attr('disabled',true);
	jQuery('#form_login_msg').html('Please wait...');
	jQuery.ajax({
		url:'login_register_submit.php',
		type:'post',
		data:jQuery('#frmLogin').serialize(),
		success:function(result){
			jQuery('#form_login_msg').html('');
			jQuery('#login_submit').attr('disabled',false);
			var data=jQuery.parseJSON(result);
			if(data.status=='error'){
				jQuery('#form_login_msg').html(data.msg);
			}
			var is_checkout=jQuery('#is_checkout').val();
			if(is_checkout=='yes'){
				window.location.href='checkout';
			}else if(data.status=='success'){
				//jQuery('#form_login_msg').html(data.msg);
				window.location.href='shop';
			}
		}
		
	});
	e.preventDefault();
});	



function set_checkbox(id){
	var cat_dish=jQuery('#cat_dish').val();
	var check=cat_dish.search(":"+id);
	if(check!='-1'){
		cat_dish=cat_dish.replace(":"+id,'');
	}else{
		cat_dish=cat_dish+":"+id;	
	}
	jQuery('#cat_dish').val(cat_dish);
	jQuery('#frmCatDish')[0].submit();
}

function setFoodType(type){
    jQuery('#type').val(type);
	jQuery('#frmCatDish')[0].submit();
}

function add_to_cart(id,type){
	var qty=jQuery('#qty'+id).val();
	var attr=jQuery('input[name="radio_'+id+'"]:checked').val();
	var is_attr_checked='';
	if(typeof attr=== 'undefined'){
		is_attr_checked='no';
	}
	if(qty>0 && is_attr_checked!='no'){
		jQuery.ajax({
			url:'http://localhost/SliceDash/manage_cart',
			type:'post',
			data:'qty='+qty+'&attt='+attr+'&type='+type,
			success:function(result){
				var data=jQuery.parseJSON(result);
				swal("Congratulation!", "Dish added successfully", "success");
				jQuery('#shop_added_msg_'+attr).html('(Added -'+qty+')');
				jQuery('#totalCartDish').html(data.totalCartDish);
				jQuery('#totalPrice').html('₹'+data.totalPrice);
				var tp1=data.totalPrice;
				if(data.totalCartDish==1){
					var tp=qty*data.price;
					var html='<div class="shopping-cart-content"><ul id="cart_ul"><li class="single-shopping-cart" id="attr_'+attr+'"><div class="shopping-cart-img"><a href="javascript:void(0)"><img alt="" src="'+SITE_DISH_IMAGE+data.image+'"></a></div><div class="shopping-cart-title"><h4><a href="javascript:void(0)">'+data.dish+'</a></h4><h6>Qty: '+qty+'</h6><span>₹'+tp+'</span></div><div class="shopping-cart-delete"><a href="javascript:void(0)" onclick=delete_cart("'+attr+'")><i class="ion ion-close"></i></a></div></li></ul><h4>Total : <span class="shop-total" id="shopTotal">₹'+tp+'</span></h4><div class="shopping-cart-btn"><a href="cart">view cart</a><a href="checkout">checkout</a></div></div>';	
					jQuery('.header-cart').append(html);
				}else{
					var tp=qty*data.price;
					jQuery("#attr_"+attr).remove();
					var html='<li class="single-shopping-cart" id="attr_'+attr+'"><div class="shopping-cart-img"><a href="#"><img alt="" src="'+SITE_DISH_IMAGE+data.image+'"></a></div><div class="shopping-cart-title"><h4><a href="javascript:void(0)">'+data.dish+'</a></h4><h6>Qty: '+qty+'</h6><span>'+'₹'+tp+'</span></div><div class="shopping-cart-delete"><a href="javascript:void(0)" onclick=delete_cart("'+attr+'")><i class="ion ion-close"></i></a></div></li>';
					jQuery('#cart_ul').append(html);
					jQuery('.shop-total').html('₹'+data.totalPrice);
				}
				
			}
		});
	}else{
		swal("Error", "Please select qty and dish item", "error");
	}
}

function delete_cart(id,is_type){
	jQuery.ajax({
		url:FRONT_SITE_PATH+'manage_cart',
		type:'post',
		data:'attt='+id+'&type=delete',
		success:function(result){
			if(is_type=='load'){
				window.location.href=window.location.href;
			}else{
			var data=jQuery.parseJSON(result);
			//swal("Congratulation!", "Dish added successfully", "success");
			jQuery('#totalCartDish').html(data.totalCartDish);
			jQuery('#shop_added_msg_'+id).html('');
			
			if(data.totalCartDish==0){
				jQuery('.shopping-cart-content').remove();
				jQuery('#totalPrice').html('');
			}else{
				jQuery('#shopTotal').html('₹'+data.totalPrice);
				jQuery('#attr_'+id).remove();
				jQuery('#totalPrice').html('₹'+data.totalPrice);
			}
			
		}
		}
	});
}

jQuery('#frmProfile').on('submit',function(e){
	jQuery('#profile_submit').attr('disabled',true);
	jQuery('#form_msg').html('Please wait...');
	jQuery.ajax({
		url:'update_profile',
		type:'post',
		data:jQuery('#frmProfile').serialize(),
		success:function(result){
			jQuery('#form_msg').html('');
			jQuery('#profile_submit').attr('disabled',false);
			var data=jQuery.parseJSON(result);
			if(data.status=='success'){
				jQuery('#user_top_name').html(jQuery('#uname').val());
				swal("Success",data.msg,"success");
			}
		}
		
	});
	e.preventDefault();
});	

jQuery('#frmPassword').on('submit',function(e){
	jQuery('#password_submit').attr('disabled',true);
	jQuery('#password_form_msg').html('Please wait...');
	jQuery.ajax({
		url:'update_profile',
		type:'post',
		data:jQuery('#frmPassword').serialize(),
		success:function(result){
			jQuery('#password_form_msg').html('');
			jQuery('#password_submit').attr('disabled',false);
			var data=jQuery.parseJSON(result);
			if(data.status=='success'){
				swal("Success",data.msg,"success");
				jQuery('#password_form_msg').html(data.msg);
			}
			if(data.status=='error'){
				swal("Error", data.msg,"error");
			}
		}
		
	});
	e.preventDefault();
});	

function apply_coupon(){
	var coupon_code=jQuery('#coupon_code').val();
	if(coupon_code==''){
		jQuery('#coupon_code_msg').html('Please enter coupon code');
	}else{
		jQuery.ajax({
			url:FRONT_SITE_PATH+'apply_coupon',
			type:'post',
			data:'coupon_code='+coupon_code,
			success:function(result){
				var data=jQuery.parseJSON(result);
				if(data.status=='success'){
					swal("Applied", data.msg, "success");
					jQuery('.shopping-cart-total').show();
					jQuery('.remove_coupon').show();
					jQuery('.coupon_code_str').html(coupon_code);
					jQuery('.final_price').html('₹'+data.coupon_code_apply);
					jQuery('#coupon_code_msg').html('');
				}
				if(data.status=='error'){
					swal("Coupon not applied", data.msg, "error");
					jQuery('#coupon_code_msg').html('');
				}
			}
		});
	}
}