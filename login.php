<?php

require_once "connection/config.php";

$error ="";

if(isset($_POST["login"])){
    $loginuser = mysqli_real_escape_string($db,$_POST['log_username']);
    $loginpass = mysqli_real_escape_string($db,$_POST['log_password']);

    $sql = "SELECT * FROM adm_AdminUser WHERE adm_username = '$loginuser'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
      
    if($count == 1) {
         //session_register("myusername"); depricated/removed from passed ver

         $dbusername = $row['adm_username'];
         $dbpassword = $row['adm_password'];

         //
         if ($dbusername == $loginuser && $loginpass == password_verify($loginpass, $dbpassword)) {
         $_SESSION['login_user'] = $myusername;
        
         header("location: homepage.php");
        
      }
      else{
          $error = "Your Login Name or Password is invalid";
      }
   }
   mysqli_close($db);
}

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Login - Student Information Admins</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="CSS/GeneralCSS.css" />
        <link rel="stylesheet" href="CSS/login.css" />
	</head>
	<body>
        <form method="post">    
            <div class="loginDiv">
                <h2>Admin Login</h2>
                <p>Username<br>
                    <input type="text" name="log_username" placeholder="Enter Username" />
                </p>
                <p>Password<br>
                    <input type="password" name="log_password" placeholder="Enter Password" /> <br>
                </p>
                <input id="loginbtn" name="login" type="submit" value="Login"/>
                <p><?php echo "$error"?></p>
            </div>
        </form>
	</body>
</html>

