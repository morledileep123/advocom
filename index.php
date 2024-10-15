
<?php 
session_start();
include_once 'db.php'; 

$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
unset($_SESSION['email']);

$emailErr = isset($_SESSION['emailErr']) ? $_SESSION['emailErr'] : '';
unset($_SESSION['emailErr']);

$pass_code = isset($_SESSION['pass_code']) ? $_SESSION['pass_code'] : '';
unset($_SESSION['pass_code']);

$pass_codeErr = isset($_SESSION['pass_codeErr']) ? $_SESSION['pass_codeErr'] : '';
unset($_SESSION['pass_codeErr']);

$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : '';
unset($_SESSION['messages']);

?>

<?php
if(isset($_SESSION['loggedin']) != true){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>
<title>Advocatemail: Mailing Solution Advocates, Profession Dedicated Mailing Solution, advocate promotion, advocate websites developer  </title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="generator" content="v4.6" />

<link rel="stylesheet" type="text/css" href="https://www.advocatemail.com/admincp/css/compress.php?css,admincp/css/layout,admincp/css/dashboard,admincp/css/forms" media="screen"/>

<script type="text/javascript" src="https://www.advocatemail.com/compress.php?js,js/framework/prototype,js/framework/protohover,js/control_tabs,js/framework/scriptaculous,js/framework/builder,js/framework/effects,js/framework/dragdrop,js/framework/controls,js/framework/slider,js/cookies,admincp/js/vivvo">
</script>

<style>
.error {color: #FF0001;}  
.success {color: green;}  

#anckor  {
    font-family: Arial,Helvetica,sans-serif;
    background: #fff url(../../button_blend.png) repeat-x;
    padding: 4px 6px;
    margin: 0;
    color: #444;
    font-weight: bold;
    border: 1px solid #bfbfbf;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    text-shadow: 0 1px 1px rgba(255, 255, 255, 0.8);
    -webkit-box-shadow: 0 1px 0 #fff;
    -moz-box-shadow: 0 1px 1px 0 rgba(255,255,255,1);
    box-shadow: 0 1px 1px 0 rgba(255,255,255,1);
    overflow: visible;
    font-size: 13px;
    text-decoration: none;
}
#anckor:hover {
    background-color: #eee;
    color: #36c;
}
</style>
</head>

<body>

<div id="container">
 <div id="header">
 </div>
 <div id="login_main">
  <div style=" width:350px; text-align:left; margin:0 auto">
<h2 class="login_center">MEMBER LOGIN</h2>
<b class="success"><?php echo $messages; ?> </b>
   <div class="login_box">
    <div id="login_form_holder">
	
<form action="loginprocess.php" method="post">
<input type="hidden" name="SECURITY_TOKEN" value="89b577bc88" />
<input type="hidden" name="action" value="login" />
<input type="hidden" name="cmd" value="login" />

 


     <div class="form_line"> 
<label>Username:</label>
<input type="text" name="email" value="" class="text" />
<b class="error"><?php echo $emailErr; ?> </b>
     </div>

     <div class="form_line"> 
<label>Password:</label>
<input type="password" name="pass_code" value="" class="text" />
<b class="error"><?php echo $pass_codeErr; ?> </b>
     </div>
     
     
     <div class="form_line"> 
      <div class="formElement" style="margin-left:0;">
<label><input type="checkbox" name="LOGIN_remember" value="1" /> Remember me on this computer</label>
      </div>
     </div>

     <div class="form_line" style="text-align:right;"> 
     <button class="primary" type="submit" name="login">Login</button>
     <a id="anckor" href="signup.php">Register</a>
     </div>

</form>

     <div class="separator_gray"><!-- -->
     </div>
     
<!--     <div class="login_center">  -->
     <div>  
     <a href="https://Advocatemail.com" target="_blank">Advocatemail.com</a> - <a href="" target="_blank">Services Of Scorpio Informatics</a>
<!--<a href="signup.php" onclick="">New Member To Register click here</a>-->
     </div>

    <!--</div>-->
   </div>
   <div class="corner_bottom_left">
    <div class="corner_bottom_right"><!-- -->
    </div>
   </div>
  </div>
 </div>

 <div id="footer" style="text-align:center;">
<!--<a href="https://Advocatemail.com" target="_blank">Advocatemail.com</a> - <a href="" target="_blank">Services Of Scorpio Informatics</a>-->
 </div>

</div>
	</body>
</html>
<?php
}else{
    $_SESSION['messages'] = "If you want to logout please click the login button";
    header('location: http://localhost/advocom/home.php');
    exit();
}
?>