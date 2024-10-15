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

$captcha_code = isset($_SESSION['captcha_code']) ? $_SESSION['captcha_code'] : '';
unset($_SESSION['captcha_code']);
$captcha_codeErr = isset($_SESSION['captcha_codeErr']) ? $_SESSION['captcha_codeErr'] : '';
unset($_SESSION['captcha_codeErr']);

$mobile = isset($_SESSION['mobile']) ? $_SESSION['mobile'] : '';
unset($_SESSION['mobile']);
$mobileErr = isset($_SESSION['mobileErr']) ? $_SESSION['mobileErr'] : '';
unset($_SESSION['mobileErr']);

$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : '';
unset($_SESSION['messages']);


$sql = "SELECT * FROM user_type_mast WHERE status = 1"; 
$result = $conn->query($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title>Advocatemail: Mailing Solution Advocates, Profession Dedicated Mailing Solution, advocate promotion, advocate websites developer  Control Panel</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="generator" content="v4.6" />
		<link rel="stylesheet" type="text/css" href="https://www.advocatemail.com/admincp/css/compress.php?css,admincp/css/layout,admincp/css/dashboard,admincp/css/forms" media="screen"/>

		<script type="text/javascript" src="https://www.advocatemail.com/compress.php?js,js/framework/prototype,js/framework/protohover,js/control_tabs,js/framework/scriptaculous,js/framework/builder,js/framework/effects,js/framework/dragdrop,js/framework/controls,js/framework/slider,js/cookies,admincp/js/vivvo"></script>
        
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <style>
             .error {color: #FF0001;}  
             .success {color: green;}  
            
            input {
                padding:3px;
            }
       
           select {
                color: #333;
                border: 1px solid #a7acb2;
                -moz-border-radius: 3px;
                -webkit-border-radius: 3px;
                border-radius: 3px;
                padding: 3px;
                background-color: white
            }

            .btnRefresh {
            color: #444;
            font-size: 30px;
            margin-left: 13px;
            margin-top: 5px;
            }
            
            #captcha{
            background:white;
            }
           .rotate {
                animation: spin 0.5s linear infinite;
            }
        
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
            
            #anckor  {
                font-family: Arial,Helvetica,sans-serif;
                background: #fff url(https://www.advocatemail.com/member/image/button_blend.png) repeat-x;
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
				<h2 class="login_center">MEMBER REGISTER</h2>
			    <b class="success"><?php echo $messages; ?> </b>
				<div class="login_box">
					<div id="login_form_holder">
						<form action="register.php" method="post">
							<input type="hidden" name="SECURITY_TOKEN" value="89b577bc88" />
							<input type="hidden" name="action" value="login" />
							<input type="hidden" name="cmd" value="login" />
							<div class="form_line"> 
								<label>User Type:</label>
								<select name="user_type" style="width:318px;" class="text">
									<option value="english">select</option>
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
							   <span class="error"></span>
							</div>
							<div class="form_line"> 
								<label>Username:</label>
								<input type="text" name="name" value="" class="text" />
							    <span class="error"><?php echo $emailErr; ?> </span>
							</div>
							<div class="form_line"> 
								<label>Email:</label>
								<input type="text" name="email" value="" class="text" />
							    <span class="error"><?php echo $emailErr; ?> </span>
							</div>
							<div class="form_line"> 
								<label>Password:</label>
								<input type="password" name="pass_code" value="" class="text" />
							    <span class="error"><?php echo $pass_codeErr; ?> </span>
							</div>
							<div class="form_line"> 
								<label>Mobile Number:</label>
								<input type="text" name="mobile" value="" class="text" />
							    <span class="error"><?php echo $mobileErr; ?> </span>
							</div>
							<div class="form_line"> 
								<label>Choose language:</label>
								<select name="admin_lang" style="width:318px;">
									<option value="english">English</option>
								</select>
							</div>
							<div class="form_line"> 
								<div class="login_center">
                                    Please Enter the Captcha Text                                     
                                    <span id="captcha-info" class="info"></span><br/>
                                    <input type="text" name="captcha_challenge"><br>
                                     <span class="error"><?php echo $captcha_codeErr; ?> </span><br>
                                    <img id="captcha_code" src="captcha.php">
                                    <i id="refresh-icon" class="fas fa-sync btnRefresh"></i>
								</div>
							</div>
							<div class="form_line" style="text-align:right;"> 
							 <button class="primary" type="submit" name="submit">Register</button>
							</div>
						</form>
						<div class="separator_gray"><!-- --></div>
						<div class="login_center"> 
							<a href="index.php" onclick="">Already have an account? Click here</a>
						</div>
					</div>
					
				</div>
				<div class="corner_bottom_left"><div class="corner_bottom_right"><!-- --></div></div>
				</div>
			</div>
			<div id="footer" style="text-align:center;">
				<a href="https://Advocatemail.com" target="_blank">Advocatemail.com</a> - <a href="" target="_blank">Services Of Scorpio Informatics</a>
			</div>
		</div>
	</body>
	<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
	    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#refresh-icon').on('click', function() {
                $('#refresh-icon').addClass('rotate');

                // Simulate a refresh action
                setTimeout(function() {
                    $('#refresh-icon').removeClass('rotate');
                    // Place your refresh logic here (e.g., AJAX call)
                }, 500); // Duration of the rotation effect
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Refresh CAPTCHA when the icon is clicked
            $('.btnRefresh').on('click', function() {
               $("#captcha_code").attr('src','captcha.php');
            });
        });
           
            
        if(!$("#captcha").val()) {
            $("#captcha-info").html("(required)");
            $("#captcha").css('background-color','#FFFFDF');
            valid = false;
        }
    </script>
</html>
