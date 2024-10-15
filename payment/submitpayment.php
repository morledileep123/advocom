<?php
include_once ('../db.php'); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:POST,GET,PUT,PATCH,DELETE');
header("Content-Type: application/json");
header("Accept: application/json");
header('Access-Control-Allow-Headers:Access-Control-Allow-Origin,Access-Control-Allow-Methods,Content-Type');
 
if(isset($_POST['action']) && $_POST['action']='payOrder'){
 
  $razorpay_mode='test';
  
  $razorpay_test_key='rzp_live_9DlbeIcH33sffr'; //Your Test Key
  $razorpay_test_secret_key='0C8XusBeGG2tgf4ELJdvd1WZ'; //Your Test Secret Key
  
  $razorpay_live_key= 'rzp_live_9DlbeIcH33sffr';
  $razorpay_live_secret_key='0C8XusBeGG2tgf4ELJdvd1WZ';
  
  if($razorpay_mode=='test'){
      
      $razorpay_key=$razorpay_test_key;
      $authAPIkey="Basic ".base64_encode($razorpay_test_key.":".$razorpay_test_secret_key);
  
  }else{
      
    $authAPIkey="Basic ".base64_encode($razorpay_live_key.":".$razorpay_live_secret_key);
    $razorpay_key=$razorpay_live_key;
  
  }
  
  // Set transaction details
  $order_id = uniqid(); 
  
  $billing_name=$_POST['billing_name'];
  $billing_mobile=$_POST['billing_mobile'];
  $billing_email=$_POST['billing_email'];
  $billing_address=$_POST['billing_address'];
  $website=$_POST['website'];
  $prod_desc=$_POST['prod_desc'];
  $quantity=$_POST['quantity'];

  $shipping_name=$_POST['shipping_name'];
  $shipping_mobile=$_POST['shipping_mobile'];
  $shipping_email=$_POST['shipping_email'];
  $paymentOption=$_POST['paymentOption'];
  $payAmount= 1;
  $currency="INR";
  $status = "Pending";
  $txnsDate = date('Y-m-d H:i:s');
  
  $note="Payment of amount Rs. ".$payAmount;
  
  $postdata=array(
    "amount"=>$payAmount*100,
    "currency"=> "INR",
    "receipt"=> $note,
    "notes" =>array(
      "notes_key_1"=> $note,
      "notes_key_2"=> ""
    )
  );
  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.razorpay.com/v1/orders',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>json_encode($postdata),
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
      'Authorization: '.$authAPIkey
    ),
  ));
  
  $response = curl_exec($curl);
  
  curl_close($curl);
  $orderRes= json_decode($response);
  if(isset($orderRes->id)){
  
    $rpay_order_id=$orderRes->id;
    
    $dataArr=array(
      'amount'=>$payAmount,
      'description'=>"Pay bill of Rs. ".$payAmount,
      'rpay_order_id'=>$rpay_order_id,
      'name'=>$billing_name,
      'email'=>$billing_email,
      'mobile'=>$billing_mobile,
      'address'=>$billing_address,
      'website'=>$website,
      'prod_desc'=>$prod_desc,
      'quantity'=>$quantity,
    );

    $sqlQueryPay = "INSERT INTO payment_transaction (order_id, full_name, email, mobile, address, website, prod_desc, prod_qty, amount, status, currency, txns_date) VALUES ('$order_id', '$billing_name', '$billing_email', '$billing_mobile', '$billing_address', '$website', '$prod_desc', '$quantity', '$payAmount', '$status', '$currency', '$txnsDate')";
    $conn->query($sqlQueryPay);
    echo json_encode(['res'=>'success','order_number'=>$order_id,'userData'=>$dataArr,'razorpay_key'=>$razorpay_key]); 
    exit;
    }else{
      echo json_encode(['res'=>'error','order_id'=>$order_id,'info'=>'Error with payment']); exit;
    }
    }else{
        echo json_encode(['res'=>'error']); exit;
    }
?>