<?php
session_start();
session_destroy();
$session['messages'] = "You are loggedout successfully";
header("Location: index.php"); 
exit();

?>