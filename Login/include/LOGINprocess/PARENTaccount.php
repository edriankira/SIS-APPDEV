<?php
require_once 'Login/include/Connection/DBconnect.php';
if (isset($_POST["LOGIN"]) && $_POST['roles'] == "Parent_account")
{
    $loginuser = mysqli_real_escape_string($connect, $_POST['User']);
    $loginpass = mysqli_real_escape_string($connect, $_POST['Pass']);

    $sql = "SELECT * FROM adm_ParentUser WHERE adm_prtusername = '$loginuser'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1)
    {

        $dbusername = $row['adm_prtusername'];
        $dbpassword = $row['adm_prtpassword'];

        //
        if (($dbusername == $loginuser) && ($loginpass == password_verify($loginpass, $dbpassword)))
        {
            $_SESSION['ParentID'] = $row['adm_prtUserNum'];
            $_SESSION['ParentName'] = $row['adm_prtfname'] ." " . $row['adm_prtlname'];

            //for correct credential of a users
            echo '<script type="text/javascript">
            swal("' . $row['adm_prtfname'] . '' . " " . '' . $row['adm_prtlname'] . '!", "Welcome back Parent", "success").then(function() {
            window.location = "parent_mod/index.php";});
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

