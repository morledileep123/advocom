<?php 
// Include the database config file 
include_once 'db.php'; 
 
if(!empty($_POST["country_code"])){ 
    // Fetch city data based on the specific state 
    $sql = "SELECT * FROM state_mast WHERE country_code = ".$_POST['country_code'].""; 
    $result = $conn->query($sql); 
     
    // Generate HTML of city options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select state</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['state_code'].'">'.$row['state_name'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">State not available</option>'; 
    } 
} 

if(!empty($_POST["state_code"])){ 
    // Fetch city data based on the specific state 
    $sql = "SELECT * FROM city_mast WHERE state_code = ".$_POST['state_code'].""; 
    $result = $conn->query($sql); 
     
    // Generate HTML of city options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select city</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['city_code'].'">'.$row['city_name'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">City not available</option>'; 
    } 
} 

?>