<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include 'db.php';
  
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["submit"])) {
            $name = $_POST["name"];
            $email = $_SESSION['email'];
            $mobile = $_POST["mobile"];
            $country_code = $_POST["country_name"];
            $country = "SELECT * FROM country_mast WHERE country_code='".$country_code."'";
            $result = $conn->query($country);
            $row = $result->fetch_assoc();
            $country_name = $row['country_name'];
            
            
            $state_code = $_POST['state_name'];
            $state = "SELECT * FROM state_mast WHERE state_code='".$state_code."'";
            $result1 = $conn->query($state);
            $row1 = $result1->fetch_assoc();
            $state_name = $row1['state_name'];
            
            $city_code = $_POST["city_name"];
            $city = "SELECT * FROM city_mast WHERE city_code='".$city_code."'";
            $result2 = $conn->query($city);
            $row2 = $result2->fetch_assoc();
            $city_name = $row2['city_name'];
          
            $zip = $_POST["zip"];
            $address = $_POST["address"];
            $remark = $_POST["remark"];
            $sql = "UPDATE users SET name='$name', mobile='$mobile', country_code='$country_code', country_name='$country_name', state_code='$state_code', state_name='$state_name', city_code='$city_code', city_name='$city_name', zip='$zip', address='$address', remark='$remark' WHERE email='$email'";
            // print_r($conn->query($sql));die;
            if ($conn->query($sql) === TRUE) {
                $_SESSION['messages'] = "User details updated successfully";
                header('location: home.php');
                exit(); 
            } else {
               $_SESSION['messages'] = "Something went wrong user details not updated successfully";
               header('location: home.php');
               exit();
            }
            $conn->close();
            
        }
    }
?>