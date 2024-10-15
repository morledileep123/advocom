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
<body>

    <?php
    
    include('layout/header.php');
    include('layout/nav.php');
    ?>
    
    <div class="container"> 
      <div class="container text-center">
        <h1> AdvocateMail.com : Services Available</h1>      
      </div>
     <span class="success"><?php echo $messages; ?> </span><br>
     <div class="row">
        <?php 
         if($result->num_rows > 0){ 
         while($row = $result->fetch_assoc()){  
            $product_id = $_SESSION['product_id'] = $row['product_id'];
         ?>
        
          <div class="col-sm-6">
           <div class="panel panel-primary">
            <div class="panel-heading"><?php echo $row['prod_desc']. ' Rate: ' . $row['prod_rate'] . ' / '. $row['unit_desc'] ?></div>
              <div class="panel-body"><?php echo $row['remark'] ?></div>
                
                <div class="panel-footer">
                    <a href="<?php echo $row['register_link'] ?>?product_id=<?php echo $row['product_id']; ?>" target="_blank" class="btn btn-primary">Register</a > 
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
    <?php
    include('layout/footer.php');
    ?>
 </body>
</html>
<?php  
}else{
     $_SESSION['messages'] = "Session destroy please login again enter your email and password";
     header("Location: http://localhost/advocom/index.php"); 
     exit();
}
?>
