<?php 
 session_start();
 include_once ("../../db.php"); 
//  print_r($_GET["product_id"]);die;
 $sql = "SELECT * FROM product_mast where product_id = '".$_GET['product_id']."'"; 
 $result = $conn->query($sql); 
 $data = $result->fetch_assoc();
 
 $prod_name = isset($_SESSION['prod_name']) ? $_SESSION['prod_name'] : '';
 unset($_SESSION['prod_name']);
 $prod_nameErr = isset($_SESSION['prod_nameErr']) ? $_SESSION['prod_nameErr'] : '';
 unset($_SESSION['prod_nameErr']);

 $prod_qty = isset($_SESSION['prod_qty']) ? $_SESSION['prod_qty'] : '';
 unset($_SESSION['prod_qty']);
 $prod_qtyErr = isset($_SESSION['prod_qtyErr']) ? $_SESSION['prod_qtyErr'] : '';
 unset($_SESSION['prod_qtyErr']);
 
 $product_id = isset($_SESSION['product_id']) ? $_SESSION['product_id'] : '';
 unset($_SESSION['product_id']);
 
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

<body>
<?php
include('../../layout/header.php');
include('../../layout/nav.php');
?>
<div class="container"> 
 <div class="row">
    <div class="col-sm-6 col-sm-offset-3">
       <span class="danger" style="color:red"><?php echo $errors; ?> </span>
       <span class="success" style="color:blue"><?php echo $messages; ?> </span>
       <div class="panel panel-primary">
        <div class="panel-heading">Member Website Register</div>
          <div class="panel-body">
              <form action="register_website_process.php" method="post">
					<input type="hidden" name="SECURITY_TOKEN" value="89b577bc88" />
					<input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
					<input type="hidden" name="product_id" value="<?php echo $_GET['product_id']; ?>" />
					<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
					<input type="hidden" name="unit_code" value="<?php echo $data['unit_code']; ?>" />
					<div class="form_line"> 
						<label>User name:</label><br>
						<input type="text" name="username" value="<?php echo $_SESSION['name']; ?>" class="form-control" readonly />
					</div>
					<div class="form_line"> 
						<label>Website Name</label>:</label><br>
						<input type="text" name="prod_name" value="<?php echo $prod_name; ?>" class="form-control" />
					    <span style="color:red;"><?php echo $prod_nameErr; ?> </span>
					</div>
					<div class="form_line"> 
						<label>Product Description:</label><br>
						<input type="text" name="prod_desc" class="form-control" value="<?php echo $data['prod_desc']; ?>"  readonly />
					</div>
					<div class="form_line"> 
						<label>Unit Description:</label><br>
						<input type="text" name="unit_desc" class="form-control" value="<?php echo $data['unit_desc']; ?>"  readonly />
					</div>
					<div class="form_line"> 
						<label>Product Rate:</label><br>
						<input type="number" name="prod_rate" id="prod_rate" value="<?php echo $data['prod_rate']; ?>" class="form-control" readonly  />
					</div>
				    <div class="form_line"> 
						<label>Product Quantity:</label><br>
						<input type="number" name="prod_qty" value="<?php echo $prod_qty; ?>" id="quantity" class="form-control" />
						<span style="color:red;"><?php echo $prod_qtyErr; ?> </span>
					</div>
					<div class="form_line"> 
						<label>Product Value:</label><br>
						<input type="number" name="prod_value" id="prod_value" class="form-control" readonly />
					</div><br>
					<div class="form_line" style="text-align:left;"> 
					 <button class="primary" type="submit" name="submit">Submit</button>
					</div>
				</form>
            </div>
            <div class="panel-footer">
            </div>
         </div>
      </div>
 </div>
</div><br>
<?php
include('../../layout/footer.php');
?>
</body>
<script>
   $(document).ready(function() {
        $('#quantity').on('input', function() {
            // Get the product rate and quantity
            var rate = parseFloat($('#prod_rate').val());
            var quantity = parseInt($('#quantity').val());
    
            // Calculate the product value
            if (quantity > 0) {
                var value = rate * quantity;
                $('#prod_value').val(value.toFixed(2)); // Set the product value with 2 decimal places
            } else {
                $('#prod_value').val(''); // Clear the value if quantity is invalid
            }
        });
    });
</script>
</html>
<?php  
}else{
     $_SESSION['messages'] = "Session destroy please login again enter your email and password";
     header("Location: http://localhost/advocom/index.php"); 
     exit();
}
?>
