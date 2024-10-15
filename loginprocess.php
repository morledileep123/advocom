<?php
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include 'db.php';

    $_SESSION['emailErr'] = $_SESSION['pass_codeErr'] = "";
    $email = $pass_code = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
          
          if (empty($_POST["email"])) {  
            $_SESSION['emailErr'] = "Email is required";  
          } else {  
            $_SESSION['email']  = $email = $_POST["email"];  
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $_SESSION['emailErr'] = "Invalid email format";
            } 
          } 
          
          if (empty($_POST["pass_code"])) {  
            $_SESSION['pass_codeErr'] = "Password is required";  
          } else {  
            $_SESSION['pass_code'] = $pass_code = $_POST["pass_code"];  
            
          } 
          
          
           
        }
        
        if (isset($_POST["login"])) {
          if($_SESSION['emailErr'] == "" && $_SESSION['pass_codeErr'] == "") {  
            $email = $_POST["email"]; 
            $password = md5($pass_code);
            $sql= "SELECT * FROM users where email='".$email."'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            // print_r($row['pass_code'].'<br>');
            // print_r($password);die;
            
             if(is_array($row) && $row['pass_code'] == $password)
            {
                if($row['status'] == 1){
                    $_SESSION['messages'] = "You are not varified your email Please varifiy email first";
                    header("Location: index.php"); 
                    exit();
                }else{
                    $_SESSION["user_id"] = $row['user_id'];
                    $_SESSION["email"]=$row['email'];
                    $_SESSION["name"]=$row['name'];
                    $_SESSION["mobile"]=$row['mobile']; 
                    $_SESSION["country"]=$row['country_name']; 
                    $_SESSION["state"]=$row['state_name']; 
                    $_SESSION["city"]=$row['city_name']; 
                    $_SESSION["zip"]=$row['zip']; 
                    $_SESSION["address"]=$row['address']; 
                    $_SESSION['loggedin'] = true;
                    $_SESSION['messages'] = "You are logged successfully please purchase your product";
                    header("Location: home.php"); 
                    exit();
                }
            }
            else
            {
                $_SESSION['messages'] = "Invalid email address and password";
                header("Location: index.php"); 
                exit();
            }
            $conn->close();
          }else {
              // If the form wasn't submitted, redirect or show an error
              $_SESSION['messages'] = "Email and Password is required";
              header('location: index.php');
              exit();
            }
         }
    
?>