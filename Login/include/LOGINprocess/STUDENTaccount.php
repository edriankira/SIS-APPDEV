<?php
require_once 'Login/include/Connection/DBconnect.php';
if (isset($_POST["LOGIN"]) && $_POST['roles'] == "Student_account")
{
    $loginuser = mysqli_real_escape_string($connect, $_POST['User']);
    $loginpass = mysqli_real_escape_string($connect, $_POST['Pass']);

    $sql = "SELECT * FROM adm_StudentUser WHERE adm_stdusername = '$loginuser'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1)
    {

        $dbusername = $row['adm_stdusername'];
        $dbpassword = $row['adm_stdpassword'];

        //
        if (($dbusername == $loginuser) && ($loginpass == password_verify($loginpass, $dbpassword)))
        {

            $std_ID = $row["adm_stdId"];
            $std_FNAME = $row["adm_stdfname"];
            $std_USER = $row["adm_stdusername"];
            $std_PASS = $row["adm_stdpassword"];
            
            //for correct credential of a users
            session_start();
            $_SESSION["Fname"] = $std_FNAME;
            $_SESSION["Lname"] = $row["adm_stdlname"];
            $_SESSION["stnID"] = $row["adm_stdUserNum"];
            $_SESSION["stdCourse"] = $row["adm_stdCourse"];

            //for correct credential of a users
            echo '<script type="text/javascript">
            swal("' . $row['adm_stdfname'] . '' . " " . '' . $row['adm_stdlname'] . '!", "Welcome back Student", "success").then(function() {
            window.location = "Student/Homepage.php";});
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
        swal("INVALID!", "Username or Password is incorrect!", "error");
        </script>';
    }
   
}

