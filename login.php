<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <?php include 'Login/include/Headerfiles/HEADER1.php';?>

       <?php include "Login/include/LOGINprocess/STUDENTaccount.php"; ?>
       <?php include "Login/include/LOGINprocess/ADMINaccount.php"; ?>
       <?php include "Login/include/LOGINprocess/FACULTYaccount.php"; ?>
       <?php include "Login/include/LOGINprocess/PARENTaccount.php"; ?>

      
	<style type="text/css">
             #sacc
               {
                   width: 300px;
                   border: none;
                   border-bottom: 2px solid black;
                   border-radius: 50px 50px 50px 50px;
                   height: 40px;
                   text-align-last:center; 
               }
               i.img-logo img
               {
                   border: none;
                   border-radius: 0px;
               }

	</style>
</head>
<body>
    <div class="container">
        
             <form action="" method="POST">
               <i class="img-logo"> <img src="Login/Image/logo.png"></i>
               <br><h4 class="label"><b>Enter your Account</b></h4>
               
               <div class="form-group">
                   <select id="sacc" name="roles" class="form-select form-select-sm" aria-label=".form-select-sm example" name="account">
                    <option value="Admin_account">Admin account</option>
                    <option value="Faculty_account">Faculty account</option>
                    <option value="Parent_account">Parent account</option>
                    <option selected value="Student_account">Student account</option>
                </select>
                </div>
        <br>   
	 	<div class="form-group">
                    <input required type="text" name="User" placeholder="Username">
	 	</div>
         <br>     
	 	<div class="form-group">
	 		<input required type="Password" name="Pass" placeholder="Password">
	 	</div>
               
         <br> 
	 	<div class="form-group">
                    <button type="submit" name="LOGIN" id="sub"> <i class="img-login"></i> Login</button>
	 	</div>
               
               
                </form>           
    </div>
</body>
</html>