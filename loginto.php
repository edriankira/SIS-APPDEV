<?php
    if($_POST['roles'] == "Admin account"){
        include "Login/include/LOGINprocess/ADMINaccount.php";
    }else if($_POST['roles'] == "Student account"){
        include "Login/include/LOGINprocess/StUDENTaccount.php";
    }

?>