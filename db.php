<?php 
// Database configuration 
$dbHost     = "localhost"; 
$dbUsername = "root"; 
$dbPassword = ""; 
$dbName     = "advolcom"; 
 
// Create database connection 
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
 
// Check connection 
if ($conn->connect_error) { 
    die("Connection failed: " . $db->connect_error); 
}
?>