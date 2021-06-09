<?php
if(!isset($_SESSION['AdminName']) && !isset($_SESSION['AdminId'])){
    header("location:homepage.php");
}else{
    header("location:login.php");
}

?>