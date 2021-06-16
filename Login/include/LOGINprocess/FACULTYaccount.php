<?php
require_once 'Login/include/Connection/DBconnect.php';
if (isset($_POST["LOGIN"]) && $_POST['roles'] == "Faculty_account")
{
    $loginuser = mysqli_real_escape_string($connect, $_POST['User']);
    $loginpass = mysqli_real_escape_string($connect, $_POST['Pass']);

    $sql = "SELECT * FROM adm_FacultyUser WHERE adm_fctusername = '$loginuser'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1)
    {

        $dbusername = $row['adm_fctusername'];
        $dbpassword = $row['adm_fctpassword'];

        //
        if (($dbusername == $loginuser) && ($loginpass == password_verify($loginpass, $dbpassword)))
        {
            $_SESSION['FacultyId'] = $row['adm_fctId'];
            $_SESSION['FacultyName'] = $row['adm_fctfname'] ." " . $row['adm_fctlname'];
            //for correct credential of a users
            echo '<script type="text/javascript">
            swal("' . $row['adm_fctfname'] . '' . " " . '' . $row['adm_fctlname'] . '!", "Welcome back Faculty Member", "success").then(function() {
            window.location = "Faculty/fct_home.php";});
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
        swal("OOPS", "Something went wrong. Please try again later", "error");
        </script>';
    }
   
}

