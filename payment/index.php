<?php 
session_start();
include_once ('../db.php'); 
 $sqlProduct = "SELECT * FROM user_services where prod_id = '".$_GET['product_id']."' and user_id = '".$_SESSION['user_id']."'"; 
 
 $result = $conn->query($sqlProduct); 
 $data = $result->fetch_assoc(); 

 $sqlUser = "SELECT * FROM users where user_id = '".$_SESSION['user_id']."'"; 
 
 $resultData = $conn->query($sqlUser); 
 $userData = $resultData->fetch_assoc(); 
 
 $messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : '';
 unset($_SESSION['messages']);
 
 $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : '';
 unset($_SESSION['errors']);
 
?>
<?php
if(isset($_SESSION['loggedin']) == true){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Advocatemail Member Dashboard </title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://checkout.razorpay.com/v1/checkout.js"></script> 
</head>
<body>
<?php
include('../layout/header.php');
include('../layout/nav.php');
?>
<div class="container"> 
 <div class="row">
    <div class="col-sm-6 col-sm-offset-3">
       <span class="success" style="color:blue;"><?php echo $messages; ?> </span><br>
        <div class="panel panel-primary">
            <div class="panel-heading">Payment Method</div>
		        <div class="panel-body">
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" value="<?php echo $data['name']?>" name="billing_name" id="billing_name" readonly>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" value="<?php echo $userData['email']?>" name="billing_email" id="billing_email" readonly>
					</div>
					
					<div class="form-group">
						<label>Mobile Number</label>
						<input type="number" class="form-control" value="<?php echo $userData['mobile']?>" name="billing_mobile" id="billing_mobile" readonly>
					</div>
					
                    <div class="form-group">
						<label>Address</label>
						<input type="text" class="form-control" value="<?php echo $userData['address']?>" name="billing_address" id="billing_address" readonly>
					</div>

                    <div class="form-group"> 
						<label>Product Name</label>
						<input type="text" name="prod_name" id="website" value="<?php echo $data['prod_name']; ?>" class="form-control" readonly/>
					</div>

					<div class="form-group"> 
						<label>Product Description</label>
						<input type="text" name="prod_desc" id="prod_desc" value="<?php echo $data['prod_desc']; ?>" class="form-control" readonly/>
					</div>

				    <div class="form-group"> 
						<label>Product Quantity:</label>
						<input type="number" name="prod_qty" id="quantity" value="<?php echo $data['prod_qty']; ?>" class="form-control" readonly/>
					</div>

					<div class="form-group">
						<label>Payment Amount</label>
						<input type="text" class="form-control" value="<?php echo $data['prod_value']?>" name="payAmount" id="payAmount" value="10" readonly>
					</div>
					
					<!-- submit button -->
					<button  id="PayNow" class="btn btn-success btn-lg btn-block" >Submit & Pay</button>
									
				</div>
				<div class="panel-footer">
				</div>
            </div>
        </div>
    </div>
</div><br>
<?php
include('../layout/footer.php');
?>
<script>
        //Pay Amount
        jQuery(document).ready(function($){
    
            jQuery('#PayNow').click(function(e){
            
                var paymentOption='';
                let billing_name = $('#billing_name').val();
                let billing_mobile = $('#billing_mobile').val();
                let billing_email = $('#billing_email').val();
                let billing_address = $('#billing_address').val();
                let website = $('#website').val();
                let prod_desc = $('#prod_desc').val();
                let quantity = $('#quantity').val();

                var shipping_name = $('#billing_name').val();
                var shipping_mobile = $('#billing_mobile').val();
                var shipping_email = $('#billing_email').val();
                var paymentOption= "netbanking";
                var payAmount = $('#payAmount').val();
                        
                var request_url="http://localhost/advocom/payment/submitpayment.php";
                var formData = {
                    billing_name:billing_name,
                    billing_mobile:billing_mobile,
                    billing_email:billing_email,
                    billing_address:billing_address,
                    website:website,
                    prod_desc:prod_desc,
                    quantity:quantity,
                    shipping_name:shipping_name,
                    shipping_mobile:shipping_mobile,
                    shipping_email:shipping_email,
                    paymentOption:paymentOption,
                    payAmount:payAmount,
                    action:'payOrder'
                }
            
                $.ajax({
                    type: 'POST',
                    url:request_url,
                    data:formData,
                    dataType: 'json',
                    encode:true,
                }).done(function(data){
                    if(data.res=='success'){
                        var orderID=data.order_number;
                        var orderNumber=data.order_number;
                        var options = {
                        "key": data.razorpay_key, // Enter the Key ID generated from the Dashboard
                        "amount": data.userData.amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                        "currency": "INR",
                        "name": data.userData.website, //your business name
                        "description": data.userData.description,
                        "image": "http://localhost/advocom/image/logo.png",
                        "order_id": data.userData.rpay_order_id, //This is a sample Order ID. Pass 
                        "handler": function (response){
                    
                        window.location.replace("payment-success.php?oid="+orderID+"&rp_payment_id="+response.razorpay_payment_id+"&rp_signature="+response.razorpay_signature);
                    
                        },
                        "modal": {
                        "ondismiss": function(){
                            window.location.replace("payment-success.php?oid="+orderID);
                        }
                    },
                        "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
                            "name": data.userData.name, //your customer's name
                            "email": data.userData.email,
                            "contact": data.userData.mobile //Provide the customer's phone number for better conversion rates 
                        },
                        "notes": {
                            "address": data.userData.address,
                        },
                        "config": {
                        "display": {
                        "blocks": {
                            "banks": {
                            "name": 'Pay using '+paymentOption,
                            "instruments": [
                            
                                {
                                    "method": paymentOption
                                },
                                ],
                            },
                        },
                        "sequence": ['block.banks'],
                        "preferences": {
                            "show_default_blocks": true,
                        },
                        },
                    },
                        "theme": {
                            "color": "#3399cc"
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.on('payment.failed', function (response){
                    
                        window.location.replace("payment-failed.php?oid="+orderID+"&reason="+response.error.description+"&paymentid="+response.error.metadata.payment_id);
                    
                            });
                        rzp1.open();
                        e.preventDefault(); 
                    }
                    
                });
            });
        });
    </script>
</body>
</html>
<?php  
}else{
     $_SESSION['messages'] = "Session destroy please login again enter your email and password";
     header("Location: https://www.advocatemail.com/member/index.php"); 
     exit();
}
?>
