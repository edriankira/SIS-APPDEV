<?php
// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
unset($_SESSION['AdminName']);  
session_destroy();
 
// Redirect to login page
header("location: /SIS-APPDEV(Development)/login.php");
exit();
?>
