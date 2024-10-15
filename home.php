<?php 
session_start();
include_once 'db.php'; 
 $sql = "SELECT * FROM product_mast order by sort"; 
 $result = $conn->query($sql); 

 $userDetails= "SELECT * FROM users where `user_id` = '" . $_SESSION['user_id'] . "'"; 
 $userData = $conn->query($userDetails); 
 $data = $userData->fetch_assoc();
 
 $country  = "SELECT * FROM country_mast";
 $resultCountry = $conn->query($country);
 
 
// $loggedin = isset($_SESSION['loggedin']) ? $_SESSION['loggedin'] : '';
// unset($_SESSION['loggedin']);

$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : '';
unset($_SESSION['messages']);
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
include('layout/header.php');
include('layout/nav.php');
?>
<div class="container"> 
<span class="success" style="margin-left: 16px;"><?php echo $messages; ?> </span><br>
 <div class="row">
    <div class="col-md-12">
        <div class="col-sm-6">
           <div class="panel panel-primary">
            <div class="panel-heading">User Profile Card</div>
            <div class="col-md-4">
                 <div class="panel-body">
                <div class="panel-body"><img src="<?php echo base_url() ?>/image/advocate.png" alt="John" style="width:146px; height:234px; border: 1px solid black;"></div>
               
                </div>
            </div>
            <div class="col-md-8">
              <div class="panel-body" style="margin-top:12px;">
                <b>Name :</b> <?php echo $data['name']; ?><br>
                <b>Email :</b> <?php echo $data['email']; ?><br>
                <b>Mobile Number :</b> <?php echo $data['mobile']; ?><br>
                <b>Country Name :</b> <?php echo $data['country_name']; ?><br>
                <b>State Name :</b> <?php echo $data['state_name']; ?><br>
                <b>City Name :</b> <?php echo $data['city_name']; ?><br>
                <b>Zip Code :</b> <?php echo $data['zip']; ?><br>
                <b>Address :</b> <?php echo $data['address']; ?><br>
                <b>Remark :</b> <?php echo $data['remark']; ?><br>
              </div>
                <div class="panel-footer">
                </div>
            </div>
         </div>
           
      </div>
      <div class="col-sm-6">
       <div class="panel panel-primary">
        <div class="panel-heading">User Profile Edit</div>
          <div class="panel-body">
              <form action="user_edit.php" method="post">
					<input type="hidden" name="SECURITY_TOKEN" value="89b577bc88" />
					<div class="form_line"> 
						<label>Username:</label><br>
						<input type="text" name="name" value="<?php echo $data['name']; ?>" class="form-control" />
					</div>
					<div class="form_line"> 
						<label>Mobile Number:</label><br>
						<input type="text" name="mobile" value="<?php echo $data['mobile']; ?>" class="form-control" />
					</div>
					<div class="form_line"> 
						<label>Country:</label><br>  
						 <select name="country_name" class="form-control" id="country">
    				     <option value="">Select Country</option>
    				     <?php while ($row=mysqli_fetch_array($resultCountry)) { ?>
    				     <option value="<?php echo $row['country_code']; ?>" <?php if(isset($data['country_code']) && $data['country_code'] == $row['country_code']) {  echo 'selected'; } ?>>
    				         <?php echo $row['country_name']; ?>
    				    </option>
    				     <?php } ?>
    				    </select>
					</div>
					<div class="form_line"> 
						<label>State:</label><br>
						<select name="state_name" class="form-control" id="state">
    				      <option>Select State</option>
    			        </select>
					</div>
					<div class="form_line"> 
						<label>City:</label><br>
						 <select name="city_name" class="form-control" id="city">
    				      <option>Select City</option>
    			        </select>
					</div>
					<div class="form_line"> 
						<label>Zip Code:</label><br>
						<input type="number" name="zip" value="<?php echo $data['zip']; ?>" class="form-control" />
					</div>
					<div class="form_line"> 
						<label>Addresss:</label><br>
						<textarea name="address" class="form-control" /><?php echo $data['address']; ?></textarea>
					</div>
					<div class="form_line"> 
						<label>Remark:</label><br>
						<textarea name="remark" class="form-control" /><?php echo $data['remark']; ?></textarea><br><br>
					</div>
					<div class="form_line" style="text-align:left;"> 
					 <button class="primary" type="submit" name="submit">Update</button>
					</div>
				</form>
            </div>
            <div class="panel-footer">
            </div>
         </div>
      </div>
    </div>
 </div>
</div><br>
<?php
include('layout/footer.php');
?>
</body>
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

$('#country').on('change', function(){
    var countryID = $(this).val();
    if(countryID){
        $.ajax({
          type:'POST',
          url:'http://localhost/advocom/ajaxData.php',
          data:'country_code='+countryID,
          success:function(html){
            $('#state').html(html);
          }
        }); 
    }else{
      $('#state').html('<option value="">Select country first</option>'); 
    }
  });
  
  $('#state').on('change', function(){
    var stateID = $(this).val();
    if(stateID){
        $.ajax({
          type:'POST',
          url:'http://localhost/advocom/ajaxData.php',
          data:'state_code='+stateID,
          success:function(html){
            $('#city').html(html);
          }
        }); 
    }else{
      $('#city').html('<option value="">Select state first</option>'); 
    }
  });
</script>
</html>
<?php  
}else{
  $_SESSION['user_id'] =$data['user_id'];
  $_SESSION['messages'] = "Session destroy please login again enter your email and password";
  header("Location: http://localhost/advocom/index.php"); 
  exit();
}
?>
