<?php 
include_once 'db.php'; 

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

$mobile = isset($_SESSION['mobile']) ? $_SESSION['mobile'] : '';
unset($_SESSION['mobile']);
$mobileErr = isset($_SESSION['mobileErr']) ? $_SESSION['mobileErr'] : '';
unset($_SESSION['mobileErr']);

$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : '';
unset($_SESSION['messages']);


$sql = "SELECT * FROM user_type_mast WHERE status = 1"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <title>Member Register Advocate Mail</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/minstyle.css">
    
    <link rel="shortcut icon" href="image/logo.png">
     <style>
         .error {color: #FF0001;}  
        .success {color: green;}  
        /*p{*/
        /*    margin-top: -13px;*/
        /*    margin-bottom: 16px;*/
        /*    margin-left: 9px;*/
        /*    text-align: left*/
        /*}*/
        #login {
          margin: 20px auto;
          width: 320px;
        }
        
        lable {
          color: black;
          font-size: 20px;
          line-height: 1.5em;
          padding: 0;
        }
        #login form input[type="submit"] {
          background: #b5cd60;
          border: 0;
          width: 323px;
          height: 40px;
          border-radius: 3px;
          color: white;
          cursor: pointer;
          transition: background 0.3s ease-in-out;
        }
    
    input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        
         select {
            font-size: 16px;
            background-color: #fff;
            color: #333;
            appearance: none;
            background-size: 12px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="login">
        <img src="image/logo.png" id="logo" alt="Logo">
        <span class="success"><?php echo $messages; ?> </span><br>
        <form name='form-login' method="POST" action="register.php">
            <div class="form-group">
                <lable>User Type Name</lable><br>
                <select name="user_type">
                    <option value="">Select User Type</option>
                     <?php 
                      if($result->num_rows > 0){ 
                          while($row = $result->fetch_assoc()){  
                              ?>
                             <option value="<?php echo $row['user_type'] ?>"><?php echo $row['user_type_desc'] ?></option>
                             <?php
                          } 
                      }
                      ?>
                </select>
            </div>
             <p class="error"></p>
            <div class="form-group">
                 <lable>User Name</lable><br>
                <input type="text" name="name" id="name" placeholder="Enter User Name">
            </div>
            <p class="error"><?php echo $nameErr; ?></p>
            <div class="form-group">
                <lable>Email Address</lable><br>
                <input type="text" name="email" id="email" placeholder="Enter Email Address">
            </div>
            <p class="error"><?php echo $emailErr; ?> </p>
            <div class="form-group">
                 <lable>Password</lable><br>
                <input type="password" name="pass_code" id="pass" placeholder="Enter Password">
            </div>
            <p class="error"><?php echo $pass_codeErr; ?> </p>
            <div class="form-group">
                 <lable>Mobile Number</lable><br>
                <input type="text" name="mobile" id="mobile" placeholder="Enter Mobile Number">
            </div>
            <p class="error"><?php echo $mobileErr; ?> </p>
            <div class="form-group">
                <input type="submit" name="submit" value="Register">
            </div><br>
            <a href="login.php" style="color:blue; margin-left: 37px;">Already have an account? Click here</a>
        </form>
    </div>
</body>
</html>