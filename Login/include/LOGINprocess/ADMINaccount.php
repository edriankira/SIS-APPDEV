<?php
require_once 'Login/include/Connection/DBconnect.php';
if (isset($_POST["LOGIN"]) && $_POST['roles'] == "Admin_account")
{
    $loginuser = mysqli_real_escape_string($connect, $_POST['User']);
    $loginpass = mysqli_real_escape_string($connect, $_POST['Pass']);

    $sql = "SELECT * FROM adm_AdminUser WHERE adm_username = '$loginuser'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1)
    {

        $dbusername = $row['adm_username'];
        $dbpassword = $row['adm_password'];

        //
        if (($dbusername == $loginuser) && ($loginpass == password_verify($loginpass, $dbpassword)))
        {
            //for correct credential of a users
            echo '<script type="text/javascript">
            swal("' . $row['adm_fname'] . '' . " " . '' . $row['adm_lname'] . '!", "Welcome back Admin", "success").then(function() {
            window.location = "homepage.php";});
            </script>';
            exit();
        }
        else
        {
            //for invalid credential of a users
            echo '<script type="text/javascript">
            swal("INVALID!", "Username or Password is incorrect!", "error");
          </script>';
        }
    }
    else
    {
        //for bad query
        echo '<script type="text/javascript">
        swal("OOPS!", "Something went wrong. Please try again later", "error");
        </script>';
    }
}

