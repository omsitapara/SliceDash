<?php 
include 'header.php';
$name=get_safe_value($_GET['name']);
$amt=get_safe_value($_GET['amt']);
$id=get_safe_value($_GET['id']);
?>
<form>
											    <div class="billing-information-wrapper">
													<div class="account-info-wrapper">
														<h5>Payment Overview</h5>
													</div>
													<div class="row">
                                                    <div class="col-lg-12 col-md-6">
															<div class="billing-info">
																<label>Order Id</label>
																<input type="text" name="id" id="id"readonly="readonly" required value="<?php echo $id?>">
															</div>
														</div>
														<div class="col-lg-12 col-md-6">
															<div class="billing-info">
																<label>Name</label>
																<input type="text" name="name" id="name"readonly="readonly" required value="<?php echo $name?>">
															</div>
														</div>
														<div class="col-lg-12 col-md-6">
															<div class="billing-info">
																<label>Amount</label>
																<input type="text" readonly="readonly" id="amount" value="<?php echo $amt?>">
															</div>
														</div>
														<div class="billing-btn">
															<input class="pay_btnn" type="button" value="Pay Now"onclick="MakePayment()"/>
														</div>	
													</div>
												</div>
											</form>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>                                           
<script>
function MakePayment(){
    var id=jQuery('#id').val();
	var name=jQuery('#name').val();
	var amount = jQuery('#amount').val();
	var options = {
		"key": "rzp_test_N0fUhXpnvAK7FL", // Enter the Key ID generated from the Dashboard
		"amount": amount*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
		"currency": "INR",
		"name": "SliceDash", //your business name
		"image": "assets/img/logo_razor.png",
        "handler": function(response){
            jQuery.ajax({
                type:"post",
                url:'payment',
                data:"pay_id="+response.razorpay_payment_id+"&payment_status="+"success&id="+id,
                success:function(result){
                    window.location.href='success';
                }
            });
        },
		"prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
			"name": name, //your customer's name
		},
		"notes": {
			"address": "SliceDash Main Office"
		},
		"theme": {
			"color": "#fad4d4"
		}
	};
	var rpz1=new Razorpay(options);
	rpz1.open();
}  
</script>                                         