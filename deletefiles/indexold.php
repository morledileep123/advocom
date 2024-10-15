<?php 
session_start();

$name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
unset($_SESSION['name']);
$nameErr = isset($_SESSION['nameErr']) ? $_SESSION['nameErr'] : '';
unset($_SESSION['nameErr']);

$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
unset($_SESSION['email']);
$emailErr = isset($_SESSION['emailErr']) ? $_SESSION['emailErr'] : '';
unset($_SESSION['emailErr']);

$pass_code = isset($_SESSION['pass_code']) ? $_SESSION['pass_code'] : '';
unset($_SESSION['pass_code']);
$pass_codeErr = isset($_SESSION['pass_codeErr']) ? $_SESSION['pass_codeErr'] : '';
unset($_SESSION['pass_codeErr']);

$remark = isset($_SESSION['remark']) ? $_SESSION['remark'] : '';
unset($_SESSION['remark']);

$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : '';
unset($_SESSION['messages']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>AdvocateMail.com Member Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    .itrcu{
        /* margin-top: 50px;
        margin-bottom: 50px; */
        margin:50px;
        border: 2px solid green;
    }
    .error {color: #FF0001;}  
    .success {color: green;}  
  </style>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="itrcu col-md-12">
     <h2 style="text-align:center;">AdvocateMail Member Registration</h2>
      <div class="col-md-7">
      <img src="image/edu.webp" alt="AdvocateMail.com Registration" height="914px" width="100%">
      </div>
      <div class="col-md-5">
          
        <span class="success"><?php echo $messages; ?> </span><br>

        <form action="register.php" method="post">

          <div class="form-group">
            <label for="name">User Name:</label>
            <input type="name" class="form-control" id="name" value="<?php echo $name; ?>" placeholder="Enter your name" name="name">
            <span class="error">* <?php echo $nameErr; ?> </span><br>
          </div>

          <div class="form-group">
            <label for="email">User Email:</label>
            <input type="email" class="form-control" value="<?php echo $email; ?>" id="email" placeholder="Enter email address" name="email">
            <span class="error">* <?php echo $emailErr; ?> </span><br>
          </div>

          <div class="form-group">
              <label for="mobile">Password:</label>
              <input type="password" class="form-control" value="<?php echo $pass_code; ?>" id="pass_code" placeholder="Enter password" name="pass_code">
              <span class="error">* <?php echo $pass_codeErr; ?> </span><br>
          </div>

          <div class="form-group">
              <label for="state_name">State Name:</label>
     
                <?php 
                  // Include the database config file 
                  include_once 'db.php'; 
                  
                  // Fetch all the country data 
                  $sql = "SELECT * FROM state_mast"; 
                  $result = $conn->query($sql); 

                ?>


              <!-- Country dropdown -->
              <select id="state" name="state_name" class="form-control">
                  <option value="">Select State</option>
                  <?php 
                  if($result->num_rows > 0){ 
                      while($row = $result->fetch_assoc()){  
                          echo '<option value="'.$row['state_code'].'">'.$row['state_name'].'</option>'; 
                      } 
                  }else{ 
                      echo '<option value="">state not available</option>'; 
                  } 
                  ?>
              </select>
            </div>

            <div class="form-group">
              <label for="city_name">City Name:</label>
              <select id="city" name="city_name" class="form-control">
                  <option value="">Select state first</option>
              </select>
            </div>
            <div class="form-group">
                <label for="remark">Remark:</label>
                <textarea cols="4" rows="12" class="form-control" name="remark" id="remark" placeholder="Enter email"><?php echo $remark; ?></textarea>
                <span class="error"></span><br>
            </div>
            
            <div class="form-group">
                <input name="submit" type="submit" class="btn btn-primary btn-xl">
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

</body>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> 
<script>
$(document).ready(function(){

  $('#state').on('change', function(){
    var stateID = $(this).val();
    if(stateID){
        $.ajax({
          type:'POST',
          url:'ajaxData.php',
          data:'state_code='+stateID,
          success:function(html){
            $('#city').html(html);
          }
        }); 
    }else{
      $('#city').html('<option value="">Select state first</option>'); 
    }
  });
});
</script>

</html>
