<?php
    session_start();
    include_once ('../../db.php'); 

    $sql = "SELECT * FROM product_mast where product_id = '".$_POST['product_id']."'"; 
    $result = $conn->query($sql); 
    $data = $result->fetch_assoc();
    
    $_SESSION['prod_nameErr'] = $_SESSION['prod_qtyErr'] = $_SESSION['prod_passErr'] = "";
    $prod_name = $prod_qty = $prod_pass = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['prod_name'])) {
            $_SESSION['prod_nameErr'] = "product name is required";
        }else{
            $_SESSION['prod_name']  = $prod_name = $_POST["prod_name"];  
        }
        
        if (empty($_POST['prod_qty'])) {
            $_SESSION['prod_qtyErr'] = "product quantity is required";
        }else{
            $_SESSION['prod_qty']  = $prod_qty = $_POST["prod_qty"];  
        }
        
        if (empty($_POST["prod_pass"])) {  
            $_SESSION['prod_passErr'] = "Password is required";  
        } else {  
            $_SESSION['prod_pass'] = $prod_pass = $_POST["prod_pass"];  
        } 
     
        if(isset($_POST['submit'])){
            if($_SESSION['prod_nameErr'] == "" && $_SESSION['prod_qtyErr'] == "" ) {  
    
                $user_id = $_POST['user_id'];
                $product_id = $_POST['product_id'];
                $prod_desc = $_POST['prod_desc'];
                $username = $_POST['username'];
                $prod_pass = $_POST['prod_pass'];
                $prod_name = $_POST['prod_name'];
                $unit_code = $_POST['unit_code'];
                $unit_desc = $_POST['unit_desc'];
                $prod_rate = $_POST['prod_rate'];
                $prod_qty = $_POST['prod_qty'];
                $prod_value =  $_POST['prod_value'];
               
                $prodsql = "INSERT INTO user_services (user_id,prod_id,prod_desc,name,prod_pass,prod_name,unit_code,unit_desc,prod_rate,prod_qty,prod_value) VALUES ('$user_id','$product_id','$prod_desc','$username','$prod_pass','$prod_name','$unit_code','$unit_desc','$prod_rate','$prod_qty','$prod_value')";
                // print_r($conn->query($prodsql));die;
                if ($conn->query($prodsql) == TRUE) {
                     $_SESSION['messages'] = "Member email register is successfully please continue process for payment";
                     header("Location: ../../payment_method/payment.php?product_id=" . $_POST['product_id']); 
                     exit();
            	 }else{
                	 $_SESSION['errors'] = "You are allready registered for email services";
                     header("Location: ../../email/register-email.php?product_id=" . $_POST['product_id']);
                     exit();
            	 }
            	 mysqli_close($conn);
                     
            }else{
              $_SESSION['messages'] = "Please fill all field is mandetory";
              header("Location: ../../register-email.php?product_id=" . $_POST['product_id']);
              exit();
            }
        }
    }

?>