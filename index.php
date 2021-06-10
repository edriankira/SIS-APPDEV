<?php
if(!isset($_SESSION['AdminName']) && !isset($_SESSION['AdminId'])){
    header("location:homepage.php");
}
else if(!isset($_SESSION['stnID'])){
    header("location:#.php");
}
else{
    header("location:login.php");
}

?>