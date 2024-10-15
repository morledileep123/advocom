<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include 'db.php';
    $_SESSION['nameErr'] = $_SESSION['emailErr'] = $_SESSION['pass_codeErr'] =  $_SESSION['mobileErr'] = "";
    $name = $email = $pass_code  =  $mobile = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if (empty($_POST['name'])) {
            $_SESSION['nameErr'] = "user name is required";
          }else{
            $_SESSION['name']  = $name = $_POST["name"];  
            // check if name only contains letters and whitespace  
            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {  
                $_SESSION['nameErr'] = "Only alphabets and white space are allowed";  
            }  
          }
        
          if (empty($_POST["email"])) {  
            $_SESSION['emailErr'] = "Email is required";  
          } else {  
            $_SESSION['email']  = $email = $_POST["email"];  
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $_SESSION['emailErr'] = "Invalid email format";
            } else {
              $sqlema = "SELECT * FROM users WHERE email ='".$email."'";
              $resultema = $conn->query($sqlema);
              $rowema = $resultema->fetch_assoc();
              $checkema = $rowema['email'];
              // Check for unique email
              if ($checkema == $email) {
                  $_SESSION['emailErr'] = "Email is already registered";
              }
            }
          } 
          
          if (empty($_POST["pass_code"])) {  
            $_SESSION['pass_codeErr'] = "Password is required";  
          } else {  
            $_SESSION['pass_code'] = $pass_code = $_POST["pass_code"];  
            
          } 
          
          if (empty($_POST["captcha_code"])) {  
            $_SESSION['captcha_codeErr'] = "Captcha code is required";  
          } else {  
            $_SESSION['captcha_code'] = $captcha_code = $_POST["captcha_codeErr"];  
            
          } 
          
          if (empty($_POST["mobile"])) {  
            $_SESSION['mobileErr'] = "Mobile no is required";  
          } else {  
            $_SESSION['mobile'] = $mobile = $_POST["mobile"];  
            // check if mobile no is well-formed  
            if (!preg_match ("/^[0-9]*$/", $mobile) ) {  
             $_SESSION['mobileErr'] = "Only numeric value is allowed.";  
            }  
            //check mobile no length should not be less and greator than 10  
            if (strlen ($mobile) != 10) {  
             $_SESSION['mobileErr'] = "Mobile no must contain 10 digits.";  
            }  
           
        }
        
        if (isset($_POST["submit"])) {
          if($_SESSION['nameErr'] == "" && $_SESSION['emailErr'] == "" && $_SESSION['pass_codeErr'] == "" && $_SESSION['mobileErr'] == "") {  
            $userType = $_POST["user_type"]; 
            $password = md5($_POST['pass_code']);
            $status = 1;
            $to = $email;
            $subject = "Email Verification";
            $activationcode=md5($email.time());
            $verification_link = "https://www.advocatemail.com/member/email_verification.php?code=$activationcode";
            $captchaUser = $_POST['captcha_challenge'];
            if($captchaUser == $_SESSION["captcha_code"]){
                $sql = "INSERT INTO users (user_type, name, email, pass_code, mobile, activationcode, status)
                VALUES ('$userType', '$name', '$email', '$password', '$mobile', '$activationcode', $status)";
              
                if ($conn->query($sql) == TRUE) {
                    try {
                       
                        $message = "
                        <html>
                        <head>
                          <title>Email Verification</title>
                        </head>
                        <body>
                          <h3>Dear <b>$name</b>,</h3>
                          <p style='margin-left:25px;'>Thank you for registering. Advocate maiil as a member. Please click the link below to verify your email address:<br>
                          <a href='" . $verification_link . "'>Verify Your Email</a>
                          </p>
                          <p>Thanks & Regards<br>
                           advocatemail.com
                          </p>
                         
                        </body>
                        </html>
                        ";
                        
                        // To send an HTML email, set the Content-type header
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        
                        // More headers
                        $headers .= 'From: laxyosolution@gmail.com' . "\r\n";
                        mail($to, $subject, $message, $headers);
                        $_SESSION['messages'] = "You are register successfully please varify your email";
                        header('location: index.php');
                        exit();
                     } catch (Exception $e) {
                        $_SESSION['messages'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        header('location: index.php');
                        exit();
                          
                     }
                 
                } else {
                  $_SESSION['messages'] = "Error: " . $sql . "<br>" . $conn->error;
                }
                $conn->close();
            }else {
              // If the form wasn't submitted, redirect or show an error
              $_SESSION['messages'] = "captcha code is not match";
              header('location: signup.php');
              exit();
            }
          }else {
              // If the form wasn't submitted, redirect or show an error
              echo "Fill all field prperly.";
              header('location: signup.php');
              exit();
            }
         }
    }
?>