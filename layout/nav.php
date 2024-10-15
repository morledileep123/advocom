<?php 

include("baseurl.php");
?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><img src="http://localhost/advocom/image/logo.png" id="logo" style="width: 209px; margin: -34px; margin-left: 20px;" alt="Logo"></a>
    </div>
    
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-left">
          
        <li type="hidden"><a href="#"><span class="glyphicon"></span></a></li>
        <li class="active"><a href="http://localhost/advocom/home.php"><span class="glyphicon"></span>Home</a></li>
        <!--<li><a href="profile.php"><span class="glyphicon"></span>My Profile</a></li>-->
        <li><a href="http://localhost/advocom/services.php"><span class="glyphicon"></span>Register Services</a></li>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <!--<li>-->
        <!--  <div class="dropdown">-->
        <!--      <button onclick="myFunction()" class="dropbtn"><span class="glyphicon glyphicon-user"></span> <?php //if(isset($_SESSION["name"])) { echo $_SESSION["name"]; } ?></button>-->
        <!--      <div id="myDropdown" class="dropdown-content">-->
        <!--        <a href="#"><span class="glyphicon glyphicon-user"></span> Profile</a>-->
        <!--        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>-->
        <!--      </div>-->
        <!--    </div>-->
        <!--</li>-->
        <li><a href="#"><span class="glyphicon glyphicon-user" ></span> &nbsp;<?php if(isset($_SESSION["name"])) { echo $_SESSION["name"]; } ?></a></li>
        <li><a href="http://localhost/advocom/logout.php"><span class="glyphicon glyphicon-log-out" ></span> &nbsp;Logout</a></li>
      </ul>
    </div>
  </div>
</nav>