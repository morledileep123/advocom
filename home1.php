<?php 
session_start();
include_once 'db.php'; 

 $sql = "SELECT * FROM product_mast order by sort"; 
 $result = $conn->query($sql); 

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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 10px;
      border-radius: 0;
      margin-left:10px;
    }
   
    .error {color: #FF0001;}  
    .success {color: green;}  
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
   
   
   .dropbtn {
      background-color: #222;
      color: #9d9d9d;
      padding: 16px;
      font-size: 16px;
      border: none;
      cursor: pointer;
    }
    
    /* Dropdown button on hover & focus */
    .dropbtn:hover, .dropbtn:focus {
      background-color: #333;
    }
    
    /* The container <div> - needed to position the dropdown content */
    .dropdown {
      position: relative;
      display: inline-block;
    }
    
    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f1f1f1;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }
    
    /* Links inside the dropdown */
    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }
    
    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {background-color: #ddd;}
    
    /* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
    .show {display:block;}
  </style>
</head>
<body>


  <div class="container text-center">
    <h1> AdvocateMail.com : Services Available</h1>      
  </div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><img src="image/logo.png" id="logo" style="width: 209px; margin: -34px; margin-left: 20px;" alt="Logo"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-left">
          
        <li type="hidden"><a href="home.php"><span class="glyphicon"></span></a></li>
        <li class="active"><a href="home.php"><span class="glyphicon"></span>Home</a></li>
        <li><a href="profile.php"><span class="glyphicon"></span>My Profile</a></li>
        <li><a href="services.php"><span class="glyphicon"></span>Register Services</a></li>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <!--<li>-->
        <!--  <div class="dropdown">-->
        <!--      <button onclick="myFunction()" class="dropbtn"><span class="glyphicon glyphicon-user"></span> <?php //if(isset($_SESSION["name"])) { echo $_SESSION["name"]; } ?></button>-->
        <!--      <div id="myDropdown" class="dropdown-content">-->
        <!--        <a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a>-->
        <!--        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>-->
        <!--      </div>-->
        <!--    </div>-->
        <!--</li>-->
        <li><a href="#"><span class="glyphicon glyphicon-user" ></span> &nbsp;<?php if(isset($_SESSION["name"])) { echo $_SESSION["name"]; } ?></a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out" ></span> &nbsp;Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container"> 
<span class="success"><?php echo $messages; ?> </span><br>
 <div class="row">
<?php 
 if($result->num_rows > 0){ 
 while($row = $result->fetch_assoc()){  
 ?>

  <div class="col-sm-6">
   <div class="panel panel-primary">
    <div class="panel-heading"><?php echo $row['prod_desc']. ' Rate: ' . $row['prod_rate'] . ' / '. $row['unit_desc'] ?></div>
      <div class="panel-body"><?php echo $row['remark'] ?></div>
        
        <div class="panel-footer">
            <a href="<?php echo $row['register_link']?>" target="_blank" class="btn btn-primary">Register</a > 
            <a href="<?php echo $row['feature_link']?>" target="_blank" class="btn btn-primary">Read Details</a >
        </div>
     </div>
  </div>
                    
<?php
} 
?>
<br>
<?php
}
?>
 </div>
</div><br>


<footer class="container-fluid text-center">
  <p>AdvocateMail.com</p>   
</footer>

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
</script>
</html>
<?php  
}else{
     $_SESSION['messages'] = "You are not logged in please enter your email and password";
     header("Location: index.php"); 
     exit();
}
?>
